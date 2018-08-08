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
require_once( JPATH_ADMINISTRATOR.'/components/com_joomdle/helpers/content.php' );


/**
 * View to edit
 */
class CoursegroupsViewItem extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		/*
		$selected_courses = CoursegroupsHelper::get_course_groups ($this->item->id);

		$courses = JoomdleHelperContent::getCourseList (0);
        $options = array ();
        foreach ($courses as $course)
        {
                $val = $course['remoteid'];
                $text = $course['fullname'];
                $options[] = JHTML::_('select.option', $val, $text);
        }
        $this->lists['courses'] =  JHTML::_('select.genericlist', $options, 'courses[]', 'class="inputbox" size="10" multiple="multiple"', 'value', 'text', $selected_courses );
*/

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
        if (isset($this->item->checked_out)) {
		    $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
        } else {
            $checkedOut = false;
        }
		$canDo		= CoursegroupsHelper::getActions();

		JToolBarHelper::title(JText::_('COM_COURSEGROUPS_TITLE_ITEM'), 'item.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||($canDo->get('core.create'))))
		{

			JToolBarHelper::apply('item.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('item.save', 'JTOOLBAR_SAVE');
		}
		if (!$checkedOut && ($canDo->get('core.create'))){
			JToolBarHelper::custom('item.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::custom('item.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('item.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
		}

	}
}
