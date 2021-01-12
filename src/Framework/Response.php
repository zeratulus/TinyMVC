<?php


namespace Framework;


class Response
{
	private $_headers = array();
	private $_level = 0;
	private $_output;

	/**
	 * @param string $header
	 */
	public function addHeader($header)
	{
		$this->_headers[] = $header;
	}

	/**
	 *
	 *
	 * @param string $url
	 * @param int $status
	 *
	 */
	public function redirect($url, $status = 302)
	{
		header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $url), true, $status);
		exit();
	}

	/**
	 *
	 *
	 * @param int $level
	 */
	public function setCompression($level)
	{
		$this->_level = $level;
	}

	/**
	 *
	 *
	 * @return    array
	 */
	public function getOutput()
	{
		return $this->_output;
	}

	/**
	 *
	 *
	 * @param string $output
	 */
	public function setOutput($output)
	{
		$this->_output = $output;
	}

	/**
	 *
	 *
	 * @param string $data
	 * @param int $level
	 *
	 * @return    string
	 */
	private function compress($data, $level = 0)
	{
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)) {
			$encoding = 'gzip';
		}

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false)) {
			$encoding = 'x-gzip';
		}

		if (!isset($encoding) || ($level < -1 || $level > 9)) {
			return $data;
		}

		if (!extension_loaded('zlib') || ini_get('zlib.output_compression')) {
			return $data;
		}

		if (headers_sent()) {
			return $data;
		}

		if (connection_status()) {
			return $data;
		}

		$this->addHeader('Content-Encoding: ' . $encoding);

		return gzencode($data, (int)$level);
	}

	/**
	 *
	 */
	public function output()
	{
		if ($this->_output) {
			$output = $this->_level ? $this->compress($this->_output, $this->_level) : $this->_output;

			if (!headers_sent()) {
				foreach ($this->_headers as $header) {
					header($header, true);
				}
			}

			echo $output;
		}
	}
}
