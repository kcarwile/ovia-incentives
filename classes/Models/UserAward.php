<?php
/**
 * UserAward Model [ActiveRecord]
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
 * UserAward Class
 */
class UserAward extends ActiveRecord
{
	/**
	 * @var	array		Multitons cache (needs to be defined in subclasses also)
	 */
	protected static $multitons = array();
	
	/**
	 * @var	string		Table name
	 */
	protected static $table = 'incentives_useraward';
	
	/**
	 * @var	array		Table columns
	 */
	protected static $columns = array(
		'id',
		'user_id' => [ 'type' => 'varchar', 'length' => 20 ],
		'employer_program_award_id' => [ 'type' => 'varchar', 'length' => 255, 'allow_null' => false ],
		'status' => [ 'type' => 'varchar', 'length' => 20, 'allow_null' => false, 'default' => 'pending' ],
	);
	
	/**
	 * @var	string
	 */
	protected static $plugin_class = 'Ovia\Incentives\Plugin';


}
