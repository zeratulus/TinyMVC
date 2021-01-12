<?php


namespace Framework;


use Doctrine\ORM\EntityManager;

class AbstractController extends Controller
{
	private $validator;

	public function __construct($registry) {
		parent::__construct($registry);

		$this->validator = new \Framework\Validator($this->registry);
	}

	public function getBrowserDetection(): \Framework\BrowserDetection
	{
		return $this->registry->get('browser_detection');
	}

	public function getDebugBar(): \DebugBar\exStandardDebugBar
	{
		return $this->registry->get('debug_bar');
	}

	public function getEntityManager(): EntityManager
	{
		return $this->registry->get('entity_manager');
	}

	public function getHTMLDocument(): \Framework\HTMLDocument
	{
		return $this->registry->get('html_document');
	}

	public function getLanguage(): \Framework\Language
	{
		return $this->registry->get('language');
	}

	public function getLoader(): \Framework\Loader
	{
		return $this->registry->get('loader');
	}

	public function getLogger(): \Monolog\Logger
	{
		return $this->registry->get('logger');
	}

	public function getMailer(): \Swift_Mailer
	{
		return $this->registry->get('mailer');
	}

	public function getRequest(): \Framework\Request
	{
		return $this->registry->get('request');
	}

	public function getResponse(): \Framework\Response
	{
		return $this->registry->get('response');
	}

	public function getRemoteAddress(): \Framework\RemoteAddress
	{
		return $this->registry->get('response');
	}

	public function getSession(): \Framework\Session
	{
		return $this->registry->get('session');
	}

	public function getValidator(): \Framework\Validator
	{
		return $this->validator;
	}

	public function getView(): \Framework\View
	{
		return $this->registry->get('view');
	}

	public function getUrl(): \Framework\Url
	{
		return $this->registry->get('url');
	}

	public function isLogged()
	{
		$is_logged = false;
		if (isset($this->getSession()->data['user_id'])) {
			$is_logged = $this->getSession()->data['user_id'] > 0;
		}
		return $is_logged;
	}

	public function isAdmin()
	{
		$is_admin = false;
		if (isset($this->getSession()->data['group_id'])) {
			$is_admin = $this->getSession()->data['group_id'] == 777;
		}
		return $is_admin;
	}

}