<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


//check if file exists
if(file_exists(__DIR__ . '/local_lpdev')){
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'stagingweb_stage');
	/** MySQL database username */
	define('DB_USER', 'root');
	/** MySQL database password */
	define('DB_PASSWORD', '');
	/** MySQL hostname */
	define('DB_HOST', 'localhost:3307');
	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');
	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**  * For developers: WordPress debugging mode.  *  * Change this to true to
	* enable the display of notices during development.  * It is strongly
	* recommended that plugin and theme developers use WP_DEBUG  * in their
	* development environments.  *  * For information on other constants that can be
	* used for debugging,  * visit the Codex.  *  * @link
	* https://codex.wordpress.org/Debugging_in_WordPress  */
	define('WP_DEBUG', TRUE);
	define('WP_DEBUG_LOG', TRUE);

	define('WP_HOME','http://stagingweb.stage:8090/');
	define('WP_SITEURL','http://stagingweb.stage:8090/');

	define('SERVER_NAME','stagingweb.stage:8090');
}elseif (file_exists(__DIR__ . '/remote_dev')) {
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('WP_CACHE', true);
	define( 'WPCACHEHOME', 'C:\www\env\dev\wordpress\wp-content\plugins\wp-super-cache/' );
	define('DB_NAME', 'stb-wpdb-dev');

	/** MySQL database username */
	define('DB_USER', 'stb-wpadmin');
	/** MySQL database password */
	define('DB_PASSWORD', '0HFAYesuvqKME0OE0iFH');
	/** MySQL hostname */
	define('DB_HOST', 'stbaetwpdb2:3306');
	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');
	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**  * For developers: WordPress debugging mode.  *  * Change this to true to
	* enable the display of notices during development.  * It is strongly
	* recommended that plugin and theme developers use WP_DEBUG  * in their
	* development environments.  *  * For information on other constants that can be
	* used for debugging,  * visit the Codex.  *  * @link
	* https://codex.wordpress.org/Debugging_in_WordPress  */
	define('WP_DEBUG', TRUE);
	define('WP_DEBUG_LOG', TRUE);

	define('WP_HOME','https://dev.stb.gov/');
	define('WP_SITEURL','https://dev.stb.gov/');
}elseif(file_exists(__DIR__ . '/remote_test')){
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'stb-wpdb');
	/** MySQL database username */
	define('DB_USER', 'stb-wpadmin');
	/** MySQL database password */
	define('DB_PASSWORD', '0HFAYesuvqKME0OE0iFH');
	/** MySQL hostname */
	define('DB_HOST', 'stbaetwpdb2:3306');
	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');
	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**  * For developers: WordPress debugging mode.  *  * Change this to true to
	* enable the display of notices during development.  * It is strongly
	* recommended that plugin and theme developers use WP_DEBUG  * in their
	* development environments.  *  * For information on other constants that can be
	* used for debugging,  * visit the Codex.  *  * @link
	* https://codex.wordpress.org/Debugging_in_WordPress  */
	define('WP_DEBUG', FALSE);

	define('WP_HOME','https://test.stb.gov/');
	define('WP_SITEURL','https://test.stb.gov/');
}elseif(file_exists(__DIR__ . '/remote_int')){
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'stb-wpdb-int');
	/** MySQL database username */
	define('DB_USER', 'stb-wpadmin');
	/** MySQL database password */
	define('DB_PASSWORD', '0HFAYesuvqKME0OE0iFH');
	/** MySQL hostname */
	define('DB_HOST', 'stbaetwpdb2:3306');
	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');
	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**  * For developers: WordPress debugging mode.  *  * Change this to true to
	* enable the display of notices during development.  * It is strongly
	* recommended that plugin and theme developers use WP_DEBUG  * in their
	* development environments.  *  * For information on other constants that can be
	* used for debugging,  * visit the Codex.  *  * @link
	* https://codex.wordpress.org/Debugging_in_WordPress  */
	define('WP_DEBUG', FALSE);

	define('WP_HOME','https://int.stb.gov/');
	define('WP_SITEURL','https://int.stb.gov/');
}elseif(file_exists(__DIR__ . '/remote_prod')){
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'stb-wpdb');
	/** MySQL database username */
	define('DB_USER', 'stb-wpdbadmin');
	/** MySQL database password */
	define('DB_PASSWORD', '1J6CLnaaR3Wehd7VlExj');
	/** MySQL hostname */
	define('DB_HOST', 'STBAETWPDB1:3306');
	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');
	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**  * For developers: WordPress debugging mode.  *  * Change this to true to
	* enable the display of notices during development.  * It is strongly
	* recommended that plugin and theme developers use WP_DEBUG  * in their
	* development environments.  *  * For information on other constants that can be
	* used for debugging,  * visit the Codex.  *  * @link
	* https://codex.wordpress.org/Debugging_in_WordPress  */
	define('WP_DEBUG', FALSE);

	define('WP_HOME','https://prod.stb.gov/');
	define('WP_SITEURL','https://prod.stb.gov/');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
 define('AUTH_KEY',         'UW^%WLPBV}^jo-aylQLIAd:ZK:uxkO`mR)ae4+?QA]WQz6,5u>1->|P-lfJ{_`Rc');
 define('SECURE_AUTH_KEY',  'ACKYN:/ ?G$e7bc=:]SK+ZFA+_46.kYWS3Wbz^Tdja_Or_(>?O%IZ45I:_Nl{/%2');
 define('LOGGED_IN_KEY',    'g@H6~3e3ewC+$/W8$&uYD3:i|w1_&fzNXh@uirac.ax|-Z2Bd{i5EnM6W/G}o0Io');
 define('NONCE_KEY',        '*M!Ldh/ma^B=L6u)`m#zWP<kK89.22pnGw6=cx+g?1X30Y(^Q!-/5SL#m+c4!eic');
 define('AUTH_SALT',        ']C=yK70BugQ7cXp[]]dvt=,y*+{m51)?net/,n&09;Axc-]TyB*/) |wE):+B_e0');
 define('SECURE_AUTH_SALT', '1-`%^n+UD~<N]C[x$-hVw xX.d+o]?|Zk.MoLj`(z;Wj}=>9),R3U~7G9>)j`z*0');
 define('LOGGED_IN_SALT',   'nw;sSQAKgv:xy{:J>(ve_Qf/i{}~EP!@s?2GLcA/W~REOh_xVq .ZS%aN+: YY&|');
 define('NONCE_SALT',       'y=2A3;=CDw{7=m_n?w|sx3iI>B*x543@4gvHEsiW1/g{|%h+mQ$(-wDx0i>8CC^?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//S3 bucket Access defination
define( 'DBI_AWS_ACCESS_KEY_ID', 'AKIAITNVICP6J2DX3KKQ' );
define( 'DBI_AWS_SECRET_ACCESS_KEY', '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' );

// Load Composer package autoloader.
if (file_exists( ABSPATH . '/vendor/autoload.php' ) ) {
	require_once( ABSPATH . '/vendor/autoload.php' );
}
