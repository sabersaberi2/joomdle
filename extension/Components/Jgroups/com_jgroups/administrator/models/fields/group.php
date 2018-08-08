<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd & مهدی آنیلی
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();
require_once(JPATH_SITE.'/components/com_joomdle/helpers/content.php');

class JFormFieldGroup extends JFormField
{
	/**
	* Element type
	*
	* @access	protected
	* @var		string
	*/
	public $type ='Group';

	protected function getInput()
	{
		$attr = $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';

		$groups = JoomdleHelperContent::call_method ('get_groups'); // $groups structure : Array ( [id] => int, [courseid] => int, [name] => text )

		$options = array ();
		if (is_array ($groups))
		{
			foreach ($groups as $group)
			{
				$val = $group['id'];
				$text = $group['name'] . ' (courseid : ' . $group['courseid'] . ')';
				$options[] = JHTML::_('select.option', $val, JText::_($text));
			}
		}
		array_unshift($options, JHTML::_('select.option', '0', '- '.JText::_('COM_JGROUPS_SELECT_MOODLE_GROUP').' -'));

		return JHTML::_('select.genericlist',  $options, $this->name, $attr, 'value', 'text', $this->value, $this->id);
	}
}
