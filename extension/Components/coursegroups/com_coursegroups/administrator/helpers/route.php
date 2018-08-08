<?php
/**
* @version		1.0
* @package		com_coursegroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');

/**
 * Coursegroups Component Route Helper
 *
 * @static
 * @package		Coursegroups
 * @since 1.5
 */
abstract class CoursegroupsHelperRoute
{
	protected static $lookup;


	public static function getGroupRoute($id, $return = null)
	{
		// Create the link.
		$link = 'index.php?option=com_coursegroups&task=item.edit&id='. $id;

		return $link;
	}

}
