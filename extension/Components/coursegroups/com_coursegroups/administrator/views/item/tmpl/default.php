<?php
/**
* @version		1.0
* @package		com_coursegroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
JToolBarHelper::save('save_group');
JToolBarHelper::cancel('cancel_edit');
//require_once (JPATH_COMPONENT.DS.'elements'.DS.'courselist.php' );

?>
<form action="index.php" method="post" name="adminForm" autocomplete="off">
<fieldset class="adminform">
	<legend><?php echo JText::_( 'COM_COURSEGROUPS_LEGEND_ITEM' ); ?></legend>
	<table class="admintable" cellspacing="1">

		<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_COURSEGROUPS_LEGEND_ITEM' ); ?>::<?php echo JText::_('COM_COURSEGROUPS_LEGEND_ITEM'); ?>">
					<?php echo JText::_( 'COM_COURSEGROUPS_LEGEND_ITEM' ); ?>
				</span>
			</td>
			<td>
			   <?php echo $this->item->title; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_COURSEGROUPS_COURSES' ); ?>::<?php echo JText::_('COM_COURSEGROUPS_COURSES'); ?>">
					<?php echo JText::_( 'COM_COURSEGROUPS_COURSES' ); ?>
				</span>
			</td>
			<td>
				<?php echo $this->lists['courses']; ?>
			</td>
		</tr>
		</tbody>
	</table>
</fieldset>
  <input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' );?>"/>
       <input type="hidden" name="task" value=""/>
       <input type="hidden" name="boxchecked" value="0"/>
       <input type="hidden" name="hidemainmenu" value="0"/>
       <input type="hidden" name="usergroup_id" value="<?php echo $this->item->id; ?>"/>
       <?php echo JHTML::_( 'form.token' ); ?>

</form>
