<?php
/**
 * @version             
 * @package             Coursegroups
 * @copyright   Copyright (C) 2012 Antonio Duran Terres
 * @license             GNU/GPL, see LICENSE.php
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once(JPATH_SITE.'/components/com_joomdle/helpers/content.php');
require_once(JPATH_ADMINISTRATOR.'/components/com_coursegroups/helpers/coursegroups.php');


class plgUserCoursegroups extends JPlugin
{
	function plgUserJoomdlegroups(& $subject, $config) {
                parent::__construct($subject, $config);
        }

	function onUserAfterSave ($user, $isnew, $success, $msg)
	{
		$this->update_enrolments ($user);
	}

	function onUserLogin($user, $options = array())
	{
		$this->update_enrolments ($user);
	}
	
	function update_enrolments ($user)
	{
		$mainframe =& JFactory::getApplication('site');

		$comp_params = &JComponentHelper::getParams( 'com_joomdle' );

		$username = $user['username'];
		$user_id = JUserHelper::getUserId($username);

		$user_groups =  CoursegroupsHelper::get_user_groups ($user_id);

		foreach ($user_groups as $group)
		{

			$selected_courses = CoursegroupsHelper::get_course_groups ($group->group_id);

			if (!count ($selected_courses))
				continue;


			$c = array ();
			foreach ($selected_courses as $course_id)
			{
				$course['id'] = (int) $course_id;
				$c[] = $course;
			}

			JoomdleHelperContent::call_method ('multiple_enrol', $username, $c, 5);

		}
	}

	
}

?>
