<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     City Model  
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class Site_Model extends ORM
{
	// Database table name
	protected $table_name = 'sites';

	protected $belongs_to =  array('users');
    protected $has_many = array('incidents');

    public function validate(array & $array, $save = FALSE) {
	  $array = Validation::factory($array)
	      ->pre_filter('trim')
		  ->add_rules('sitename', 'required', 'length[4,127]', array($this, 'sitename_exists'))
	      ->add_rules('subdomain', 'required', 'length[3,20]', 'chars[a-zA-Z0-9]', array($this, 'domain_unique'))
		  ->add_rules('description', 'required')
		  ->add_rules('keywords', 'required')
          ->add_rules('tagline', 'required');
	  return parent::validate($array, $save);
	}

	/**
	 * Allows a model to be loaded by sitename.
	 */
	public function unique_key($id) {
	  return parent::unique_key($id);
	}

    public function domain_unique($id) {
	   return ($this->db
	     ->where('subdomain', $id)
	     ->count_records($this->table_name))? false: true;
    }

	public function sitename_exists($id) {
	  return ($this->db
	       ->where('sitename', $id)
	       ->count_records($this->table_name))? false: true;
	}
}
