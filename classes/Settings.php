<?php
/**
 * Settings Class File
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

/**
 * Plugin Settings
 *
 * @MWP\WordPress\Options
 * @MWP\WordPress\Options\Section( title="General Settings" )
 * @MWP\WordPress\Options\Field( name="setting1", type="text", title="Setting 1" )
 * @MWP\WordPress\Options\Field( name="setting2", type="select", title="Setting 2", options={ "opt1":"Option1", "opt2": "Option2" } )
 * @MWP\WordPress\Options\Field( name="setting3", type="select", title="Setting 3", options="optionsCallback" )
 */
class Settings extends \MWP\Framework\Plugin\Settings
{
	/**
	 * Instance Cache - Required for singleton
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string	Settings Access Key ( default: main )
	 */
	public $key = 'main';
	
	/**
	 * Example Options Generator
	 * @see: class annotation for setting3
	 *
	 * @param		mixed			$currentValue				Current settings value
	 * @return		array
	 */ 
	public function optionsCallback( $currentValue )
	{
		return array
		(
			'opt3' => 'Option 3',
			'opt4' => 'Option 4',
		);
	}
		
}