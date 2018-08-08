<?php
/**
* @version		1.0
* @package		com_coursegroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.model');
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_coursegroups/tables');

/**
 * Model
 */
class CoursegroupsModelCoursegroups extends JModel
{
	protected $_item;

	/**
	 * Get the data for a banner
	 */
	function &getItem()
	{
		if (!isset($this->_item))
		{
			$cache = JFactory::getCache('com_coursegroups', '');

			$id = $this->getState('coursegroups.id');

			$this->_item =  $cache->get($id);

			if ($this->_item === false) {
				
                // redirect to banner url
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);
				$query->select(
					'a.*'
					);
				$query->from('#__users as a');
				$query->where('a.id = ' . (int) $id);

				$db->setQuery((string)$query);
				if (!$db->query()) {
					JError::raiseError(500, $db->getErrorMsg());
				}

				$this->_item = $db->loadObject();
				$cache->store($this->_item, $id);
			}
		}
		return $this->_item;
	}

}

