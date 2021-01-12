<?php


namespace Framework;


use Framework\Request;

final class Router
{
	/**
	 * @var Registry
	 */
	private $_registry;

	/**
	 * @var Request
	 */
	private $_request;
	private $_pre_action = array();
	private $_error;

	public function __construct(Registry $registry)
	{
		$this->_registry = $registry;
		$this->_request = $registry->get('request');
	}

	public function addPreAction(Action $pre_action)
	{
		$this->_pre_action[] = $pre_action;
	}

	public function process()
	{
		//get route
		$route = $this->_request->issetGet('route');
		if (empty($route)) {
			$route = 'common/home';
		}

		// Sanitize the call
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

		$this->dispatch(new Action($route), new Action('error/not_found'));
	}

	private function dispatch(Action $action, Action $error)
	{
		$this->_error = $error;

		foreach ($this->_pre_action as $pre_action) {
			$result = $this->execute($pre_action);

			if ($result instanceof Action) {
				$action = $result;

				break;
			}
		}

		while ($action instanceof Action) {
			$action = $this->execute($action);
		}
	}

	private function execute(Action $action)
	{
		$result = $action->execute($this->_registry);

		if ($result instanceof Action) {
			return $result;
		}

		if ($result instanceof Exception) {
			$action = $this->_error;

			$this->_error = null;

			return $action;
		}
	}

}