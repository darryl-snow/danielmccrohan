<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'danielu4_dmcwp');

/** MySQL database username */
define('DB_USER', 'danielu4_daniel');

/** MySQL database password */
define('DB_PASSWORD', 'constantine1975');

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
define('AUTH_KEY',         '(cFXF~u8*LS`g>D>6RGs$lS.]Ld gyNH*s<.jbkWKR:nv%%!EL~)s_%wD3oC|#Qb');
define('SECURE_AUTH_KEY',  '1Q_[.Jxmx:xQ8!T G!]X6Qj&;=s^lMJd`r|1iL7JA.#g6#2w+IkAXjhv-=ncKeYv');
define('LOGGED_IN_KEY',    'J1T)bS9-*(}*;G/Gx<iI{@-N*sM*0CEQg7t*,B}bEy^uA^|3MVs2aQgLzc0T*R_z');
define('NONCE_KEY',        ')xQA<{<@O1&EL7fgOg-;ECLal-+i`I~Cm<?<%A)a]W`R|B%H gJRc|~:YLd_!~bL');
define('AUTH_SALT',        '&1H0<FDrS4}=Du3fM05sdou>?F~qKe#n@O0FF8ZR5wYLNV,z=~.L8M1G$||W?1gu');
define('SECURE_AUTH_SALT', 'x+5!wg?YG=N 1*1c3Rc9<dI=X~U;,e?/&2f2?+To^C-:;.*-g|+^qZXsLN-g~NV`');
define('LOGGED_IN_SALT',   'hDb8cg+oW2cCUn!W$Z[LVH%,<h-{da;-(DRUfjoeRxaC(Uo*7P/|{v1]HdUOb>(8');
define('NONCE_SALT',       '0}xPlXr-jJeZ*6J,|+R8;=ek%E|<^7aFb/.-d3+>ebH-zOY_Td*Y8tXHrKu(iyOe');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dmcwp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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