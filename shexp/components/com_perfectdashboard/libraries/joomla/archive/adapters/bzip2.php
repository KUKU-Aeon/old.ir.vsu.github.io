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
jimport('joomla.filesystem.stream');

JLoader::register('JArchiveBzip2', JPATH_LIBRARIES.'/joomla/archive/bzip2.php');

/**
 * Bzip2 format adapter for the JArchive class
 */
class PerfectdashboardArchiveBzip2 extends JArchiveBzip2
{
	/**
	 * Bzip2 file data buffer
	 *
	 * @var    string
	 * @since  11.1
	 */
	private $_data = null;

	/**
	 * Extract a Bzip2 compressed file to a given path
	 *
	 * @param   string  $archive      Path to Bzip2 archive to extract
	 * @param   string  $destination  Path to extract archive to
	 * @param   array   $options      Extraction options [unused]
	 *
	 * @return  boolean  True if successful
	 *
	 * @since   11.1
	 * @throws  RuntimeException
	 */
	public function extract($archive, $destination, array $options = array ())
	{
		$this->_data = null;

		if (!extension_loaded('bz2'))
		{
			$this->raiseWarning('php_extension_not_available');
		}

		if (isset($options['use_streams']) && $options['use_streams'] != false)
		{
			return $this->extractStream($archive, $destination, $options);
		}

		// Old style: read the whole file and then parse it
		$this->_data = file_get_contents($archive);

		if (!$this->_data)
		{
			return $this->raiseWarning('unable_to_read_archive');
		}

		$buffer = bzdecompress($this->_data);
		unset($this->_data);

		if (empty($buffer))
		{
			return $this->raiseWarning('unable_to_decompress_data');
		}

		if (JFile::write($destination, $buffer) === false)
		{
            $error_flag = false;
            PerfectDashboardHelperTest::checkPathWriteAbility($destination, $destination, $error_flag, true);
            return $this->raiseWarning('unable_to_write_archive');
		}

		return true;
	}

	/**
	 * Method to extract archive using stream objects
	 *
	 * @param   string  $archive      Path to Bzip2 archive to extract
	 * @param   string  $destination  Path to extract archive to
	 * @param   array   $options      Extraction options [unused]
	 *
	 * @return  boolean  True if successful
	 */
	protected function extractStream($archive, $destination, $options = array ())
	{
		// New style! streams!
		$input = JFactory::getStream();

		// Use bzip
		$input->set('processingmethod', 'bz');

		if (!$input->open($archive))
		{
			return $this->raiseWarning('unable_to_read_archive');

		}

		$output = JFactory::getStream();

		if (!$output->open($destination, 'w'))
		{
			$input->close();

            $error_flag = false;
            PerfectDashboardHelperTest::checkPathWriteAbility($destination, $destination, $error_flag, true);
            return $this->raiseWarning('unable_to_write_archive');

		}

		do
		{
			$this->_data = $input->read($input->get('chunksize', 8196));

			if ($this->_data && !$output->write($this->_data))
			{
				$input->close();

                $error_flag = false;
                PerfectDashboardHelperTest::checkPathWriteAbility($destination, $destination, $error_flag, true);
                return $this->raiseWarning('unable_to_write_archive');
			}
		}

		while ($this->_data);

		$output->close();
		$input->close();

		return true;
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
	private function raiseWarning($code, $msg = 'bz2')
	{
        JArchive::setError($code, $msg);
        throw new Exception('pd');
	}
}
