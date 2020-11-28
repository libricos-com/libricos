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

/**
 * Database connection information is automatically provided.
 * There is no need to set or change the following database configuration
 * values:
 *   DB_HOST
 *   DB_NAME
 *   DB_USER
 *   DB_PASSWORD
 *   DB_CHARSET
 *   DB_COLLATE
 */

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         '?POj<DedS;K+sC1atOo@o,Sxr9uz)$<0e~pVYJlGD.k3G=~NiO~BBs_o2rx:x5B*');
define('SECURE_AUTH_KEY',  'NNT,4.<nPMT-0%PfO>^!e{!EFEQN^0SB,5?82[AP]zo]7hc3L{E{sW$fpyDHTCQ-');
define('LOGGED_IN_KEY',    'I;-hbnP0CmKs|5nZ%s^LssA97%X9M+3?Hqwz?hvE@Ijh~;T!(*WV{+50!-DaiVBL');
define('NONCE_KEY',        'd|7=e2[h;56!}}Xa<8p_Ag{Y.pz>>XCy;YRTU>kYnBH!c%v>-||i64}J++SK)*VF');
define('AUTH_SALT',        'WPjH(]gw4;!X%vH^:{{>5yr:%EsV}_krF~nmwt,m45w;]<b>#TNY}W#zv1F~[<!X');
define('SECURE_AUTH_SALT', 'i*nv#UUqf1ER[o@,rYg_8kwa]:Rj#oowkHt2u!+{cWiT#TL](Yl0j4Q-M<je6McE');
define('LOGGED_IN_SALT',   'tJKMn$;[TRF^G|(eQaII;VJZ6oYQb?b~#c3*xz[4?6f-s2WLofoz97A(*R}j.QuZ');
define('NONCE_SALT',       '[lN|R1e6V~UX1=?om[$legQc=Kt3KKIjVY3+;b)D5AT5EV|7i^pmL=eP>hun)H~O');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
