<?php
/**
 * UserProgress Model [ActiveRecord]
 *
 * Created:   November 6, 2021
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
 * UserProgress Class
 */
class UserProgress extends ActiveRecord
{
	/**
	 * @var	string		Table primary key
	 */
	protected static $key = 'id';
	
	/**
	 * @var	array		Multitons cache (needs to be defined in subclasses also)
	 */
	protected static $multitons = array();
	
	/**
	 * @var	string		Table name
	 */
	protected static $table = 'incentives_userprogress';
	
	/**
	 * @var	array		Table columns
	 */
	protected static $columns = array(
		'id',
		'user_id' => [ 'type' => 'varchar', 'length' => 20 ],
		'employer_program_id' => [ 'type' => 'int', 'lenth' => 20, 'allow_null' => false ],
		'status' => [ 'type' => 'varchar', 'length' => 15, 'allow_null' => false, 'default' => 'in_progress' ],
		'data' => [ 'type' => 'text', 'format' => 'JSON' ],
	);
	
	/**
	 * @var	string
	 */
	protected static $plugin_class = 'Ovia\Incentives\Plugin';
	
	/**
	 * Get the internal user object
	 *
	 * @return User
	 * @throws OutOfRangeException
	 */
	public function getUser() {
		return User::load( $this->uid );
	}

	/**
	 * Get the employer program
	 * 
	 * @return EmployerProgram
	 * @throws OutOfRangeException
	 */
	public function getEmployerProgram() {
		return EmployerProgram::load( $this->employer_program_id );
	}
}
