<?php defined('SYSPATH') or die('No direct script access.');
/**
 * "My Profile" - allows admin to configure their settings
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Admin Profile Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Profile_Controller extends Admin_Controller
{
	protected $user_id;
	
	function __construct()
	{
		parent::__construct();
		$this->template->this_page = 'profile';
		
		$this->user_id = $_SESSION['auth_user']->id;
	}
	
	public function index()
	{
		$this->template->content = new View('admin/profile');
		
		// setup and initialize form field names
		$form = array
	    (
			'username' 	=> '',
			'password'  => '',
			'password_again'  => '',
			'name'  	=> '',
			'email' 	=> '',
			'notify'  	=> ''
	    );
		
        //  Copy the form as errors, so the errors will be stored with keys
        //  corresponding to the form field names
        $errors = $form;
		$form_error = FALSE;
		$form_saved = FALSE;
		
		// check, has the form been submitted, if so, setup validation
	    if ($_POST)
	    {
	        $post = Validation::factory($_POST);
			
	         //  Add some filters
	        $post->pre_filter('trim', TRUE);
			$post->add_rules('name','required','length[3,100]');
			$post->add_rules('email','required','email','length[4,64]');
			$post->add_callbacks('email',array($this,'email_exists_chk'));
			
			// If Password field is not blank
			if (!empty($post->password))
			{
				$post->add_rules('password','required','length[5,16]'
					,'alpha_numeric','matches[password_again]');
			}
			
			if ($post->validate())
	        {
				$user = ORM::factory('user',$this->user_id);
				if ($user->loaded)
				{
					$user->name = $post->name;
					$user->email = $post->email;
					$user->notify = $post->notify;
					$post->password !='' ? $user->password=$post->password : '';
					$user->save();
				}
				
				$form_saved = TRUE;
				
				// repopulate the form fields
	            $form = arr::overwrite($form, $post->as_array());
				$form['password'] = "";
				$form['password_again'] = "";
			}
            else 
            {
				// repopulate the form fields
	            $form = arr::overwrite($form, $post->as_array());

	            // populate the error fields, if any
	            $errors = arr::overwrite($errors, $post->errors('auth'));
				$form_error = TRUE;
			}
	    }
		else
		{
			$user = ORM::factory('user',$this->user_id);
			$form['username'] = $user->username;
			$form['name'] = $user->name;
			$form['email'] = $user->email;
			$form['notify'] = $user->notify;
		}

        $this->template->content->form = $form;
	    $this->template->content->errors = $errors;
		$this->template->content->form_error = $form_error;
		$this->template->content->form_saved = $form_saved;
		$this->template->content->yesno_array = array('1'=>'YES','0'=>'NO');
		
		// Javascript Header
	}
	
	
	/**
	 * Checks if email address is associated with an account.
	 * @param Validation $post $_POST variable with validation rules 
	 */
	public function email_exists_chk( Validation $post )
	{
		if( array_key_exists('email',$post->errors()))
			return;
		
		$users = ORM::factory('user')
			->where('id <> '.$this->user_id);
				
		if( $users->email_exists( $post->email ) )
			$post->add_error('email','exists');
	}
}