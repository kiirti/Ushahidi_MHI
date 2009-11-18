<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This is the controller for managing instances.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Instances Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Instances_Controller extends Admin_Controller {

  public function __construct(){
    parent::__construct();
    $this->template->this_page = 'instances';

    // If this is not a super-user account, redirect to dashboard
    if (!$this->auth->logged_in('admin') && !$this->auth->logged_in('superadmin'))
    {
      url::redirect('');
    }
  }

  public function index($message = ""){
    $view = new View('admin/instances');

    $db = Database::instance();    
    $sites = $db->query("SELECT B.username,B.email,A.id,is_approved,sitename,subdomain,tagline FROM sites AS A JOIN users AS B ON (A.user_id = B.id) ORDER BY is_approved");
    $view->set("sites", $sites);
    $view->set("message", $message);
    $this->template->content = $view;
    $this->template->content->title = 'Instances';
    $this->template->content->total_items = count($sites); 
  }

  public function approve($site){
    $message = "Site approved!";  
    $site = ORM::factory('site', $site);
    $user = ORM::factory('user', $site->user_id);

    // setup the site.
    $cmd = getcwd() . Kohana::config('settings.create_db');
    $cmd .= " " . escapeshellarg($site->dbuser) . " " 
        . escapeshellarg($site->dbpass) 
        . " " . escapeshellarg($site->dbdatabase)
        . " " . escapeshellarg($user->username)
        . " " . escapeshellarg($user->password)
        . " " . escapeshellarg($user->email)
        . " >> " . Kohana::config('settings.create_db_log')
        . " 2>&1";

    file_put_contents(Kohana::config('settings.create_db_log'), "\n\n---------\n$cmd", FILE_APPEND);
    system($cmd);

    // tell the user about this. 
    mail($user->email, "Site Approved", "Your site has been approved");

    // And approve the site.
    $site->is_approved = true;
    $site->save();

    url::redirect("/admin/instances/index/$message");
  }

  public function unapprove($site){
    $message = "Site Un-approved!"; 
    $site = ORM::factory('site', $site);
    $user = ORM::factory('user', $site->user_id);
    mail($user->email, "Site Un-Approved", "Your site has been unapproved");
    $site->is_approved = false;
    $site->save();
    url::redirect("/admin/instances/index/$message");
  }
}
?>
