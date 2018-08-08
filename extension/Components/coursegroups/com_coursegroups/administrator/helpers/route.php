<?php
/**
 * @package		Coursegroups
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
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
