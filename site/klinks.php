<?php defined('_JEXEC') or die;

(JFactory::getApplication()->triggerEvent('InitializeKoJo', JPATH_COMPONENT)) or die('Please install or enable the KoJo Framework Plugin');

echo Request::instance()
	->defaults(array(
		'controller' => 'links',
		'action' => 'categories',
	))
	->execute()
	->response;

JFactory::getApplication()->triggerEvent('ExitKojo', JPATH_COMPONENT_SITE);