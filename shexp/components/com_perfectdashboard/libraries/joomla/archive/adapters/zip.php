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

JLoader::register('JArchiveZip', JPATH_LIBRARIES.'/joomla/archive/zip.php');
JLoader::register('PerfectDashboardHelperTest', JPATH_COMPONENT.'/helpers/test.php');

/**
 * ZIP format adapter for the JArchive class
 */
class PerfectdashboardArchiveZip extends JArchiveZip
{
	/**
	 * ZIP compression methods.
	 *
	 * @var    array
	 * @since  11.1
	 */
	private $_methods = array(0x0 => 'None', 0x1 => 'Shrunk', 0x2 => 'Super Fast', 0x3 => 'Fast', 0x4 => 'Normal', 0x5 => 'Maximum', 0x6 => 'Imploded',
		0x8 => 'Deflated');

	/**
	 * Beginning of central directory record.
	 *
	 * @var    string
	 * @since  11.1
	 */
	private $_ctrlDirHeader = "\x50\x4b\x01\x02";

	/**
	 * End of central directory record.
	 *
	 * @var    string
	 * @since  11.1
	 */
	private $_ctrlDirEnd = "\x50\x4b\x05\x06\x00\x00\x00\x00";

	/**
	 * Beginning of file contents.
	 *
	 * @var    string
	 * @since  11.1
	 */
	private $_fileHeader = "\x50\x4b\x03\x04";

	/**
	 * ZIP file data buffer
	 *
	 * @var    string
	 * @since  11.1
	 */
	private $_data = null;

	/**
	 * ZIP file metadata array
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
	 * @return  boolean  True if successful
	 *
	 * @since   11.1
	 * @throws RuntimeException
	 */
	public function extract($archive, $destination, array $options = array())
	{
		if (!is_file($archive))
		{
            return $this->raiseWarning('no_archive');
		}

		if ($this->hasNativeSupport())
		{
			return $this->extractNative($archive, $destination);
		}

		return $this->extractCustom($archive, $destination);
	}

	/**
	 * Temporary private method to isolate JError from the extract method
	 * This code should be removed when JError is removed.
	 *
	 * @param   int     $code  The application-internal error code for this error
	 * @param   string  $msg   The error message, which may also be shown the user if need be.
	 *
	 * @return  JException  JException instance if JError class exists
	 *
	 * @throws  RuntimeException if JError class does not exist
	 */
	private function raiseWarning($code, $msg = 'zip')
	{
        JArchive::setError($code, $msg);
		throw new Exception('pd');
	}

