<?php
/**
  * @package      Joomdle
  * @copyright    Qontori Pte Ltd
  * @license      http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
  */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Joomdle component
 */
class JoomdleViewWrapper extends JViewLegacy {
    function display($tpl = null) {

        $app                = JFactory::getApplication();
        $params = $app->getParams();
        $this->assignRef('params',              $params);

        $this->wrapper = new JObject ();
        $this->wrapper->load = '';

        $mtype = $app->input->get('moodle_page_type');
        if (!$mtype)
            $mtype = $params->get( 'moodle_page_type' );
        $id = $params->get( 'course_id' );
        if (!$id)
            $id = $app->input->get('id');

        $id = (int) $id;

        $day = $app->input->get('day');
        $mon = $app->input->get('mon');
        $year = $app->input->get('year');

        $lang = $app->input->get('lang');

        $topic = $app->input->get('topic');
        $redirect = $app->input->get('redirect');
        $hash = $app->input->get('hash');

        switch ($mtype)
        {
            case "course" :
                $path = '/course/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                if ($topic)
                    $this->wrapper->url .= '&topic='.$topic;
                break;
            case "news" :
                $path = '/mod/forum/discuss.php?d=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "forum" :
                $path = '/mod/forum/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "event" :
                $date = new DateTime("$year-$mon-$day");
                $time = $date->getTimestamp();
                $path = "/calendar/view.php?view=day&time=$time";
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path;
                break;
            case "user" :
                $path = '/user/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "edituser" :
                $user = JFactory::getUser ();
                $id = JoomdleHelperContent::call_method ('user_id', $user->username);
                $path = '/user/edit.php?&course_id=1&id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "resource" :
                $path = '/mod/resource/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "quiz" :
                $path = '/mod/quiz/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "page" :
                $path = '/mod/page/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "assignment" :
                $path = '/mod/assignment/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "folder" :
                $path = '/mod/folder/view.php?id=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                break;
            case "messages" :
                $path = '/message/index.php';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path;
                break;
            case "badge" :
                $path = '/badges/badge.php?hash=';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$hash;
                break;
            case "moodle" :
                $path = '/?a=1';
                $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path;
                break;
            case "fullurl" :
                $gotourl = $app->input->get('gotourl', '', STRING);
                $this->wrapper->url = $gotourl;
                break;
            default:
                if ($mtype)
                {
                    $path = '/mod/'.$mtype.'/view.php?id=';
                    $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path.$id;
                    break;
                }
                else
                {
                    $path = '/?a=1';
                    $this->wrapper->url = $params->get( 'MOODLE_URL' ).$path;
                }
                break;
        }

        if ($lang)
            $this->wrapper->url .= "&lang=$lang";

        if ($redirect)
            $this->wrapper->url .= "&redirect=$redirect";

        // Moodle theme can be overriden by plugin
        JPluginHelper::importPlugin( 'joomdletheme' );
        $dispatcher = JDispatcher::getInstance();
        $result = $dispatcher->trigger('onGetMoodleTheme', array ());
        $theme = array_shift ($result);

        if (!$theme) // If no theme by plugin, check configuration
            $theme = $params->get('theme');
        if ($theme) 
            $this->wrapper->url .= "&theme=".$theme;

        if ($this->params->get('crossdomain_autoheight'))
            $tpl = 'cross';

        parent::display($tpl);
    }
}
?>
