<?php
/*
 * This is a sample local-config.php file
 * In it, you *must* include the four main database defines
 *
 * You may include other settings here that you only want
 * enabled on your local development checkouts
*/

define( 'DB_NAME', 'tribe_square1' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'password' );
define( 'DB_HOST', 'mysql' );

/*
 * React dev
 */

define( 'HMR_DEV', false );

/*
 * Debugging
 */

define( 'WP_DEBUG', true );
define( 'SAVEQUERIES', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'SCRIPT_DEBUG', true );
define( 'WP_CACHE', false );

define( 'TRIBE_DISABLE_PANELS_CACHE', true );

$GLOBALS[ 'memcached_servers' ] = [ [ 'memcached', 11211, ] ];

/*
 * Whoops
 *
 * If you enable Whoops, the Whoops error library will be used to provide better/prettier error logging.
 */
define( 'WHOOPS_ENABLE', true );

/*
 * Multisite
 *
 * If you enable multisite in wp-config.php, ensure to provide your local.tribe URI here
 */
//define( 'DOMAIN_CURRENT_SITE', 'square1.tribe' );

/*
 * Glomar
 *
 * GLOMAR is a plugin that blocks the frontend of the site from public access.
 * If you would like to disable the plugin locally, add the following to your local-config.php.
 */

//define( 'TRIBE_GLOMAR', false );
