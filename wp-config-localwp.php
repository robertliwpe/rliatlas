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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'q7PkywkOOhfQPYwsom26tzlnDM/nb6Uk17kJIQeoZCW1yiXMospvkgV4fHgJ86t+ougNqLiq5lfszqi1u6o/KQ==');
define('SECURE_AUTH_KEY',  'ZQDVY38AxeVD6CRi6iZTLI3ZUcUsecPWskVhkHrVGVw8eHBP3LLD/6+BCLGcGFJALXaWVq88cy9HFgTrRLoIZA==');
define('LOGGED_IN_KEY',    '8E+DTTZuJ7Kju2hCsOd5sTSuRtDII5PLCSJEYAKx/kEfeh4Lk4S3tfH22vdOyLYCcSqlg7r6WHyAebS0pf37gQ==');
define('NONCE_KEY',        'alA+Hg5KrA/+Xpn1MkglgV0quCjOi/A4GNpCh43+XKqmh42GcjYHhWRgO7KYu71NumN0H5eDaz1tO47sRkwTnw==');
define('AUTH_SALT',        'B3BpQQKQoJ/fALr/HFxdmLR6TDwIK82s8YMpl+EJ9c49WZwOHOZdwecNYMWIP6cktvQCbuAS3xPK7bupdCi8KA==');
define('SECURE_AUTH_SALT', '5B9F9EVb74YvhAGJrUAs5o9lC7nB1Hbdi3OSVgjaqS2PsIvr6xxaOUnGQoschOg9DyMEjfEeFJ1M2RA5/NrD+w==');
define('LOGGED_IN_SALT',   'o4pvtqw5WcJ7wsl/wr0wKr1x/mY8pBkP0veGkTmhZ3lQV1P7Xt3ZPm+cIlPcxMGiAG+h21/gV3D1JkmBB50i5w==');
define('NONCE_SALT',       'Jrg9wDW95vCzRdQnxl2dmZXWn7+2GaDqDynyje84dNGnouVeMpqTruo/ZBMrICcqEfS8DDV1gzonbMC8DjGyEg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
