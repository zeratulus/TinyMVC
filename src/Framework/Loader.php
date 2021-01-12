<?php


namespace Framework;


class Loader
{
	private $_registry;

	public function __construct(Registry $registry)
	{
		$this->_registry = $registry;
	}

	public function controller(string $route, $data = [])
	{
		$action = new Action($route);
		return $action->execute($this->_registry, $data);
	}

	public function language(string $route)
	{
		$language = $this->_registry->get('language');
		$language->load($route);
	}
}