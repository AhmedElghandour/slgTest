<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpressTest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '9J*e}d#C[lg6$26`Tz^5o|GUW8sVA3`?i[C:a},@BFnbw@U5orSv]T^!ug$5&9-X');
define('SECURE_AUTH_KEY',  '4Lc,<x;*pK4#j3US.+NVEWy)|wgrISDiPV+eF5 cV>E:~:jv=>;1boeJ$R4AU|X+');
define('LOGGED_IN_KEY',    '0Yu=wpMc&!f8@}}PGWr[5!mD.nSq 7f*&WV&]N%)0aJB|~B%};K&dtdmI$^8I6!u');
define('NONCE_KEY',        'R7l^|tENQ[<UEQ=6/QJKOT-iB7~NbWMWV~|^2v59+H>kk}xf&;t>aPM{EDsNSD]D');
define('AUTH_SALT',        ']I=A83&-;+m?r 4)52>NQny9T(x[LCdarU%y~xPH5nTgGly,-siTwfTnB~+?DvU}');
define('SECURE_AUTH_SALT', '8_5kn!lPY75xTvZ<^_!@*vvEwWtA/-AwupI]ko~k,xe%s~$S/Ocw102:1na<l%j!');
define('LOGGED_IN_SALT',   'B@9 <t||=*Yw@E|WSO+9e;%TRuswDS/(SGb6j2%Nhh4S+K}]k8ip/U<A6+k&b84N');
define('NONCE_SALT',       ';|A6[e(vben{sf?TF>|{50I-ztzM|$1**#bN/U.zi$|5P$!e|Gse-6a/]?:FpJ&3');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
