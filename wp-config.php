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
define( 'DB_NAME', 'smarty_lab' );

/** Database username */
define( 'DB_USER', 'smarty_lab_user' );

/** Database password */
define( 'DB_PASSWORD', 'smarty_lab_pass' );

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
define( 'AUTH_KEY',         '3Z-,0K0wwr`acWX}f<>_7[t,78Ppq3MElzBZnBD+Xk-NVr4yw{|hM{W8#ri,H>3k' );
define( 'SECURE_AUTH_KEY',  '$il!MtZ$:$FDkL^~}cV5&HR9,w,t!xv%108~-HvzKtBj)mIn[y=p,Zca6elq6sGU' );
define( 'LOGGED_IN_KEY',    '/>3xlnO]k3Z|6?5#l[P[e_Ml7kOPBUy)au,%b5>[%Ghor8^5=pqqa>NGZ=6<f]G/' );
define( 'NONCE_KEY',        'QAAS7=0x=&%2caDc?CI|z=& %o^#NQ?[caE%}is>5<ljTqh=4D]z4N,ScnJ9Y U,' );
define( 'AUTH_SALT',        'KT } sgC(~n~cr[|uHfvn[K|@J,hHx84@gOKVN=/M6}q4a*E&qcCEO~nu{5BJJp^' );
define( 'SECURE_AUTH_SALT', 'Dn%R5C%zN+LXS;.&Cb<}<.b.+C.(J=%t7OJ^Qr?a1)P-}Txt#,I+HZ[!Sp8G($]c' );
define( 'LOGGED_IN_SALT',   'f0}[Jv+%H^K,MW}<$?n>KF)_]uPEk|d cTCi(~0Z(F]%yc1CaD-:{FA%;$q8je>f' );
define( 'NONCE_SALT',       '923WLQd0,d%EFO.#cURgP}GNP8uk2OJ|WaZ&]E->jI=PmOGHMGL]ASiNGDY#fyes' );

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
define( 'WP_DEBUG', true );
define( 'AUTOSAVE_INTERVAL',    3600 );     // autosave 1x per hour
define( 'WP_POST_REVISIONS',    false );    // no revisions
define( 'DISABLE_WP_CRON',      true );
define( 'EMPTY_TRASH_DAYS',     7 );        // one week
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
