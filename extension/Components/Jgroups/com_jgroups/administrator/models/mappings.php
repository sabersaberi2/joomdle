<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

require_once(JPATH_ADMINISTRATOR.'/components/com_joomdle/helpers/content.php');


/**
 * Methods supporting a list of Jgroups records.
 */
class JgroupsModelmappings extends JModelList
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'moodle_group_id', 'a.moodle_group_id',
                'joomla_group_id', 'a.joomla_group_id',

            );
        }

        parent::__construct($config);
    }


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_jgroups');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.id', 'asc');
	}


	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}


// مهدی آنیلی {
	public function getItems()
    {
		$db           =& JFactory::getDBO();
        $query = 'SELECT m.*, g.title as joomla_group_name' .
            ' FROM #__jgroups_mappings as m' .
			' JOIN #__usergroups as g' .
			' ON m.joomla_group_id = g.id';

		$db->setQuery($query);
		$mappings = $db->loadObjectList();
        /*
        $mappings structure : jgroups_mappings.id  jgroups_mappings.moodle_group_id  jgroups_mappings.joomla_group_id  usergroups.title
        stdClass object ( 
        [0] => Properties ( [id] => ?, [moodle_group_id] => ?, [joomla_group_id] => ?, [joomla_group_name] => ? ), 
        [1] => Properties ( [id] => ?, [moodle_group_id] => ?, [joomla_group_id] => ?, [joomla_group_name] => ? ), 
        ...
              ) 
        */

		$groups = JoomdleHelperContent::call_method ('get_groups'); // $groups structure : Array ( [id] => int, [courseid] => int, [name] => text )

		$m = array ();
		foreach ($mappings as $mapping)
		{
			foreach ($groups as $group)
			{
				if  ($group['id'] == $mapping->moodle_group_id)
				{
					$mapping->moodle_group_name = $group['name'];
                    $mapping->moodle_group_courseid = $group['courseid'];
					break;
				}
			}

			$m[] = $mapping;
		}

		return $m;
	}
// } مهدی آنیلی


	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from('`#__jgroups_mappings` AS a');




		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                
			}
		}
        
        
        
        
		// Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering');
        $orderDirn	= $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->getEscaped($orderCol.' '.$orderDirn));
        }

		return $query;
	}
}
