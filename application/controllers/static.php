<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This controller is used to view static pages (About us and Contact)
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Help Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class Static_Controller extends Main_Controller 
{
    protected $default = "aboutus";
	function __construct()
	{
		parent::__construct();

		// Javascript Header
		$this->template->header->validator_enabled = TRUE;
        $this->template->content = new View('static/'.$this->default);
	}
	
	 /**
	 * Displays a view
	 * @param boolean $id If id is supplied, an organization with that id will be
	 * retrieved.
	 */
	public function view($view)
	{
		$this->template->header->this_page = 'help';
		$this->template->content = new View('static/'.$view);
		
	}
}
