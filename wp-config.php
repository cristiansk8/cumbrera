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
define('DB_NAME', 'cumbrera_wp1');

/** MySQL database username */
define('DB_USER', 'cumbrera_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'K^QKo(tWB2fGo4OYEE&90##0');

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
define('AUTH_KEY',         'XhQ9HblrT0oOtwG3o3sQkmJuFdFBPje6DZyTQolSCkIt8RPX4n7EPvCA6p03XdcF');
define('SECURE_AUTH_KEY',  'Rq22h8U8Pml2X3jbQa0C2IZVjpaNe0KCxXyyAZrydLu7g1HUGbkG0ut19OYnHtUB');
define('LOGGED_IN_KEY',    'fb9zSi0XxD9bYfhCoqDkzpaRlisCuKaZnOrbld8VvTwEIuL1MuUInDKaFSdmQXf7');
define('NONCE_KEY',        'DqNBJenfCO3HZ3EWj7FBiAJxiPbuZOqENVpKUxa4uId6ygXKzZ2CG117A01wYE7x');
define('AUTH_SALT',        'pGNJprr3cTXkLPNEPOB0UIOv12MAyu2OXm4DbOjqTWq2BD1bZcOKOI5wnq8OmRHT');
define('SECURE_AUTH_SALT', 'FizYtXRmHQ2UPQI0amRIqeKSRAnQLEWkbcVkDmiCeZarmIk9yxBUSf2QTDS24yvh');
define('LOGGED_IN_SALT',   'ucdWGAULSc8VdDpCnLyersZGBT0qF9wiFoflaIEWKnlt1M1QkB33iQW8Tmi8cYTO');
define('NONCE_SALT',       '4M1VlEX8qSf4UWYhbbWAsl2FtN8WuF1vgitlVj9dqgvcFwvot7FaNlKr3srJpn6B');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
