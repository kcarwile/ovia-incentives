<?php
/**
 * PillowAward Class
 *
 * Created:   November 5, 2021
 *
 * @package:  Ovia Incentives Management
 * @author:   Kevin Carwile
 * @since:    {build_version}
 */
namespace Ovia\Incentives\Awards;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use Ovia\Incentives\Models\UserAward;

/**
 * PillowAward
 */
class PillowAward extends AbstractAward
{

	/**
	 * Get the award key
	 *
	 * @return	string
	 */
	public function getKey() { 
		return 'pillow';
	}

	/**
	 * Get the award name
	 *
	 * @return	string
	 */
	public function getName() { 
		return 'Pregnancy Pillow';
	}

	/**
	 * Deliver this award to a user
	 * 
	 * @param	UserAward					$userAward					The user award to deliver
	 * @return	void
	 * @throws 	LogicException
	 */
	public function deliverAward( UserAward $userAward ) { 
		// Send a pillow the to user
	}


}
