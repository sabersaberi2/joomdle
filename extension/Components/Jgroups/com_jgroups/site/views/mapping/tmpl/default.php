<?php
/**
* @version		1.0
* @package		Joomdle JGroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;
?>

<?php if( $this->item ) : ?>

    <div class="item_fields">
        
        <ul class="fields_list">

        
        
                    <li><?php echo 'id'; ?>: 
                    <?php echo $this->item->id; ?></li>

        
        
                    <li><?php echo 'moodle_group_id'; ?>: 
                    <?php echo $this->item->moodle_group_id; ?></li>

        
        
                    <li><?php echo 'joomla_group_id'; ?>: 
                    <?php echo $this->item->joomla_group_id; ?></li>

        

        </ul>
        
    </div>

<?php endif; ?>