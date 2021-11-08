/**
 * Plugin Javascript Module
 *
 * Created     November 5, 2021
 *
 * @package    Ovia Incentives Management
 * @author     Kevin Carwile
 * @since      1.0.0
 */

/**
 * Controller Design Pattern
 *
 * Note: This pattern has a dependency on the "mwp" script
 * i.e. @Wordpress\Script( deps={"mwp"} )
 */
(function( $, undefined ) {
	
	"use strict";
	
	/* Assign the controller instance to a global module variable when it is instantiated */
	var mainController;
	mwp.on( 'ovia-incentives.ready', function(c){ mainController = c; } );

	/**
	 * Main Controller
	 *
	 * The init() function is called after the page is fully loaded.
	 *
	 * Data passed into your script from the server side is available
	 * through the this.local property of your controller:
	 *
	 * > var ajaxurl = this.local.ajaxurl;
	 *
	 * The viewModel of your controller will be bound to any HTML structure
	 * which uses the data-view-model attribute and names this controller.
	 *
	 * Example:
	 *
	 * <div data-view-model="ovia-incentives">
	 *   <span data-bind="text: title"></span>
	 * </div>
	 */
	mwp.controller.model( 'ovia-incentives', 
	{
		
		/**
		 * Initialization function
		 *
		 * @return	void
		 */
		init: function()
		{
			// ajax actions can be made to the ajaxurl, which is automatically provided to your controller
			var ajaxurl = this.local.ajaxurl;
			
			// set the properties on your view model which can be observed by your html templates
			this.viewModel = {
				title: ko.observable( 'Ovia Incentives Management' )
			};
		}
	
	});
		
	
})( jQuery );
 