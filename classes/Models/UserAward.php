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

	/**
	 * Deliver this award
	 * 
	 * @return	void
	 * @throws 	LogicException
	 */
	public function deliver() {
		try {
			$award = $this->getEmployerProgramAward()->getAward();
			$award->deliverAward( $this );
		}
		catch( \OutOfRangeException $e ) {
			throw new \LogicException( 'Could not deliver the award due to missing resources.' );
		}
	}

	/**
	 * Get the employer program award
	 * 
	 * @return EmployerProgramAward
	 * @throws OutOfRangeException
	 */
	public function getEmployerProgramAward() {
		return EmployerProgramAward::load( $this->employer_program_award_id );
	}
}
