<?php
/**
* @version		1.0
* @package		Joomdle JGroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Mappings list controller class.
 */
class JgroupsControllerMappings extends JController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Mappings', $prefix = 'JgroupsModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}