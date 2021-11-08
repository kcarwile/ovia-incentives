<?php
/**
 * EmployerProgramAward Model [ActiveRecord]
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
 * EmployerProgramAward Class
 */
class EmployerProgramAward extends ActiveRecord
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
	protected static $table = 'incentives_employerprogramaward';
	
	/**
	 * @var	array		Table columns
	 */
	protected static $columns = array(
		'id',
		'title' => [ 'type' => 'varchar', 'length' => 255 ],
		'employer_program_id' => [ 'type' => 'int', 'length' => 20, 'allow_null' => false ],
		'award_key' => [ 'type' => 'varchar', 'length' => 20 ],
		'config' => [ 'type' => 'text', 'format' => 'JSON' ],
	);
	
	/**
	 * @var	string
	 */
	protected static $plugin_class = 'Ovia\Incentives\Plugin';

	/**
	 * Get the program
	 * 
	 * @return	Ovia\Incentives\Programs\AbstractAward
	 * @throws	OutOfRangeException
	 */
	public function getAward() {
		return $this->getPlugin()->getAward( $this->award_key );
	}

	/**
	 * Get the employer program
	 * 
	 * @return	EmployerProgram
	 * @throws	OutOfRangeException
	 */
	public function getEmployerProgram() {
		return EmployerProgram::load( $this->employer_program_id );
	}

	/**
	 * Grant this award to a user
	 * 
	 * @param	User		$user			The user to grant the award to
	 * @return	void
	 * @throws 	LogicException
	 */
	public function grantAward( User $user ) {
		try {
			$award = $this->getAward();
		}
		catch( \OutOfRangeException $e ) {
			throw new \LogicException( 'Could not load award when granting for: ' . $this->id() );
		}
				
		$award->grantAward( $user, $this );
	}

}
