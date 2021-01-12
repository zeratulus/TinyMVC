<?php

require_once 'Helpers/general.php';
require_once 'Helpers/utf8.php';
require_once 'Helpers/view.php';

$registry = new \Framework\Registry();

$response = new \Framework\Response();
$registry->set('response', $response);

$request = new \Framework\Request();
$registry->set('request', $request);
$registry->set('html_document', new \Framework\HTMLDocument());
$registry->set('browser_detection', new \Framework\BrowserDetection());
$registry->set('remote_address', new \Framework\RemoteAddress());
$registry->set('loader', new \Framework\Loader($registry));
$registry->set('language', new \Framework\Language());

//Debug Bar
$debug_bar = null;
if (isFrameworkDebug()) {
	$debug_bar = new \DebugBar\exStandardDebugBar();
	$registry->set('debug_bar', $debug_bar);
}

//Url
$domain = $request->server['HTTP_HOST'];
$doc_uri = isset($request->server['DOCUMENT_URI']) ? $request->server['DOCUMENT_URI'] : '';
if (!empty($doc_uri)) {
	$url_parts = explode('/', $doc_uri);
	foreach ($url_parts as $item) {
		if (!empty($item)) {
			$path = $item;
			break;
		}
	}
} else {
	$path = '';
}
$registry->set('url', new \Framework\Url($domain, $path, false));

$view = new \Framework\View();
$registry->set('view', $view);
if (isFrameworkDebug()) {
	$debug_bar->addCollector(new DebugBar\Bridge\exTwigProfileCollector($view->getTwigProfile(), $view->getTwigEnv()));
}

//Doctrine
require_once 'doctrine.php';
if (isFrameworkDebug()) {
	$debugStack = new Doctrine\DBAL\Logging\DebugStack();
	$entityManager->getConnection()->getConfiguration()->setSQLLogger($debugStack);
	$debug_bar->addCollector(new \DebugBar\Bridge\DoctrineCollector($debugStack));
}
$registry->set('entity_manager', $entityManager);

// Session
if (isset($request->get['token']) && isset($request->get['route']) && substr($request->get['route'], 0, 4) == 'api/') {
//	$db->query("DELETE FROM `" . DB_PREFIX . "api_session` WHERE TIMESTAMPADD(HOUR, 1, date_modified) < NOW()");

//	$query = $db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "api` `a` LEFT JOIN `" . DB_PREFIX . "api_session` `as` ON (a.api_id = as.api_id) LEFT JOIN " . DB_PREFIX . "api_ip `ai` ON (as.api_id = ai.api_id) WHERE a.status = '1' AND as.token = '" . $db->escape($request->get['token']) . "' AND ai.ip = '" . $db->escape($request->server['REMOTE_ADDR']) . "'");

	if ($query->num_rows) {
		// Does not seem PHP is able to handle sessions as objects properly so so wrote my own class
		$session = new \Framework\Session($query->row['session_id'], $query->row['session_name']);

		// keep the session alive
//		$db->query("UPDATE `" . DB_PREFIX . "api_session` SET date_modified = NOW() WHERE api_session_id = '" . $query->row['api_session_id'] . "'");
	}
} else {
	$session = new \Framework\Session();
}
$registry->set('session', $session);

//Swift Mailer
// Create the Transport
$transport = (new Swift_SmtpTransport(SMTP_HOST, SMTP_PORT))->setUsername(SMTP_USER)->setPassword(SMTP_PASSWORD);

// Create the Mailer using Transport
$mailer = new Swift_Mailer($transport);
$registry->set('mailer', $mailer);

//Log
$logger = new Monolog\Logger('main');
$logger->pushHandler(new \Monolog\Handler\StreamHandler(LOG_MAIN, \Monolog\Logger::DEBUG));
if (isFrameworkDebug()) {
	$debug_bar->addCollector(new \DebugBar\Bridge\MonologCollector($logger));
}
$registry->set('logger', $logger);

//Routing
$router = new \Framework\Router($registry);
$router->process();

// Output
$response->output();