<?php
/**
* @version		1.0
* @package		com_coursegroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
require_once JPATH_COMPONENT . '/helpers/route.php';

/**
 * View class for a list of Coursegroups.
 */
class CoursegroupsViewItems extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
        JToolbarHelper::title(JText::_('COM_COURSEGROUPS_ITEMS'), 'items');

		JToolBarHelper::addNew('item.add','JTOOLBAR_NEW');
		JToolBarHelper::editList('item.edit','JTOOLBAR_EDIT');

		JToolBarHelper::deleteList('', 'mappings.delete','JTOOLBAR_DELETE');

        JHtmlSidebar::setAction('index.php?option=com_coursegroups&view=items');
	}
}
