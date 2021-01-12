<?php


namespace Framework;


class Action
{

	private $_id;
	private $_route;
	private $_method = 'index';

	public function __construct(string $route)
	{
		$this->_id = $route;

		$parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

		// Break apart the route
		while ($parts) {
			$file = APP_DIR . 'controller/' . implode('/', $parts) . '.php';

			if (is_file($file)) {
				$this->_route = implode('/', $parts);

				break;
			} else {
				$this->_method = array_pop($parts);
			}
		}
	}

	public function getId()
	{
		return $this->_id;
	}

	public function execute(Registry $registry, array $args = array())
	{

		// Stop any magical methods being called
		if (substr($this->_method, 0, 2) == '__') {
			return new \Exception('Error: Calls to magic methods are not allowed!');
		}

		$file = APP_DIR . 'controller/' . $this->_route . '.php';
		$class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $this->_route);

		// Initialize the class
		if (is_file($file)) {
			include_once($file);

			$controller = new $class($registry);

			return call_user_func_array(array($controller, $this->_method), $args);

		} else {
			return new \Exception('Error: Could not call ' . $this->_route . '/' . $this->_method . '!');
		}

	}
}
