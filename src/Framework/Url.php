<?php


namespace Framework;


class Url
{
	private $_domain;
	private $_path;
	private $_secure;
	private $_rewrite = array();

	/**
	 * @param string $domain
	 * @param string $path
	 * @param bool $isSecure
	 */
	public function __construct(string $domain, string $path, $isSecure = true)
	{
		$this->_domain = $domain;
		$this->_path = $path;
		$this->_secure = $isSecure;
	}

	/**
	 * @param object $rewrite
	 */
	public function addRewrite($rewrite)
	{
		$this->_rewrite[] = $rewrite;
	}

	/**
	 * Generate link address
	 * @param string $route
	 * @param mixed $args
	 * @param bool $secure
	 * @return    string
	 */
	public function link($route, $args = ''): string
	{
		if ($this->isSecure()) {
			$url = "https://";
		} else {
			$url = "http://";
		}

		if (!empty($this->_path)) {
			$url .= "{$this->_domain}/{$this->_path}/index.php?route=" . $route;
		} else {
			$url .= "{$this->_domain}/index.php?route=" . $route;
		}
		if ($args) {
			if (is_array($args)) {
				$url .= '&amp;' . http_build_query($args);
			} else {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}

		foreach ($this->_rewrite as $rewrite) {
			$url = $rewrite->rewrite($url);
		}

		return html_entity_decode($url);
	}

	/**
	 * @return bool
	 */
	public function isSecure(): bool
	{
		return $this->_secure;
	}

	public function getDomainUrl(): string
	{
		if ($this->isSecure()) {
			$url = "https://";
		} else {
			$url = "http://";
		}
		return $url .= $this->_domain . '/';
	}

}