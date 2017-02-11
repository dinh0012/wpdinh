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
define('DB_NAME', 'u629339859_wp');

/** MySQL database username */
define('DB_USER', 'u629339859_root');

/** MySQL database password */
define('DB_PASSWORD', 'hfWCpbMw0rku');

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
define('AUTH_KEY',         '(ZzQCtJL0Vz,=d:o6R.{ec0NV_0W;^~;PLW{,0A+7gpCPZ9nvg^2^0:.vn/o.tk~');
define('SECURE_AUTH_KEY',  ';l~bN)syI%4^axPj%&q4rR}ERuD$>LC,jg)y;Bvqn/G(R?-Hl)=k^HRtv}0x#PXP');
define('LOGGED_IN_KEY',    'S5i96MKI:OQRrq){cQp{eZ}#N_^ ^lJN+5Xu ^wdyuT8~eIl8oC!hQGWK;NYUdJB');
define('NONCE_KEY',        '*>=J<s?S+P6F,s>XT]YBn%UifE.Yam*@-S&ifc<.o%@5E~u%ULTVCj7D}u!#?H>M');
define('AUTH_SALT',        'D~ND,U>vo(fX9[WR(7&c.`p9F@]dd]NS&4o)H,<ozRV2RG##./j:/6,-*/p)?q.A');
define('SECURE_AUTH_SALT', 'QGfZpnIqEyq:fu](u;sk`v ^!z8w.8mw1Y JB)fON8BJDM6A:ZG*#8Upg]R${ag{');
define('LOGGED_IN_SALT',   'yFkje[K$M<!C8;Bu%S6jILKonmYZG3.{&Y?x**MIz/_{IB`(FJ745b4&Wh_~{I#2');
define('NONCE_SALT',       ';Yq1625p4GH/a=5)+Ew]uPt%sHi9. UFq&t~u{#;/E*Pip`TP8e$jOeFTE]8TvQ*');

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
