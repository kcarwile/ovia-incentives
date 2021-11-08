<?php
/**
 * EngagementProgram Class
 *
 * Created:   November 5, 2021
 *
 * @package:  Ovia Incentives Management
 * @author:   Kevin Carwile
 * @since:    1.0.0
 */
namespace Ovia\Incentives\Programs;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use Ovia\Incentives\Models\UserProgress;

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

		if ( ! is_integer( $event['timestamp'] ) ) {
			return;
		}

		$consecutiveDays = 5;

		$now = new \DateTime( '@' . $event['timestamp'] );
		$dayNum = $now->diff( new \DateTime('2021-01-01') )->format('%a');

		// check for 5 days in a row of activity
		$data = $userProgress->data;

		if ( ! isset( $data['activityLog'] ) ) {
			$data['activityLog'] = [];
		}

		if ( ! in_array( $dayNum, $data['activityLog'] ) ) {
			$data['activityLog'][] = $dayNum;
			rsort( $data['activityLog'] );

			// Only keep the number of days we want to check
			$data['activityLog'] = array_slice( $data['activityLog'], 0, $consecutiveDays );

			if ( count( $data['activityLog'] ) == $consecutiveDays ) {
				$_most_recent = $data['activityLog'][0];
				$_congrats = true;

				foreach( range(1, $consecutiveDays - 1) as $i ) {
					if ( $data['activityLog'][$i] != $_most_recent - $i ) {
						$_congrats = false;
						break;
					}
				}

				if ( $_congrats ) {
					$userProgress->status = 'complete';
				}
			}
		}

		$userProgress->data = $data;
	}
	
}
