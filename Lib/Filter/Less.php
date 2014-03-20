<?php

App::uses('AssetFilter', 'AssetCompress.Lib');

/**
 * Pre-processing filter that adds support for LESS.css files.
 *
 * Requires less.php to be installed in vedor dir
 *
 *
 * @see https://github.com/oyejorge/less.php
 */
class Less extends AssetFilter {

	protected $_settings = array(
		'ext' => '.less',
		'path' => 'oyejorge/less.php/lessc.inc.php',
	);

/**
 * Runs `less` against any files that match the configured extension.
 *
 * @param string $filename The name of the input file.
 * @param string $input The content of the file.
 * @throws Exception
 * @return string
 */
	public function input($filename, $input) {
		if (substr($filename, strlen($this->_settings['ext']) * -1) !== $this->_settings['ext']) {
			return $input;
		}
		App::import('Vendor', 'Less_Parser', array('file' => $this->_settings['path']));
		if (!class_exists('Less_Parser')) {
			throw new Exception(sprintf('Cannot not load filter class "%s".', 'Less_Parser'));
		}
		$parser = new Less_Parser();
		$parser->parse($input);
		return $parser->getCss();
	}

}
