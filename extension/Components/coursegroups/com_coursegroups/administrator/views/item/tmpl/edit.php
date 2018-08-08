<?php
/**
* @version		1.0
* @package		com_coursegroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'item.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_coursegroups&view=items&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-horizontal" enctype="multipart/form-data">
	<fieldset>
		<ul class="nav nav-tabs">
		<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('COM_COURSEGROUPS_ITEM');?></a></li>
		</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="details">
					<?php foreach($this->form->getFieldset('item') as $field) :?>
						<div class="control-group">
							<div class="control-label">
								<?php echo JText::_ ($field->label); ?>
							</div>
							<div class="controls">
								<?php echo JText::_ ($field->input); ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
		</div>
	</fieldset>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
