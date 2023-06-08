<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Archive
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
defined('JPATH_LIBRARIES_DASHBOARD') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

JLoader::register('JArchiveTar', JPATH_LIBRARIES.'/joomla/archive/tar.php');
JLoader::register('PerfectDashboardHelperTest', JPATH_COMPONENT.'/helpers/test.php');

/**
 * Tar format adapter for the JArchive class
 */
class PerfectdashboardArchiveTar extends JArchiveTar
{
	/**
	 * Tar file types.
	 *
	 * @var    array
	 * @since  11.1
	 */
	private $_types = array(
		0x0  => 'Unix file',
		0x30 => 'File',
		0x31 => 'Link',
		0x32 => 'Symbolic link',
		0x33 => 'Character special file',
		0x34 => 'Block special file',
		0x35 => 'Directory',
		0x36 => 'FIFO special file',
		0x37 => 'Contiguous file');

	/**
	 * Tar file data buffer
	 *
	 * @var    string
	 * @since  11.1
	 */
	private $_data = null;

	/**
	 * Tar file metadata array
	 *
	 * @var    array
	 * @since  11.1
	 */
	private $_metadata = null;

	/**
	 * Extract a ZIP compressed file to a given path
	 *
	 * @param   string  $archive      Path to ZIP archive to extract
	 * @param   string  $destination  Path to extract archive into
	 * @param   array   $options      Extraction options [unused]
	 *
	 * @return  boolean|JException  True on success, JException instance on failure if JError class exists
	 *
	 * @since   11.1
	 * @throws  RuntimeException if JError class does not exist
	 */
	public function extract($archive, $destination, array $options = array())
	{
		$this->_data = null;
		$this->_metadata = null;

		$this->_data = file_get_contents($archive);

		if (!$this->_data)
		{
            $this->raiseWarning('unable_to_read_archive');
		}

		$this->_getTarInfo($this->_data);

        // Don't throw exception on first error, but continue, without writing files, and collect all further errors.
        $error_flag   = false;

		for ($i = 0, $n = count($this->_metadata); $i < $n; $i++)
		{
			$type = strtolower($this->_metadata[$i]['type']);

			if ($type == 'file' || $type == 'unix file')
			{
				$buffer = $this->_metadata[$i]['data'];
				$path = JPath::clean($destination . '/' . $this->_metadata[$i]['name']);

				// Make sure the destination folder exists
				if (!JFolder::create(dirname($path)))
				{
                    PerfectDashboardHelperTest::checkPathWriteAbility(dirname($path), dirname($path), $error_flag, true);
				}

                if (!$error_flag) {
                    if (JFile::write($path, $buffer) === false) {
                        PerfectDashboardHelperTest::checkPathWriteAbility($path, $path, $error_flag, true);
                    }
                } else {
                    PerfectDashboardHelperTest::checkPathWriteAbility($path, $path, $error_flag);
                }
			}
		}

        if ($error_flag) {
            return $this->raiseWarning('unable_to_write_entry');
        }

		return true;
	}

    private function raiseWarning($code, $msg = 'tar')
    {
        JArchive::setError($code, $msg);
        throw new Exception('pd');
    }

	/**
	 * Get the list of files/data from a Tar archive buffer.
	 *
	 * @param   string  &$data  The Tar archive buffer.
	 *
	 * @return  boolean|JException  True on success, JException instance on failure if JError class exists
	 *
	 * @since   11.1
	 * @throws  RuntimeException if JError class does not exist
	 */
	protected function _getTarInfo(& $data)
	{
		$position = 0;
		$return_array = array();

		while ($position < strlen($data))
		{
			if (version_compare(PHP_VERSION, '5.5', '>='))
			{
				$info = @unpack(
					"Z100filename/Z8mode/Z8uid/Z8gid/Z12size/Z12mtime/Z8checksum/Ctypeflag/Z100link/Z6magic/Z2version/Z32uname/Z32gname/Z8devmajor/Z8devminor",
					substr($data, $position)
				);
			}
			else
			{
				$info = @unpack(
					"a100filename/a8mode/a8uid/a8gid/a12size/a12mtime/a8checksum/Ctypeflag/a100link/a6magic/a2version/a32uname/a32gname/a8devmajor/a8devminor",
					substr($data, $position)
				);
			}

			/**
			 * This variable has been set in the previous loop,
			 * meaning that the filename was present in the previous block
			 * to allow more than 100 characters - see below
			 */
			if (isset($longlinkfilename))
			{
				$info['filename'] = $longlinkfilename;
				unset($longlinkfilename);
			}

			if (!$info)
			{
                $this->raiseWarning('unable_to_decompress_data');
			}

			$position += 512;
			$contents = substr($data, $position, octdec($info['size']));
			$position += ceil(octdec($info['size']) / 512) * 512;

			if ($info['filename'])
			{
				$file = array(
					'attr' => null,
					'data' => null,
					'date' => octdec($info['mtime']),
					'name' => trim($info['filename']),
					'size' => octdec($info['size']),
					'type' => isset($this->_types[$info['typeflag']]) ? $this->_types[$info['typeflag']] : null);

				if (($info['typeflag'] == 0) || ($info['typeflag'] == 0x30) || ($info['typeflag'] == 0x35))
				{
					// File or folder.
					$file['data'] = $contents;

					$mode = hexdec(substr($info['mode'], 4, 3));
					$file['attr'] = (($info['typeflag'] == 0x35) ? 'd' : '-') . (($mode & 0x400) ? 'r' : '-') . (($mode & 0x200) ? 'w' : '-') .
						(($mode & 0x100) ? 'x' : '-') . (($mode & 0x040) ? 'r' : '-') . (($mode & 0x020) ? 'w' : '-') . (($mode & 0x010) ? 'x' : '-') .
						(($mode & 0x004) ? 'r' : '-') . (($mode & 0x002) ? 'w' : '-') . (($mode & 0x001) ? 'x' : '-');
				}
				elseif (chr($info['typeflag']) == 'L' && $info['filename'] == '././@LongLink')
				{
					// GNU tar ././@LongLink support - the filename is actually in the contents,
					// setting a variable here so we can test in the next loop
					$longlinkfilename = $contents;

					// And the file contents are in the next block so we'll need to skip this
					continue;
				}
				else
				{
					// Some other type.
				}

				$return_array[] = $file;
			}
		}

		$this->_metadata = $return_array;

		return true;
	}
}
