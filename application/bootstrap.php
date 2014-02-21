<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */

if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}
Kohana::$environment = Kohana::PRODUCTION;

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
    'index_file' => false,
    'errors'     => true,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Cookie::$salt = '12345qwe';
Kohana::modules(array(
	 'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	 'database'   => MODPATH.'database',   // Database access
	// 'image'      => MODPATH.'image',      // Image manipulation
	 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	 'pagination'  => MODPATH.'pagination',  // Pagination
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
    ->defaults(array(
        'directory' => 'error',
        'controller' => 'handler',
    ));

Route::set('blog_post', 'post(/<post_id>)')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'blogpost',
    ));

Route::set('serial_blog', 'blog(/<serial_id>(/<page>))', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'serialblog',
    ));

Route::set('allblogs', 'all-blogs(/<page>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'allblog',
    ));
Route::set('search', 'search(/<page>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'search',
    ));

Route::set('all_anime', 'all-anime(/<page>)', array('page' => '[0-9]+'))
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'allanime',
    ));

Route::set('ongoing', 'ongoing')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'ongoing',
    ));
Route::set('hits', 'hits')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'hits',
    ));
Route::set('popular', 'popular')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'popular',
    ));
Route::set('rating', 'rating')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'rating',
    ));
Route::set('gallery', 'gallery')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'gallery',
        'action'     => 'index',
    ));

Route::set('frontend_ajax', 'request(/<action>(/<id>))')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'ajax',
        'action'     => 'index',
    ));

Route::set('auth', 'auth(/<action>(/<id>))')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'auth',
        'action'     => 'index',
    ));

Route::set('aboutus', 'about-us')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'aboutus',
    ));

Route::set('aboutaninice', 'about-aninice')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'aboutaninice',
    ));

Route::set('newanime', 'new-anime')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'newanime',
    ));

Route::set('relise', 'relise')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'relise',
    ));

Route::set('view_serial', 'anime(/<serial_id>(/<season_id>))')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'serial',
    ));

Route::set('view_serial_with_name', 'serial(/<serial_name>/(<serial_id>(/<season_id>)))')
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'index',
        'action'     => 'serial',
    ));

Route::set('admin_ajax', 'admin_ajax(/<action>(/<id>))')
    ->defaults(array(
        'directory'  => 'admin',
        'controller' => 'ajax',
        'action'     => 'index',
    ));

Route::set('admin_other', 'admin_other(/<action>(/<id>))')
    ->defaults(array(
        'directory'  => 'admin',
        'controller' => 'other',
        'action'     => 'index',
    ));

Route::set('admin_panel', 'admin(/<action>(/<id>))')
    ->defaults(array(
        'directory'  => 'admin',
        'controller' => 'index',
        'action'     => 'index',
    ));

Route::set('adminka', 'adminka(/<action>)')
    ->defaults(array(
        'directory'  => 'admin',
        'controller' => 'login',
        'action'     => 'index',
    ));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
        'directory'  => 'frontend',
		'controller' => 'index',
		'action'     => 'index',
	));
