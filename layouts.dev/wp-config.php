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
define('DB_NAME', 'layoutsDBpjupj');

/** MySQL database username */
define('DB_USER', 'layoutsDBpjupj');

/** MySQL database password */
define('DB_PASSWORD', 'Pgr7GPajr');

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
define('AUTH_KEY',         'i#52DSt*+]6Wie~:OZWh_1D9Klx#_:Oapli.{6Xmyu.QbXj.{7Xx#.;Paqmx2E');
define('SECURE_AUTH_KEY',  'my3IUQb$}73Ffrn$>JUQq*AMITu.{7Xjfq{BMIUgv!@>8Zkgs}CNJVw!@:8nzv,0');
define('LOGGED_IN_KEY',    'Rs!@}8Zklht;DOKWx_~;9SePLl|~[KVSp-w_D5Ghtp#1:9WS]LDPq+u;A6Hebm<2{');
define('NONCE_KEY',        'jBQjy${FUj:Z-|!0Cdokw1C8OZ-40Bco@z|FRNYo[40CRs@zx1D9Ka+#_1Deplx2D');
define('AUTH_SALT',        'x2;DPq+$y,EUfbn>3Bcr$z,FUgc$6IEPf^{<3Tfuq$7IEUfs@z|4Vgco[8JGRs@-');
define('SECURE_AUTH_SALT', 'Cds:9OKVDPLWm#2;9am+x.DPLam<HDOp-]#1Seal+5HDOp+x#.EQMXy<3AbnjuB');
define('LOGGED_IN_SALT',   'i5Lat#9PDWq.2#ATmat.j$q^3MfUn$I7Qjy}^3Mi+I6Mfy{*Mbuj${EXMRkz}!');
define('NONCE_SALT',       'n<3Io@[8o@:8Nds@:CRr^0Fv,4JVkz|4JZap-]9p~;9Oet_;Dhs!1GV|5KZl-[5KL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
