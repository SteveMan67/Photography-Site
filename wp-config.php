<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '<8%jnIi-*PeaoK[F/B0U?B3O#sC_W<Uw,[v,lF>|g^JV+D|7d)c3yUJO;~$j8g_F' );
define( 'SECURE_AUTH_KEY',   '01|=?#DMr5Xqj^Ed$`UjCs9(]{BT<V,4%c5+EJWftxKdc})dH$[-[O-:$U|~(~h6' );
define( 'LOGGED_IN_KEY',     '-Tz}a}[*h9`iP{X_n30aK%_-6K`T&2/b{{0gAHW/K*ho3+`>iCSJ{sdJQq+n1b(D' );
define( 'NONCE_KEY',         '2pQ3y.V(PY$zax!r~]R<Q#BVIh!NhM~YzpSv`nLp9w~YP`ydhG+EO79R4Q#,Ha6W' );
define( 'AUTH_SALT',         'NF@LF?.6k4>LR[G@2Q*33Y`_v4UOm><s=L5,]SKc^TVv}b y^95VUGd>oEm#vD`i' );
define( 'SECURE_AUTH_SALT',  'Q7xDR1KW%=AnLN{XJ&.n~2=lZ)$!/%@{W.%ffa.3$_DTfUH!Sg>2QR^!|ZlV?-&(' );
define( 'LOGGED_IN_SALT',    '/Z:D=]Eo+5_F$n,ZxqTWR?N-^]c#6K/;fN5Mn^S&$4WYXaA?CG%TBpv:zHW<=V<8' );
define( 'NONCE_SALT',        ';X>*Ye9;7YZBGu9Ic0BtAOW;G5[8p)*M%e6!(nt;k;RjT{a/IK*aG7C}ZN?M7~^l' );
define( 'WP_CACHE_KEY_SALT', '~ZDvo$od{)@zCj~f#y^*eMJ9ku{5=]gCP9HI[4e{4aTd(}PC}4_`5vx0ltH6Nyl3' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
