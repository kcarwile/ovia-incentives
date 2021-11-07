<?php
/**
 * BirthProgram Class
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
 * BirthProgram
 */
class BirthProgram extends AbstractProgram
{

	/**
	 * Get the program key
	 *
	 * @return	string
	 */
	public function getKey() { 
		return 'birth';
	}

	/**
	 * Get the program name
	 *
	 * @return	string
	 */
	public function getName() { 
		return 'Baby was born';
	}

	/**
	 * Process an app event for a given user
	 * 
	 * @param	array				$event				The event details
	 * @param	UserProgress		$userProgess		The user progress tracker for the program
	 * @return	void
	 */
	public function processEvent( $event, UserProgress $userProgress ) { 
		// check if this event is of concern
		if ( $event['type'] == 'birth' ) {
			$userProgress->status = 'complete';
		}
	}
	
}
