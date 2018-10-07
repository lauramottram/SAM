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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'solutions');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'UBA`h9LPZQCC $K(d:TCJ,_]O-y{=vd/e^r|xXmuy@yFSUNQ{+{HD5-`Sn+Mf^~+');
define('SECURE_AUTH_KEY',  '}v.]y0K5t0ap#Z-A2cSpbxk>pi(A}pY06 342ZUTe=!krwv+LZRx m@}@n=<L3x/');
define('LOGGED_IN_KEY',    'd}yf&Z!g;c#!*pB,*JW5j(x*z9%+qZS;Y-$9t>Rrj]^==Z-XVz<sf!Q:UX},s)&<');
define('NONCE_KEY',        '#ba]5_}>6M69%%WoE_G8?SW8_].ELwkG_~En@Ia+V? bGH.[2Q~+VbR3F9G>CEIb');
define('AUTH_SALT',        'v> Rpr3x2Yu0OEdf)_WaNW0Nl,|kWR|<c?7P9.Q9W6`),q}%O[;[ZV>hMUywkzEl');
define('SECURE_AUTH_SALT', 'ggA/3q5yc4]?Y{U!~OER3ctgXk_n<U[T($A<*?+%BHkj5Xbp[a]^Cqs`! Vg2IrU');
define('LOGGED_IN_SALT',   'CxZN{aK<n4ND05Th~#=u#n#OD&F4!`a8VRE4R>qLK@Y3vC]N1oNg2vEcqDmhU2g-');
define('NONCE_SALT',       'gLoU0^(J4-1J8W4`bId|u6KAt}Q>mws6(k0sf&XO%[_zf^eFn07A(qyaQkg$Ax$1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
