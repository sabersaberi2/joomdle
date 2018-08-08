<?php
/**
* @version		1.0
* @package		Jgroups Synch
* @copyright	Qontori Pte Ltd & مهدی آنیلی
* @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once(JPATH_ADMINISTRATOR.'/components/com_joomdle/helpers/content.php');
require_once(JPATH_ADMINISTRATOR.'/components/com_jgroups/helpers/jgroups.php');

class plgUserJgroupsync extends JPlugin
{
	function plgSystemJgroupsync(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }

// مهدی آنیلی {
	function onUserAfterSave ($user, $isnew, $success, $msg) // This event is triggered after an update of a user record, or when a new user has been stored in the database.
	{
		# $user : An associative array of the columns in the user table.
		$this->update_Jgroups_to_Mgroups_mappings ($user['username'], $user['groups']);
	}

    function onUserAfterLogin ($options)
	{
		# $options['user'] : JUser Object
        $user = $options['user'];
		$this->update_Jgroups_to_Mgroups_mappings ($user->username, $user->groups);
	}

	function update_Jgroups_to_Mgroups_mappings ($user_name ,$Jgroups)
	{
		$Mgroups = array ();
		foreach ($Jgroups as $JgroupID)
		{
			$m = JgroupsHelper::get_moodle_group_info ($JgroupID); // $m structure : Array ( [id] => int, [courseid] => int, [name] => text ) 
			if ($m)
				$Mgroups[] = $m;
		}

		if ( count($Mgroups) == 0 )
			return;

        JoomdleHelperContent::call_method ("multiple_add_group_member", $user_name, $Mgroups);

        return true;
	}
// } مهدی آنیلی
}

?>
