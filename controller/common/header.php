<?php

class ControllerCommonHeader extends \Framework\AbstractController
{
	private $_route = 'common/header';

	public function index()
	{
		$this->getLanguage()->load($this->_route);
		$data = $this->getLanguage()->getAll();

		$this->getHTMLDocument()->addScript('assets/jquery-3.4.1.min.js');
		$this->getHTMLDocument()->addScript('assets/mmdb/mmdb.min.js');
		$this->getHTMLDocument()->addScript('assets/mmdb/validator-languages/'.$data['i18n'].'.js');
		$this->getHTMLDocument()->addScript('assets/tinymce/tinymce.min.js');
		$this->getHTMLDocument()->addScript('assets/tinymce/langs/'.$data['code'].'.js');
		$this->getHTMLDocument()->addScript('assets/common.js');
		$this->getHTMLDocument()->addStyle('assets/mmdb/mmdb.min.css');
		$this->getHTMLDocument()->addStyle('assets/font-awesome/css/font-awesome.min.css');
		$this->getHTMLDocument()->addStyle('assets/styles/main.css');
		
		$data = array_merge($data, [
			'title' => $this->getHTMLDocument()->getTitle(),
			'description' => $this->getHTMLDocument()->getDescription(),
			'keywords' => $this->getHTMLDocument()->getKeywords(),
			'og_image' => $this->getHTMLDocument()->getOgImage(),
			'scripts' => $this->getHTMLDocument()->getScripts(),
			'styles' => $this->getHTMLDocument()->getStyles(),
			'links' => $this->getHTMLDocument()->getLinks(),
			'robots' => $this->getHTMLDocument()->getRobots()
		]);

		if (isFrameworkDebug()) {
			//DebugBar configuration
			if (!empty($this->getRequest()->issetGet('_ijt'))) {
				$uri = parse_url($_SERVER['REQUEST_URI']);
				foreach (explode('/', $uri['path']) as $item) {
					if (!empty($item)) {
						$base = $item;
						break;
					}
				}
			}

			$debugBar = $this->getDebugBar();
			$renderer = $debugBar->getJavascriptRenderer();
			$renderer->setBasePath( 'assets/debugbar/');
			$renderer->setBaseUrl('assets/debugbar/');
			$renderer->disableVendor('jquery');
			$renderer->setEnableJqueryNoConflict(false);
			$data['debug_bar'] = $renderer;
		}

		$data['is_logged'] = $this->isLogged();
		$data['is_admin'] = $this->isAdmin();

		$data['home'] = $this->getUrl()->link('common/home');

		return $this->getView()->render($this->_route, $data);
	}

}