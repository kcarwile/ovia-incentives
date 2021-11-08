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
abstract class AbstractAward
{

	/**
	 * Deliver this award to a user
	 * 
	 * @param	UserAward					$userAward					The user award to deliver
	 * @return	void
	 * @throws 	LogicException
	 */
	abstract public function deliverAward( UserAward $userAward );

	/**
	 * Grant this award to a user
	 * 
	 * @param	User		$user			The user to grant the award to
	 * @return	void
	 * @throws 	LogicException
	 */
	public function grantAward( User $user, EmployerProgramAward $employerProgramAward ) { 
		$userAward = new UserAward;
		$userAward->employer_program_award_id = $employerProgramAward->id();
		$userAward->user_id = $user->id();
		$userAward->save();
	}
	
}
