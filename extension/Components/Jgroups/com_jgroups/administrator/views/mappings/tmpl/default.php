<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_jgroups/assets/css/jgroups.css');

$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_jgroups');
$saveOrder	= $listOrder == 'a.ordering';
?>

<form action="<?php echo JRoute::_('index.php?option=com_jgroups&view=mappings'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="clr"> </div>

   <table class="table table-striped">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
				</th>

                <th width="10%" class="nowrap">
				<?php echo JText::_('COM_JGROUPS_ID'); ?>
                </th>
                <th width="45%" class="nowrap">
				<?php echo JText::_('COM_JGROUPS_NAME'); ?>
                </th>
                <th width="45%" class="nowrap">
				<?php echo JText::_('COM_JGROUPS_JOOMLA_GROUP'); ?>
                </th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$ordering	= ($listOrder == 'a.ordering');
			$canCreate	= $user->authorise('core.create',		'com_jgroups');
			$canEdit	= $user->authorise('core.edit',			'com_jgroups');
			$canCheckin	= $user->authorise('core.manage',		'com_jgroups');
			$canChange	= $user->authorise('core.edit.state',	'com_jgroups');
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
				<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_jgroups&task=mapping.edit&id='.$item->id);?>">
                        <?php echo $this->escape($item->moodle_group_name . ' (courseid : ' . $item->moodle_group_courseid . ')'); ?>
                    </a>
				<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_jgroups&task=mapping.edit&id='.$item->id);?>">
                        <?php echo $this->escape($item->joomla_group_name); ?>
                    </a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
