<?php
/**
* @version		1.0
* @package		Joomdle JGroups
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Mapping controller class.
 */
class JgroupsControllerMapping extends JController
{

    function __construct() {
        $this->view_list = 'mappings';
        parent::__construct();
    }

}