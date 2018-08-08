<?php
/**
 * @version     1.0.0
 * @package     com_coursegroups
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */


// No direct access
defined('_JEXEC') or die;

class CoursegroupsController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/coursegroups.php';

		// Load the submenu.
		CoursegroupsHelper::addSubmenu(JRequest::getCmd('view', 'items'));

		$view		= JRequest::getCmd('view', 'items');
        JRequest::setVar('view', $view);

		parent::display();

		return $this;
	}

	public function save_group ()
	{
		require_once JPATH_COMPONENT.'/helpers/coursegroups.php';

		$id = JRequest::getVar('usergroup_id');
		$courses = JRequest::getVar('courses', array(), 'post', 'array');

		$group->usergroups_id = $id;
		$group->courses=  implode (',', $courses);

		$db           =& JFactory::getDBO();
		
		$coursegroup_id = CoursegroupsHelper::get_coursegroup_id ($id);
		if ($coursegroup_id)
		{
			$group->id = $coursegroup_id;
			$db->updateObject ('#__coursegroups_groups', $group, 'id');
		}
		else
			$db->insertObject ('#__coursegroups_groups', $group);

		$this->setRedirect( 'index.php?option=com_coursegroups&view=items' );
	}
}
