<?php
/**
 * AbstractAward Class
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

/**
 * AbstractAward
 */
class AbstractAward
{

	/**
	 * Grant this award to a user
	 * 
	 * @param	User		$user			The user to grant the award to
	 * @return	void
	 * @throws 	LogicException
	 */
	public function grantAward( User $user, EmployerProgramAward $employerProgramAward ) { 
		// Write a record to the UserAward table.
	}

	/**
	 * Deliver this award to a user
	 * 
	 * @param	UserAward					$userAward					The user award to deliver
	 * @return	void
	 * @throws 	LogicException
	 */
	abstract public function deliverAward( UserAward $userAward ) { }
	
}