	/**
	 * Extract a ZIP compressed file to a given path using a php based algorithm that only requires zlib support
	 *
	 * @param   string  $archive      Path to ZIP archive to extract.
	 * @param   string  $destination  Path to extract archive into.
	 *
	 * @return  mixed   True if successful
	 *
	 * @since   11.1
	 * @throws  RuntimeException
	 */
	protected function extractCustom($archive, $destination)
	{
		$this->_data = null;
		$this->_metadata = null;

		if (!extension_loaded('zlib'))
		{
			return $this->raiseWarning('php_extension_not_available', 'zlib');
		}

		$this->_data = file_get_contents($archive);

		if (!$this->_data)
		{
			return $this->raiseWarning('unable_to_read_archive');
		}

		if (!$this->_readZipInfo($this->_data))
		{
			return $this->raiseWarning('unable_to_read_archive', 'Get ZIP Information failed');
		}

		// Don't throw exception on first error, but continue, without writing files, and collect all further errors.
        $error_flag   = false;

		for ($i = 0, $n = count($this->_metadata); $i < $n; $i++)
		{
			$lastPathCharacter = substr($this->_metadata[$i]['name'], -1, 1);

			if ($lastPathCharacter !== '/' && $lastPathCharacter !== '\\')
			{
				$buffer = $this->_getFileData($i);
				$path = JPath::clean($destination . '/' . $this->_metadata[$i]['name']);

				// Make sure the destination folder exists
				if (!JFolder::create(dirname($path)))
				{
                    PerfectDashboardHelperTest::checkPathWriteAbility(dirname($path), dirname($path), $error_flag, true);
				}

				if (!$error_flag) {
				    // Continue writing files only if there were no errors
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

	/**
	 * Extract a ZIP compressed file to a given path using native php api calls for speed
	 *
	 * @param   string  $archive      Path to ZIP archive to extract
	 * @param   string  $destination  Path to extract archive into
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 * @throws  RuntimeException
	 */
	protected function extractNative($archive, $destination)
	{
		$zip = zip_open($archive);

		if (!is_resource($zip))
		{
            return $this->raiseWarning('unable_to_open_archive', 'php_error_code:'.$zip);
		}

		// Make sure the destination folder exists
		if (!JFolder::create($destination))
		{
            $error_flag = false;
            PerfectDashboardHelperTest::checkPathWriteAbility($destination, $destination, $error_flag, true);
            return $this->raiseWarning('unable_to_create_extract_dir');
		}

        // Don't throw exception on first error, but continue, without writing files, and collect all further errors.
        $error_flag   = false;

		// Read files in the archive
		while ($file = @zip_read($zip))
		{
			if (!zip_entry_open($zip, $file, "r"))
			{
				return $this->raiseWarning('unable_to_read_entry');
			}

			if (substr(zip_entry_name($file), strlen(zip_entry_name($file)) - 1) != "/")
			{
				$buffer = zip_entry_read($file, zip_entry_filesize($file));

                if (!$error_flag) {
                    if (JFile::write($destination . '/' . zip_entry_name($file), $buffer) === false) {
                        PerfectDashboardHelperTest::checkPathWriteAbility($destination . '/' . zip_entry_name($file),
                            $destination . '/' . zip_entry_name($file), $error_flag, true);
                    }
                } else {
                    PerfectDashboardHelperTest::checkPathWriteAbility($destination . '/' . zip_entry_name($file),
                        $destination . '/' . zip_entry_name($file), $error_flag);
                }

				zip_entry_close($file);
			}
		}

		@zip_close($zip);

        if ($error_flag) {
            return $this->raiseWarning('unable_to_write_entry');
        }

		return true;
	}

	/**
	 * Get the list of files/data from a ZIP archive buffer.
	 *
	 * <pre>
	 * KEY: Position in zipfile
	 * VALUES: 'attr'  --  File attributes
	 * 'crc'   --  CRC checksum
	 * 'csize' --  Compressed file size
	 * 'date'  --  File modification time
	 * 'name'  --  Filename
	 * 'method'--  Compression method
	 * 'size'  --  Original file size
	 * 'type'  --  File type
	 * </pre>
	 *
	 * @param   string  &$data  The ZIP archive buffer.
	 *
	 * @return  boolean True on success
	 *
	 * @since   11.1
	 * @throws  RuntimeException
	 */
	private function _readZipInfo(&$data)
	{
		$entries = array();

		// Find the last central directory header entry
		$fhLast = strpos($data, $this->_ctrlDirEnd);

		do
		{
			$last = $fhLast;
		}

		while (($fhLast = strpos($data, $this->_ctrlDirEnd, $fhLast + 1)) !== false);

		// Find the central directory offset
		$offset = 0;

		if ($last)
		{
			$endOfCentralDirectory = unpack(
				'vNumberOfDisk/vNoOfDiskWithStartOfCentralDirectory/vNoOfCentralDirectoryEntriesOnDisk/' .
				'vTotalCentralDirectoryEntries/VSizeOfCentralDirectory/VCentralDirectoryOffset/vCommentLength',
				substr($data, $last + 4)
			);
			$offset = $endOfCentralDirectory['CentralDirectoryOffset'];
		}

		// Get details from central directory structure.
		$fhStart = strpos($data, $this->_ctrlDirHeader, $offset);
		$dataLength = strlen($data);

		do
		{
			if ($dataLength < $fhStart + 31)
			{
				return $this->raiseWarning('invalid_archive_data');
			}

			$info = unpack('vMethod/VTime/VCRC32/VCompressed/VUncompressed/vLength', substr($data, $fhStart + 10, 20));
			$name = substr($data, $fhStart + 46, $info['Length']);

			$entries[$name] = array(
				'attr' => null,
				'crc' => sprintf("%08s", dechex($info['CRC32'])),
				'csize' => $info['Compressed'],
				'date' => null,
				'_dataStart' => null,
				'name' => $name,
				'method' => $this->_methods[$info['Method']],
				'_method' => $info['Method'],
				'size' => $info['Uncompressed'],
				'type' => null
			);

			$entries[$name]['date'] = mktime(
				(($info['Time'] >> 11) & 0x1f),
				(($info['Time'] >> 5) & 0x3f),
				(($info['Time'] << 1) & 0x3e),
				(($info['Time'] >> 21) & 0x07),
				(($info['Time'] >> 16) & 0x1f),
				((($info['Time'] >> 25) & 0x7f) + 1980)
			);

			if ($dataLength < $fhStart + 43)
			{
				return $this->raiseWarning('invalid_archive_data');
			}

			$info = unpack('vInternal/VExternal/VOffset', substr($data, $fhStart + 36, 10));

			$entries[$name]['type'] = ($info['Internal'] & 0x01) ? 'text' : 'binary';
			$entries[$name]['attr'] = (($info['External'] & 0x10) ? 'D' : '-') . (($info['External'] & 0x20) ? 'A' : '-')
				. (($info['External'] & 0x03) ? 'S' : '-') . (($info['External'] & 0x02) ? 'H' : '-') . (($info['External'] & 0x01) ? 'R' : '-');
			$entries[$name]['offset'] = $info['Offset'];

			// Get details from local file header since we have the offset
			$lfhStart = strpos($data, $this->_fileHeader, $entries[$name]['offset']);

			if ($dataLength < $lfhStart + 34)
			{
				return $this->raiseWarning('invalid_archive_data');
			}

			$info = unpack('vMethod/VTime/VCRC32/VCompressed/VUncompressed/vLength/vExtraLength', substr($data, $lfhStart + 8, 25));
			$name = substr($data, $lfhStart + 30, $info['Length']);
			$entries[$name]['_dataStart'] = $lfhStart + 30 + $info['Length'] + $info['ExtraLength'];

			// Bump the max execution time because not using the built in php zip libs makes this process slow.
			@set_time_limit(ini_get('max_execution_time'));
		}

		while ((($fhStart = strpos($data, $this->_ctrlDirHeader, $fhStart + 46)) !== false));

		$this->_metadata = array_values($entries);

		return true;
	}

	/**
	 * Returns the file data for a file by offsest in the ZIP archive
	 *
	 * @param   integer  $key  The position of the file in the archive.
	 *
	 * @return  string  Uncompressed file data buffer.
	 *
	 * @since   11.1
	 */
	private function _getFileData($key)
	{
		$method = $this->_metadata[$key]['_method'];

		if ($method == 0x12 && !extension_loaded('bz2'))
		{
			return '';
		}

		switch ($method)
		{
			case 0x8:
				return gzinflate(substr($this->_data, $this->_metadata[$key]['_dataStart'], $this->_metadata[$key]['csize']));

			case 0x0:
				// Files that aren't compressed.
				return substr($this->_data, $this->_metadata[$key]['_dataStart'], $this->_metadata[$key]['csize']);

			case 0x12:

				return bzdecompress(substr($this->_data, $this->_metadata[$key]['_dataStart'], $this->_metadata[$key]['csize']));
		}

		return '';
	}
}
