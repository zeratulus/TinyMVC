<?php


namespace Framework;


class View
{
	private $_loader;
	private $_env;
	private $_profile;

	public function __construct()
	{
		$this->_loader = new \Twig\Loader\FilesystemLoader("view");
		$this->_env = new \Twig\Environment($this->_loader, [
			'autoescape' => false,
			'cache' => TWIG_CACHE
		]);
		$this->_profile = new \Twig\Profiler\Profile();
	}

	public function render($template, $data)
	{
		return $this->_env->render("{$template}.twig", $data);
	}

	/**
	 * @return \Twig\Loader\FilesystemLoader
	 */
	public function getTwigLoader(): \Twig\Loader\FilesystemLoader
	{
		return $this->_loader;
	}

	/**
	 * @return \Twig\Environment
	 */
	public function getTwigEnv(): \Twig\Environment
	{
		return $this->_env;
	}

	/**
	 * @return \Twig\Profiler\Profile
	 */
	public function getTwigProfile(): \Twig\Profiler\Profile
	{
		return $this->_profile;
	}

}