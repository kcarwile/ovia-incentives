<?php
/**
 * EngagementProgram Class
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

/**
 * EngagementProgram
 */
class EngagementProgram extends AbstractProgram
{

	/**
	 * Get the program key
	 *
	 * @return	string
	 */
	public function getKey() { 
		return 'engagement';
	}

	/**
	 * Get the program name
	 *
	 * @return	string
	 */
	public function getName() { 
		return 'User is engaged';
	}

	/**
	 * Process an app event for a given user
	 * 
	 * @param	array				$event				The event details
	 * @param	UserProgress		$userProgess		The user progress tracker for the program
	 * @return	void
	 */
	public function processEvent( $event, UserProgress $userProgress ) { 
		if ( $event['type'] != 'activity' ) {
			return;
		}

		// check for 5 days in a row of activity
	}
	
}
