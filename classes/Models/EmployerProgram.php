<?php
/**
 * EmployerProgram Model [ActiveRecord]
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
 * EmployerProgram Class
 */
class EmployerProgram extends ActiveRecord
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
	protected static $table = 'incentives_employerprogram';
	
	/**
	 * @var	array		Table columns
	 */
	protected static $columns = array(
		'id',
		'title' => [ 'type' => 'varchar', 'length' => 255 ],
		'employer_id' => [ 'type' => 'int', 'length' => 20 ],
		'program_key' => [ 'type' => 'varchar', 'length' => 20 ],
		'config' => [ 'type' => 'text', 'format' => 'JSON' ],
	);
	
	/**
	 * @var	string
	 */
	protected static $plugin_class = 'Ovia\Incentives\Plugin';

	/**
	 * Process an app event for a given user
	 * 
	 * @param	array				$event				The event details
	 * @param	UserProgress		$userProgess		The user progress tracker for the program
	 * @return	void
	 * @throws 	LogicException
	 */
	public function processEvent( $event, UserProgress $userProgress ) { 
		try {
			$this->getProgram()->processEvent( $event, $userProgress );
		}
		catch( \OutOfRangeException $e ) {
			throw new \LogicException( 'Program not found when trying to process an event for employer program: ' . $this->id() );
		}
	}

	/**
	 * Get the progress tracker for a user
	 * 
	 * @param	User			$user			The user to get the tracker for
	 * @return	UserProgress
	 */
	public function getUserProgress( User $user ) {
		return $this->getProgram()->getUserProgress( $user, $this );
	}

	/**
	 * Get the program
	 * 
	 * @return	Ovia\Incentives\Programs\AbstractProgram
	 * @throws	OutOfRangeException
	 */
	public function getProgram() {
		return $this->getPlugin()->getProgram( $this->program_key );
	}

	/**
	 * Get the associated employer 
	 * 
	 * @return	Employer
	 * @throws 	OutOfRangeException
	 */
	public function getEmployer() {
		return Employer::load( $this->employer_id );
	}

	/**
	 * Get the awards assigned to this employer program
	 *
	 * @return	array[EmployerProgramAward]
	 */
	public function getProgramAwards() {
		return EmployerProgramAward::loadWhere([ 'employer_program_id = %d', $this->id() ]);
	}

}
