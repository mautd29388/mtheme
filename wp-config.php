<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'dev_mtheme');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ')j(0>{/*,lg_r3q~*e=cM%=m>Ty#/KB/awT|jf(qI%HQQun0oD*V32O+lAhcSwq:');
define('SECURE_AUTH_KEY',  'p8L`Lx~K5U?IG-=BWJ(mFVJGS VRgpNzcmL10ZX15-KU)nzI3[GdyY7U9fA@j2`9');
define('LOGGED_IN_KEY',    '5T;gLmG2)IR5V[[*8rT~8aBS=x8v_}#uWC~_H;^<$+EQNQ[FZe.O t?oOV^f1@yi');
define('NONCE_KEY',        'C?,V~~v>y/=KsZa5??]uc;fQ(wr`OG,>iNnk8++$K!^](CQ}SEo+s@~`Z[ONA?S[');
define('AUTH_SALT',        's1+oV/r(bl>y1Kx7C*;0r|8Mx2uaczl(5HA1XFF{Q0|Wjx(-Rd.gdeXIe$l;(-G5');
define('SECURE_AUTH_SALT', '02?SS&L^C|8A<d0-NGy8<iW]GbRats|VB8hz4@)neWMH,k{8W3S-G~-27|YYc)GM');
define('LOGGED_IN_SALT',   'dRMW|nG /3#b|iWnXkHv.vzfC>|sSgE4k:c[v:~=C]{ij/EZNi6,;+58xt|2K;*V');
define('NONCE_SALT',       'hhqZ>GKTGZ|KG|Zk6=OeW`imBH|14Hw3OCPwH596-6JPH+wKVe,%.>Bdm/zqU/&6');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
