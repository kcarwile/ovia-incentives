<?php
/**
 * User Model [ActiveRecord]
 *
 * Created:   November 5, 2021
 *
 * @package:  Ovia Incentives Management
 * @author:   Kevin Carwile
 * @since:    {build_version}
 */
namespace Ovia\Incentives\Models;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use MWP\Framework\Pattern\ActiveRecord;

/**
 * User Class
 */
class User extends ActiveRecord
{
	/**
	 * @var	string		Table primary key
	 */
	protected static $key = 'user_id';
	
	/**
	 * @var	array		Multitons cache (needs to be defined in subclasses also)
	 */
	protected static $multitons = array();
	
	/**
	 * @var	string		Table name
	 */
	protected static $table = 'incentives_user';
	
	/**
	 * @var	array		Table columns
	 */
	protected static $columns = array(
		'user_id' => [ 'type' => 'varchar', 'length' => 20, 'allow_null' => false ],
		'employer_id' => [ 'type' => 'int', 'length' => 20, 'allow_null' => false, 'default' => 0 ],
	);
	
	/**
	 * @var	string
	 */
	protected static $plugin_class = 'Ovia\Incentives\Plugin';
	
	/**
	 * Get the employer
	 * 
	 * @return	Employer
	 * @throws 	OutOfRangeException
	 */
	public function getEmployer() {
		return Employer::load( $this->employer_id );
	}

}
