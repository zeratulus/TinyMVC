<?php


namespace Framework;


class Language
{
	private $_data = [];
	private $_code;

	public function __construct(string $code = 'ru-ru')
	{
		$this->_code = $code;
		$this->load($this->_code);
	}

	public function get($key)
	{
		return isset($this->_data[$key]) ? $this->_data[$key] : $key;
	}

	public function set($key, $value)
	{
		$this->_data[$key] = $value;
	}

	public function getAll()
	{
		return $this->_data;
	}

	public function load(string $filename)
	{
		$_ = [];

		$file = APP_DIR . '/language/' . $this->_code . '/' . $filename . '.php';

		if (is_file($file)) {
			require($file);

			$this->_data = array_merge($this->_data, $_);
		}
	}

}