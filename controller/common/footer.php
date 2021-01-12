<?php

class ControllerCommonFooter extends \Framework\AbstractController
{
	private $_route = 'common/footer';

	public function index()
	{
	    $this->getLanguage()->load($this->_route);
	    $data = $this->getLanguage()->getAll();
		$data['scripts'] = $this->getHTMLDocument()->getScripts('footer');
        $data['styles'] = $this->getHTMLDocument()->getStyles('footer');
		$data['years'] = '2019 - ' . date('Y');

		if (isFrameworkDebug()) {
			$renderer = $this->getDebugBar()->getJavascriptRenderer();
			$renderer->setEnableJqueryNoConflict(false);
			$data['debug_bar_renderer'] = $renderer;
		}

		return $this->getView()->render($this->_route, $data);
	}

}