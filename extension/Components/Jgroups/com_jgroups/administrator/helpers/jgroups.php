<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd & مهدی آنیلی
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;
require_once(JPATH_ADMINISTRATOR.'/components/com_joomdle/helpers/content.php');

/**
 * Jgroups helper.
 */
class JgroupsHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_JGROUPS_TITLE_MAPPINGS'),
			'index.php?option=com_jgroups&view=mappings',
			$vName == 'mappings'
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

		$assetName = 'com_jgroups';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}

// مهدی آنیلی {
	function get_moodle_group_info ($joomla_group_id)
	{
		$db           =& JFactory::getDBO();
        $query = 'SELECT moodle_group_id' .
            ' FROM #__jgroups_mappings' .
            " WHERE joomla_group_id = " . $db->Quote($joomla_group_id);
		$db->setQuery($query);
		$id = $db->loadResult();

		$moodle_groups = JoomdleHelperContent::call_method ('get_groups'); // $moodle_groups structure : Array ( [id] => int, [courseid] => int, [name] => text )

        $m = array ();
        foreach ($moodle_groups as $moodle_group)
        {
            if  ($moodle_group['id'] == $id)
            {
                $m['id'] = $id;
                $m['courseid'] = $moodle_group['courseid'];
                $m['name'] = $moodle_group['name'];
                break;
            }
        }

		return $m;
	}
// } مهدی آنیلی
}
