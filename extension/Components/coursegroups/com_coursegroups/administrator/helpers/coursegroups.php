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

require_once(JPATH_ADMINISTRATOR.'/components/com_joomdle/helpers/content.php');

/**
 * Coursegroups helper.
 */
class CoursegroupsHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{

		JSubMenuHelper::addEntry(
			JText::_('COM_COURSEGROUPS_TITLE_ITEMS'),
			'index.php?option=com_coursegroups&view=items',
			$vName == 'items'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_coursegroups';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}

	public static function get_course_groups ($id)
	{
		$db           = JFactory::getDBO();

        $query = "SELECT courses from #__coursegroups_groups" .
                " WHERE usergroups_id = ". $db->Quote($id);

        $db->setQuery($query);
        $courses = $db->loadResult();

		if (!$courses)
			return array ();

		$courses_array = explode (',', $courses);

		return $courses_array;
	}

	public static function get_coursegroup_id ($id)
	{
		$db           = JFactory::getDBO();

        $query = "SELECT id from #__coursegroups_groups" .
                " WHERE usergroups_id = ". $db->Quote($id);

        $db->setQuery($query);
        $id = $db->loadResult();

		return $id;
	}

	public static function get_user_groups ($user_id)
	{
		$db           = JFactory::getDBO();

        $query = "SELECT group_id from #__user_usergroup_map" .
                " WHERE user_id = ". $db->Quote($user_id);

        $db->setQuery($query);
        $groups = $db->loadObjectList();

		return $groups;
	}


    public static function get_group_courses ($usergroups_id)
    {
        static $courses;

        if (!$courses)
            $courses = JoomdleHelperContent::getCourseList ();

        $c = array ();
        foreach ($courses as $course)
        {
            $c[$course['remoteid']] = $course['fullname'];
        }

        $group_courses = CoursegroupsHelper::get_course_groups ($usergroups_id);
        $str = '';
        foreach ($group_courses as $gc)
        {
            if ($str)
                $str .= " | ";
            $name = $c[$gc];
            $str .= $name;
        }
        return $str;
    }

}
