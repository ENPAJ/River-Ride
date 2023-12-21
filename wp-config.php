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
define('DB_NAME', 'riverru855');

/** MySQL database username */
define('DB_USER', 'riverru855');

/** MySQL database password */
define('DB_PASSWORD', 'UQzcyT4Q4krB');

/** MySQL hostname */
define('DB_HOST', 'riverru855.mysql.db:3306');

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
define('AUTH_KEY',         'LKnKLGgtqyrrcjG7thB9b4KvIKjY4iqOKUFf9hN2VOZUump/k0es21s2Vg2S');
define('SECURE_AUTH_KEY',  'HUlhBi9u3vtvqX9wm52hXpJ6EfTlcptiyHLgKdJvl2k3mMT1YWt5H929BoVU');
define('LOGGED_IN_KEY',    'bGS9cHlcupL3Cwkh+8+eGny+iB05me8bp68gsh6ebUvuZB3Zekwesn0k1STx');
define('NONCE_KEY',        '8wbxPud/HpCrZIOajubxquX9kQ4IeU08Rn1kS1O9Kxg/DARY52uEGOeZbsFU');
define('AUTH_SALT',        'NkJxBqHaiVOxg38CJNm6150ilD71Mp6e9rVnmSdyKao26GX+wUGj+0UrrjFW');
define('SECURE_AUTH_SALT', 'Ultg1xntbP5kyXgGGs6FhIJjXxf58yaxenoQEW0BK2kxyO5Ibv7aSDwt4Rth');
define('LOGGED_IN_SALT',   'qafxu7wviC8PFJQA77uEMa5uA4X0ck+CNHeifJdSSXh29RhiV/jMG7f7OGOc');
define('NONCE_SALT',       'n6WT8QA4kVG7B39GrWXsgo1gD4CCfs38W9DxyQ6/Wm/gEJiaiHF3kHfKv4QK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mod407_';

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

/* Fixes "Add media button not working", see http://www.carnfieldwebdesign.co.uk/blog/wordpress-fix-add-media-button-not-working/ */
define('CONCATENATE_SCRIPTS', false );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
