<?php


namespace Framework;


class Request
{
	public $get = array();
	public $post = array();
	public $cookie = array();
	public $files = array();
	public $server = array();

	public function __construct()
	{
		$this->get = $this->clean($_GET);
		$this->post = $this->clean($_POST);
		$this->request = $this->clean($_REQUEST);
		$this->cookie = $this->clean($_COOKIE);
		$this->files = $this->clean($_FILES);
		$this->server = $this->clean($_SERVER);
	}

	/**
	 *
	 * @param array $data
	 *
	 * @return    array
	 */
	public function clean($data)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);

				$data[$this->clean($key)] = $this->clean($value);
			}
		} else {
			$data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
		}

		return $data;
	}

	public function issetPost($key)
	{
		if (!empty($this->post[$key])) {
			return $this->post[$key];
		} else {
			return '';
		}
	}

	public function issetGet($key)
	{
		if (!empty($this->get[$key])) {
			return $this->get[$key];
		} else {
			return '';
		}
	}

	public function isMethodPost()
	{
		return $this->server['REQUEST_METHOD'] == 'POST';
	}

	public function isMethodGet()
	{
		return $this->server['REQUEST_METHOD'] == 'GET';
	}


}