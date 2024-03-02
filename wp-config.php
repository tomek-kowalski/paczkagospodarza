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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_paczka' );

/** Database username */
define( 'DB_USER', 'tomek' );

/** Database password */
define( 'DB_PASSWORD', 'ibiza' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '}b:Yqa,x^heg}xSbu)5eLz*JF:YK4?`pHp5`SPkfnWV+G|c-TXujJeE}=n[D>C{2' );
define( 'SECURE_AUTH_KEY',  ')u2Ml*%$e;7=r^P<ho O},C^Bd4Zk[S#?/Si|_Y-*cv-z~bm|9,kJNy1E13c{-iT' );
define( 'LOGGED_IN_KEY',    'nscqL(G7tZi<3yhP[dYCMtqW@O4xbfca+--Vxn?><QiMDJRBe4C=cC`-fW$;.+T&' );
define( 'NONCE_KEY',        'dAA#A#*MGJkw*hq*k)yW`BB#sLB%x;2yk|ZN-WGCqhztO$lSIrgo@nS{FR4J]Gkb' );
define( 'AUTH_SALT',        'a}gE.KQ/=m#[haW3&{OS((X[>GUv-hNJ8X_EZgx[P]%CGIalL$$*aDU~ycA[wlc/' );
define( 'SECURE_AUTH_SALT', 'muyMGtXq{hJuS0Y@w^2H)-C-hD(=kAAqz.j<y3TYFg4s{~y>W)1(Hd;?c)9#HX=S' );
define( 'LOGGED_IN_SALT',   'i EDuL!iP!m&Xy>^)cYnQx~_<]pD.~^gYD!_wYM=8[nZK{S`9>8jv5N!VyX%5$hN' );
define( 'NONCE_SALT',       '6 oI?EMln5WJlGC4)Bj$moAI5 9.G~[W*!OY/A`1LI;s<]4Y3V;~M-LeWK5idCqH' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
