<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Mapping controller class.
 */
class JgroupsControllerMapping extends JControllerForm
{

    function __construct() {
        $this->view_list = 'mappings';
        parent::__construct();
    }

}