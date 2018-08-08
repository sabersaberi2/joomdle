<?php
/**
* @version		1.0
* @package		Joomdle JGroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JController::getInstance('Jgroups');
$controller->execute(JRequest::getVar('task',''));
$controller->redirect();
