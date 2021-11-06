<?php
/**
 * UserAward Model [ActiveRecord]
 *
 * Created:   November 5, 2021
 *
 * @package:  Ovia Incentives Management
 * @author:   Kevin Carwile
 * @since:    {build_version}
 */
namespace Ovia\Incentives\Models;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

use MWP\Framework\Pattern\ActiveRecord;

/**
 * UserAward Class
 */
class _UserAward extends ActiveRecord
{
	/**
	 * @var	array		Multitons cache (needs to be defined in subclasses also)
	 */
	protected static $multitons = array();
	
	/**
	 * @var	string		Table name
	 */
	protected static $table = 'incentives_useraward';
	
	/**
	 * @var	array		Table columns
	 */
	protected static $columns = array(
		'id',
		'title' => [ 'type' => 'varchar', 'length' => 255 ],
	);
	
	/**
	 * @var	string		Table primary key
	 */
	protected static $key = 'id';
	
	/**
	 * @var	string		Table column prefix
	 */
	protected static $prefix = '';
	
	/**
	 * @var bool		Site specific table? (for multisites)
	 */
	protected static $site_specific = FALSE;
	
	/**
	 * @var	string
	 */
	protected static $plugin_class = 'Ovia\Incentives\Plugin';
	
	/**
	 * @var	string
	 */
	public static $sequence_col;
	
	/**
	 * @var	string
	 */
	public static $parent_col;

	/**
	 * @var	string
	 */
	public static $lang_singular = 'Record';
	
	/**
	 * @var	string
	 */
	public static $lang_plural = 'Records';
	
	/**
	 * @var	string
	 */
	public static $lang_view = 'View';

	/**
	 * @var	string
	 */
	public static $lang_create = 'Create';

	/**
	 * @var	string
	 */
	public static $lang_edit = 'Edit';
	
	/**
	 * @var	string
	 */
	public static $lang_delete = 'Delete';

}
