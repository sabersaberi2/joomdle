<?php
/**
* @version		1.0
* @package		com_coursegroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;

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

	function get_course_groups ($id)
	{
		$db           =& JFactory::getDBO();

        $query = "SELECT courses from #__coursegroups_groups" .
                " WHERE usergroups_id = ". $db->Quote($id);

        $db->setQuery($query);
        $courses = $db->loadResult();

		if (!$courses)
			return array ();

		$courses_array = explode (',', $courses);

		return $courses_array;
	}

	function get_coursegroup_id ($id)
	{
		$db           =& JFactory::getDBO();

        $query = "SELECT id from #__coursegroups_groups" .
                " WHERE usergroups_id = ". $db->Quote($id);

        $db->setQuery($query);
        $id = $db->loadResult();

		return $id;
	}

	function get_user_groups ($user_id)
	{
		$db           =& JFactory::getDBO();

        $query = "SELECT group_id from #__user_usergroup_map" .
                " WHERE user_id = ". $db->Quote($user_id);

        $db->setQuery($query);
        $groups = $db->loadObjectList();

		return $groups;
	}



}
