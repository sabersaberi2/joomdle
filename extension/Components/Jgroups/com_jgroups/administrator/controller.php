<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;

class JgroupsController extends JControllerLegacy
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
		require_once JPATH_COMPONENT.'/helpers/jgroups.php';

		// Load the submenu.
		JgroupsHelper::addSubmenu(JRequest::getCmd('view', 'mappings'));

		$view		= JRequest::getCmd('view', 'mappings');
        JRequest::setVar('view', $view);

		parent::display();

		return $this;
	}
}
