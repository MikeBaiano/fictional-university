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
define( 'AUTH_KEY',          'Tp-NJk]V^]:g$&$^#K@5G}{v-xk8v=m2w7zAGbhrH(EjK :mj,}B>?$K&7[HJa%e' );
define( 'SECURE_AUTH_KEY',   ',$ma(Yp*6c]c9zI_&o;_GI1wD=seh#8ege7CSZ0Zio:f;,)A.1gLu%H9Ccyi?5B{' );
define( 'LOGGED_IN_KEY',     ';&miZ8D[edrD+$>]4BE^ju~{xr_3zu>ed,Vq>};up*r_B&oQBR~>^@o,5<dg;E?;' );
define( 'NONCE_KEY',         '{9P6W1,<un;b=f`nc.=dQVO}fx&k/>evk~t;?kUXEsMKkN[Ci@a5eM0nH?LJYWbR' );
define( 'AUTH_SALT',         '`EZFJLkzFQe_s]xni.KJ=}j![`-8]#j!t)mg1Bv4yff0@cB3q2J_aoC?hrB<A{T(' );
define( 'SECURE_AUTH_SALT',  '7M}~Ei:7GNW2-?7`<9;k2jjpfG-7hIj3hA`gs.+q?+tI%NFb){WgPz:Y:YgO&}.p' );
define( 'LOGGED_IN_SALT',    '>,As{i:iL^rBJEHzTdwc6lV=9~edigZLx3rL6WIGO8&c#p^)cqy,u^jZcIK$%bTr' );
define( 'NONCE_SALT',        'laRh6dy3F^g}WYWZm 1qyyif!kI`93$K{W:C@Wrn_H[<FvX2},YaqvsjZ.-!r&/#' );
define( 'WP_CACHE_KEY_SALT', '!N0}!jq_!`0hN3!n< _{YIak>kP{X|E?;?f:{m(dx*a`CA.3yCl2OY<1uo(+N=.~' );


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
