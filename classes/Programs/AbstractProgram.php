<?php
/**
 * AbstractProgram Class
 *
 * Created:   November 5, 2021
 *
 * @package:  Ovia Incentives Management
 * @author:   Kevin Carwile
 * @since:    {build_version}
 */
namespace Ovia\Incentives\Programs;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use Ovia\Incentives\Models\User;
use Ovia\Incentives\Models\EmployerProgram;
use Ovia\Incentives\Models\UserProgress;

/**
 * AbstractProgram
 */
abstract class AbstractProgram
{
	/**
	 * Get the program key
	 *
	 * @return	string
	 */
	abstract public function getKey();

	/**
	 * Get the program name
	 *
	 * @return	string
	 */
	abstract public function getName();

	/**
	 * Process an app event for a given user
	 * 
	 * @param	array				$event				The event details
	 * @param	UserProgress		$userProgess		The user progress tracker for the program
	 * @return	void
	 */
	abstract public function processEvent( $event, UserProgress $userProgress );

	/**
	 * Get the progress tracker for a user
	 * 
	 * @param	User				$user					The user to get the tracker for
	 * @param	EmployerProgram		$employerProgram		The employer program progress is being tracked for
	 * @return	UserProgress
	 * @throws	OutOfRangeException
	 */
	public function getUserProgress( User $user, EmployerProgram $employerProgram ) {
		// Get a user progress tracker for the program to use
		$userProgress = UserProgress::loadWhere([ '
			user_id = %s AND 
			employer_program_id = %d AND 
			status = %s
			', $user->id(), $employerProgram->id(), 'in_progress' ])[0];

		if ( ! $userProgress ) {			
			$userProgress = new UserProgress;
			$userProgress->user_id = $user->user_id;
			$userProgress->employer_program_id = $employerProgram->id();
			$userProgress->status = 'in_progress';
			$userProgress->save();
		}

		return $userProgress;
	}

}
