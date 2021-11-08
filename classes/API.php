<?php
/**
 * API Class [Singleton]
 *
 * Created:   November 6, 2021
 *
 * @package:  Ovia Incentives Management
 * @author:   Kevin Carwile
 * @since:    {build_version}
 */
namespace Ovia\Incentives;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use MWP\Framework\Pattern\Singleton;
use MWP\Framework\Task;

/**
 * API
 */
class API extends Singleton
{
	/**
	 * @var self
	 */
	protected static $_instance;
	
	/**
	 * Receive an event from an Ovia app
	 *
	 * @MWP\WordPress\RestRoute( namespace="ovia/v1", methods="POST", route="/events",
	 *   args={
	 *     "user_id" : { "required": true },
	 *     "event" : { "required": true },
	 *   }
	 * )
	 *
	 * @param   WP_REST_Request         $request            The request
	 * @return  WP_REST_Response
	 */
	public function receiveEvent( \WP_REST_Request $request )
	{
		$user_id = $request['user_id'];
		$event = $request['event'];

		$task = Task::queueTask([ 'action' => 'ovia_process_event' ], [
			'user_id' => $user_id,
			'event' => $event,
		]);

		$response = [
			'success' => true,
			'message' => 'Event received',
		];

		return new \WP_REST_Response( $response, 202 );
	}

}
