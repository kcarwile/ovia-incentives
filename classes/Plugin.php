<?php
/**
 * Plugin Class File
 *
 * @vendor: Ovia Health
 * @package: Ovia Incentives Management
 * @author: Kevin Carwile
 * @link: 
 * @since: November 5, 2021
 */
namespace Ovia\Incentives;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use Ovia\Incentives\Models;

/**
 * Plugin Class
 */
class Plugin extends \MWP\Framework\Plugin
{
	/**
	 * Instance Cache - Required
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string		Plugin Name
	 */
	public $name = 'Ovia Incentives Management';

	/**
	 * @var array		Available Programs
	 */
	protected $programs = [];

	/**
	 * @var	array		Available Awards
	 */
	protected $awards = [];
	
	/**
	 * Process events received from Ovia apps
	 * 
	 * @MWP\Wordpress\Action( for="ovia_process_event" )
	 * 
	 * @param	MWP\Framework\Task 			$task			The queued task
	 * @return	void
	 */
	public function processEvent( \MWP\Framework\Task $task ) 
	{
		/**
		 * Task Runner Notes.
		 * 
		 * Will be run repeatedly for $task until one of $task->complete() 
		 * or $task->fail() is called.
		 * 
		 * $task->getData() and $task->setData() read and write data to persistence
		 */

		$user_id = $task->getData('user_id');
		$event = $task->getData('event');

		// Ensure we have a valid user
		try {
			$user = Models\User::load( $user_id );
		}
		catch( \OutOfRangeException $e ) {
			
			/**
			 *  Create new user if user doesn't exist already.
			 * 
			 *	In a distributed system, we'll likely want to queue up the creation of
			 *  a user here and delay this task until that has been completed.
			 */

			$user = new Models\User;
			$user->user_id = $user_id;
			$user->employer_id = 0;
			$user->save();
		}

		// Get the employer programs which still need to be notified of the event
		$remainingPrograms = $task->getData('remaining_programs');

		// On first pass, initialize the list of employer programs that need to be notified
		if ( is_null( $remainingPrograms ) ) {

			// Ensure we have a valid employer
			try {
				$employer = $user->getEmployer();
			}
			catch( \Exception $e ) {
				$task->log('User does not have an employer, so therefore no employer programs will be notified.');
				$task->complete();
				return;
			}

			$remainingPrograms = array_column( $employer->getActivePrograms(), 'id' );
			$task->setData( 'remaining_programs', $remainingPrograms );
		}

		/**
		 * Task Complete Condition
		 */
		if ( empty( $remainingPrograms ) ) {
			$task->log("No more programs to process. We're done!");
			$task->complete();
			return;
		}

		$next_employer_program_id = array_shift( $remainingPrograms );

		try {
			$employerProgram = EmployerProgram::load( $next_employer_program_id );
		}
		catch( \OutOfRangeException $e ) {
			$task->log("Something went wrong. The employer program with id: {$next_employer_program_id} couldn't be loaded.");
			$task->fail();
			return;
		}

		try {
			$userProgress = $employerProgram->getUserProgress( $user );

			try {
				$employerProgram->processEvent( $event, $userProgress );
				$userProgress->save();

				// Grant awards when user progress in the program is complete
				if ( $userProgress->status == 'complete' ) {
					foreach( $employerProgram->getProgramAwards() as $employerProgramAward ) {
						try {
							$employerProgramAward->grantAward( $user );
						}
						catch( \LogicException $e ) {
							$task->log('Error trying to grant award: ' . $employerProgramAward->id() );
							$task->log('Error was: ' . $e->getMessage() );
						}
					}
				}
			}
			catch( \LogicException $e ) {
				$task->log( 'Error: ' . $e->getMessage() );
				$task->fail();
				return;
			}
		}
		catch( \OutOfRangeException $e ) {
			$task->log( 'Progress for this user cannot be tracked for employer program: ' . $employerProgram->id() );
		}

		$task->setData( 'remaining_programs', $remainingPrograms );
	}

	/**
	 * Register a program
	 *
	 * @param	Ovia\Incentives\Programs\AbstractProgram		$program		An instance of the program to register
	 * @return	void
	 */
	public function registerProgram( \Ovia\Incentives\Programs\AbstractProgram $program ) {
		$program_key = $program->getKey();
		$this->programs[ $program_key ] = $program;
	}

	/**
	 * Get a program by key
	 *
	 * @param	string			$program_key		The key of the program
	 * @return	Ovia\Incentives\Programs\AbstractProgram
	 * @throws 	OutOfRangeException
	 */
	public function getProgram( string $program_key ) {
		$program = $this->programs[ $program_key ] ?? null;

		if ( ! $program ) {
			throw new \OutOfRangeException( 'Program key not found: ' . $program_key );
		}

		return $program;
	}

	/**
	 * Register an award
	 *
	 * @param	Ovia\Incentives\Programs\AbstractProgram		$program		An instance of the program to register
	 * @return	void
	 */
	public function registerAward( \Ovia\Incentives\Programs\AbstractAward $award ) {
		$award_key = $award->getKey();
		$this->awards[ $award_key ] = $award;
	}

	/**
	 * Get an award by key
	 *
	 * @param	string			$award_key			The key of the award
	 * @return	Ovia\Incentives\Awards\AbstractAward
	 * @throws 	OutOfRangeException
	 */
	public function getAward( string $award_key ) {
		$award = $this->awards[ $award_key ] ?? null;

		if ( ! $award ) {
			throw new \OutOfRangeException( 'Award key not found: ' . $award_key );
		}

		return $award;
	}

	
}