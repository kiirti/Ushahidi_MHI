<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This is the controller for the main site.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Main Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
class Signup_Controller extends Template_Controller {
  // Cache instance
  protected $cache;

  // user password
  protected $password;

  public $auto_render = TRUE;

  // Main template
  public $template = 'layout';

  // User
  public $user;

  // Site
  public $site;

  public function __construct(){
    parent::__construct();

    // Load cache
    $this->cache = new Cache;
    $this->auth = new Auth();

	// Global settings
	$site_name = Kohana::config('settings.site_name');

	// Load Header & Footer
	$this->template->header  = new View('header');
	$this->template->footer  = new View('footer');

	$this->template->header->site_name = $site_name;

	// Session info
	$this->session = Session::instance();

    // Retrieve Default Settings
    $site_name = Kohana::config('settings.site_name');
    // Prevent Site Name From Breaking up if its too long
    // by reducing the size of the font
    if (strlen($site_name) > 20){
      $site_name_style = " style=\"font-size:21px;\"";
    } else {
      $site_name_style = "";
    }
    $this->template->header->site_name = $site_name;
    $this->template->header->site_name_style = $site_name_style;
    $this->template->header->site_tagline = Kohana::config('settings.site_tagline');
    $this->template->header->api_url = Kohana::config('settings.api_url');

    // Javascript Header
    $this->template->header->map_enabled = FALSE;
    $this->template->header->validator_enabled = FALSE;
    $this->template->header->datepicker_enabled = FALSE;
    $this->template->header->photoslider_enabled = FALSE;
    $this->template->header->videoslider_enabled = FALSE;
    $this->template->header->main_page = FALSE;
    $this->template->header->js = new View('footer_form_js');

    // Display News Feed?
    $this->template->header->allow_feed = Kohana::config('settings.allow_feed');

    $this->template->header->this_page = "";

    // Google Analytics
    $google_analytics = Kohana::config('settings.google_analytics');
    $this->template->footer->google_analytics = $this->_google_analytics($google_analytics);
    $this->template->header->site_language = Kohana::config('locale.language');
    //Set up tracking gif
    if($_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['SERVER_NAME'] != '127.0.0.1'){
      $track_url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
    }else{
      $track_url = 'null';
    }
    $this->template->footer->tracker_url = 'http://tracker.ushahidi.com/track.php?url='.urlencode($track_url).'&lang='.$this->template->header->site_language.'';

    // User
    if(array_key_exists('auth_user', $_SESSION)){
      $this->user = new User_Model($_SESSION['auth_user']->id);
    }
  } 

  public function page1(){
    $view = new View('signup/page1'); 

	// Load Captcha library, you can supply the name of the config group you would like to use.
	$captcha = new Captcha;

    // Form info
	$form = array (
        'username' => '',
		'password' => '',
		'password_confirm' => '',
		'email' => '',
	);

	//  copy the form as errors, so the errors will be stored with keys corresponding to the form field names
	$errors = $form;

	// Ban bots (that accept session cookies) after 50 invalid responses.
	// Be careful not to ban real people though! Set the threshold high enough.
	if ($captcha->invalid_count() > 49)
	  exit('Bye! Stupid bot.');
	 
	// Form submitted
	if ($_POST){
	  // Add some rules, the input field, followed by a list of checks, carried out in order
	  $valid_c = Captcha::valid($this->input->post('captcha_response'));
	  $this->user = ORM::factory('user');
      $post = $this->input->post();

	  if($this->user->validate($post) && $valid_c){  
  	    $this->user->save();
		$this->session->set('uid', $this->user->id);  
        $this->user->add(ORM::factory('role', 'login'));
		$this->auth->login($this->user, $post['password']);

        url::redirect('/signup/page2' );
		exit(0);
	  } else {
        // repopulate the form fields
	    $form = arr::overwrite($form, $post->as_array());
        $errors = arr::overwrite($errors, $post->errors('signup_errors'));
		if(!$valid_c){
          $errors['captcha_response'] = "Invalid";
		}
	  }
	}

	// Put the vars in the template
	$view->set("errors", $errors);
	$this->template->content = $view;
	$this->template->content->captcha = $captcha;
	$this->template->content->form = $form;
  }

  public function page2(){

    // Go to page1 if they don't have a valid session
	// This also loads the user info  
    $this->_check_session();

    $view = new View('signup/page2');

    // Form info
	$form = array (
	  'sitename' => '',		
	  'subdomain' => '',
	  'tagline' => '',
	  'description' => '',
	  'keywords' => '',
	  'public' => '',
	);
    $errors = $form;

	// Form submitted
	if ($_POST){
	  // Instantiate Validation, use $post, so we don't overwrite $_POST fields with our own things
      $post = $this->input->post();
      $this->site = ORM::factory('site');

      $post['subdomain'] = strtolower($post['subdomain']);

	  if ($this->site->validate($post)){
	    //$this->site->is_public = ($post['public'])? true: false;
        $this->site->is_public = true;
		$this->site->user_id = $this->user->id;
		$this->site->tagline = $post['tagline'];
        $this->site->dbuser = $this->user->username;
        $this->site->dbpass = $this->user->password;
        $this->site->dbhost = Kohana::config('settings.instance_dbhost');
        $this->site->dbdatabase = $post['subdomain']."_instancedb";
		$this->site->save();
        url::redirect('/signup/page3/'.$this->site->id);
   	  	exit(1);
	  } else {
	    // repopulate the form fields
		$form = arr::overwrite($form, $post->as_array());
		$errors = arr::overwrite($errors, $post->errors('signup_errors'));
	  }
	}

	// Put the vars in the template
    $view->set("errors", $errors);
	$this->template->content = $view;
	$this->template->content->form = $form;
  }

  public function page3($id){

	// Go to page1 if they don't have a valid session
	$this->_check_session();
	$view = new View('signup/page3');
	$site = ORM::factory('site', $id);

    // And dispaly the link to the new site.
	$view->set("newsite", ($site->subdomain).Kohana::config('settings.hosting_domain'));
	$this->template->content = $view;
  }

  // Redirects to the homepage if a valid session isn't present.
  public function _check_session(){
    if (!$this->auth->logged_in('admin')
      && !$this->auth->logged_in('login'))
    {
      url::redirect('');
      exit(0);
    }
  }
}

?>
