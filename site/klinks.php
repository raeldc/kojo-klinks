<?php defined('_JEXEC') or die;

JFactory::getApplication()->triggerEvent('InitializeKojo', JPATH_COMPONENT_SITE);

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('categories', 'categories(/<category>(/<limit>))', array(
		'action' => 'categories'
	))
	->defaults(array(
		'controller' => 'links',
		'action'     => 'categories',
		'category' => NULL,
		'level' => 1,
		'limit' => NULL
	));

Route::set('default', '(<action>(/<category>)(/<link>))')
	->defaults(array(
		'controller' => 'links',
		'action'     => 'categories',
	));
	
/*
 * Follow Joomla's standard, use the "view" $_GET variable as the route. 
 *		This is to allow Joomla to create Menu Items in the admin section that points 
 *		to different controllers of the Kojo Application.
*/
$route = JRequest::getVar('route', JRequest::getVar('view', 'categories'));

/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */
echo Request::factory($route)
	->execute()
	->response;

JFactory::getApplication()->triggerEvent('ExitKojo', JPATH_COMPONENT_SITE);