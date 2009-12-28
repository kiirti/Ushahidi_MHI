<?php defined('SYSPATH') or die('No direct script access.');

/**
* Model for Media files: photos, videos of incidents or locations
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Media Model  
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class Audio_Trans_Model extends ORM
{
	// Database table name
	protected $table_name = 'audio_trans';

    /**
      * Allows a model to be loaded by filename.
      */
    public function unique_key($id)
    {
        if ( ! empty($id) AND is_string($id) AND ! ctype_digit($id))
        {
            if (file_exists($id))
              return 'filename';
            return 'hit_id';
        }

        return parent::unique_key($id);
    }

    // Getters and setters
    // TODO:              return strtotime($this->object->$key);
    public function __get($key)
    {
      return parent::__get($key);
    }

    public function __set($key, $value)
    {
        if($key == "translated_on"){
            parent::__set($key, gmdate("Y-m-d H:i:s", $value));
        } 
        return parent::__set($key, $value);
    }
}
