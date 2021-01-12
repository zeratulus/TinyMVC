<?php

class ControllerCommonHome extends Framework\AbstractController
{
	private $_route = 'common/home';

	public function index()
	{
		$this->getLanguage()->load($this->_route);
		$data = $this->getLanguage()->getAll();

		$this->getHTMLDocument()->setTitle("{$data['text_heading']} - {$data['text_slogan']}");

		$data['header'] = $this->getLoader()->controller('common/header');
		$data['footer'] = $this->getLoader()->controller('common/footer');

		$this->getResponse()->setOutput($this->getView()->render($this->_route, $data));
	}

}