<?php
/**
* @version      2.0.0
* @package      Joomdle CB My certificates
* @copyright    Qontori Pte Ltd
* @license      http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

/** ensure this file is being included by a parent file */
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }



/**
 * Basic tab extender. Any plugin that needs to display a tab in the user profile
 * needs to have such a class. Also, currently, even plugins that do not display tabs (e.g., auto-welcome plugin)
 * need to have such a class if they are to access plugin parameters (see $this->params statement).
 */
class getcbmycertificatesTab extends cbTabHandler {

	private $certs;

	/**
	 * Construnctor
	 */
	// function getcbmycertificatesTab() {
	function __construct() {
		$this->cbTabHandler();
	}

	/**
     * Labeller for title:
     * Returns a profile view tab title
     *
     * @param  TabTable   $tab       the tab database entry
     * @param  UserTable  $user      the user being displayed
     * @param  int        $ui        1 for front-end, 2 for back-end
     * @param  array      $postdata  _POST data for saving edited tab content as generated with getEditTab
     * @return string|boolean        Either string HTML for tab content, or false if ErrorMSG generated
     */
    public function getTabTitle( $tab, $user, $ui, $postdata )
    {
        $plugin     =   cbarticlesClass::getPlugin();
        $viewer     =   CBuser::getMyUserDataInstance();

		if (!$this->certs)
		{
			$username = $user->get('username');
			$this->certs = JoomdleHelperContent::call_method ("my_certificates", $username, 'normal');
		}
		$total = count ($this->certs);

        return parent::getTabTitle( $tab, $user, $ui, $postdata ) . ' <span class="badge badge-default">' . (int) $total . '</span>';
    }

	
	/**
	* Generates the HTML to display the user profile tab
	* @param object tab reflecting the tab database entry
	* @param object mosUser reflecting the user being displayed
	* @param int 1 for front-end, 2 for back-end
	* @returns mixed : either string HTML for tab content, or false if ErrorMSG generated
	*/
	function getDisplayTab($tab,$user,$ui) {

		require_once(JPATH_ADMINISTRATOR.'/components/com_joomdle/helpers/content.php');

		$return = null;
		
		$params = $this->params; // get parameters (plugin and related tab)
		
		$comp_params = JComponentHelper::getParams( 'com_joomdle' );
		$moodle_url = $comp_params->get( 'MOODLE_URL' );
		$target = $comp_params->get( 'linkstarget' );


		$show_send_certificate = $params->get('show_send_certificate');
		$cert_type = $params->get('certificate_type');

        $simple = '';
        if ($cert_type == 'simple')
            $simple = 'simple';

		$my = JFactory::getUser();
		$username = $user->get('username');

		if (!$this->certs)
			$this->certs = JoomdleHelperContent::call_method ("my_certificates", $username, $cert_type);

		$return .= "\t\t<div>\n"
		  .  '<ul class="menu">';

		if (is_array($this->certs)) {
			foreach ($this->certs as $id => $cert) {
				$id = $cert['id'];

				$profile_user_id = $user->get('id');
				if ($my->id == $profile_user_id )
				{
					$redirect_url = $moodle_url."/mod/${simple}certificate/view.php?id=$id&certificate=1&action=review";

					$return .= "<li><a $target href=\"".$redirect_url."\">".$cert['name']."</a></li>";

				}
				else
					$return .= "<li>".$cert['name']."</li>";
			}
		}

		$return .= "</ul>" 

			. "</div>\n";
	
		return $return;
	} // end or getDisplayTab function
} // end of gethelloworldTab class
?>
