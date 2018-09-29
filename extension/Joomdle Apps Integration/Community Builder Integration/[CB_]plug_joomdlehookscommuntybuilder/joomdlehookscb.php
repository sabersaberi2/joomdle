<?php
// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

include_once( JPATH_ROOT . '/plugins/user/joomdlehooks/joomdlehooks.php' );

// Register CB callbacks - Frontend
$_PLUGINS->registerFunction( 'onAfterUserRegistration', 'newUser','joomdlehookscb' );
$_PLUGINS->registerFunction( 'onAfterUserUpdate', 'updateUser','joomdlehookscb' );
$_PLUGINS->registerFunction( 'onAfterUserAvatarUpdate', 'updateUser','joomdlehookscb' );

// Register CB callbacks - Backend
$_PLUGINS->registerFunction( 'onAfterUpdateUser', 'updateUser','joomdlehookscb' );
$_PLUGINS->registerFunction( 'onAfterNewUser', 'newUser','joomdlehookscb' );
$_PLUGINS->registerFunction( 'onAfterDeleteUser', 'deleteUser','joomdlehookscb' );

// Include our language file (if exists!)
$defaultLanguage = 'english';
$defaultLanguageFile = 'lang/'.$defaultLanguage.'.php';
include( $defaultLanguageFile );


class joomdlehookscb extends cbPluginHandler{
	
        /**
        * Syncs the CB fields to Moodle
        * @param object row
        * @param object rowExtras
        * @returns mixed : 
        */
        function updateUser($row, $rowExtras) {
        	global $_CB_database , $_REQUEST;
        	
			$user = (array) $row;

			plgUserJoomdlehooks::sync_user ($user, 0, true, '');
        }

        function newUser($row, $rowExtras) {
        	global $_CB_database , $_REQUEST;
        	
			$user = (array) $row;
			plgUserJoomdlehooks::sync_user ($user, 1, true, '');
        }
        
        function deleteUser($row, $rowExtras) {
        	global $_CB_database , $_REQUEST;
        	
			$user = (array) $row;
			plgUserJoomdlehooks::delete_user ($user);
        }
        
}

// Install function
function plug_joomdlehookscb_install() {
        return _JOOMDLECB_INSTALL;  
}

// Uninstall function
function plug_joomdlehooks_uninstall() {
        return _JOOMDLECB_UNINSTALL;        
}

?>
