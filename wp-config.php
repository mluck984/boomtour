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
define('DB_NAME', 'db179449_boomtourdev');

/** MySQL database username */
define('DB_USER', '1clk_wp_mCNfLpi');

/** MySQL database password */
define('DB_PASSWORD', 'uBNVMiPk');

/** MySQL hostname */
define('DB_HOST', 'internal-db.s179449.gridserver.com');

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
define('AUTH_KEY',         '5LO*EJJL}d[CE7J}}LXZ+ -`89jlNvtC_7(a3glT(=87yH|k&5B.mp)_@#]E+>Z|');
define('SECURE_AUTH_KEY',  '((mAG1|?;a= =k.!3[yu|88{wv>j)WSDd#[},h|,_8[f C|I@=68l}eh,K;m- o1');
define('LOGGED_IN_KEY',    'U`3_@8n&_dJ.Mfbcf9+agK&S^fT]*A@eSb8zRzt}^{OD@KX<HMYvc12uRh)HH8?Z');
define('NONCE_KEY',        'A[uH3`$-4@%6aiSB>1,|kFm+AI$.V|j+.<596=&f&4X~9Y~CdE]2y{L>hYOemiJK');
define('AUTH_SALT',        'coe#pJi|G=4 {K!DUfDi+Q--.~I]r F$+)aw$nTK,{U/{[=jv<tvN|.wB)bom f|');
define('SECURE_AUTH_SALT', 'k?I5kTYbB}9t|saG3-`>F-~X>iL 6}4zSm#8`.gb-w[kcXhJ#JBi]nsYq|$gTCm.');
define('LOGGED_IN_SALT',   '!(&[hkc)}&p!6yJ0!1x>udL;=841-9;8uT>]pTRuF<HYKUD9(.X5O>C$qSPJ}fnE');
define('NONCE_SALT',       '7HKQzbPYt%>cTdlS*yO|7LvW!bj|jU;o}Oq}|]3TBu}8H8p/4%(n2%UMt>w7`eW+');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
