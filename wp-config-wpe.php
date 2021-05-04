<?php
# Database Configuration
define( 'DB_NAME', 'wp_rliatlas' );
define( 'DB_USER', 'rliatlas' );
define( 'DB_PASSWORD', '2MeN53vtF8WVZRE6dCep' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';
# Security Salts, Keys, Etc
define('AUTH_KEY',         '+J^a9OS]sd[JDN{K4]pKE,GI`~]Pb$)4,qvSR*~xkb~r a0b;J9<oTvg]&{[@]aV');
define('SECURE_AUTH_KEY',  '2]hnr(7GWjsXjZ).bp4t<V&ajiW(_8GEz`x} }sG#6`EPc{VyIa&07ZYh@}n-%]D');
define('LOGGED_IN_KEY',    'IT#`z&vzB87*XDO@zWcBsYj<WY;S+|H}@A[:u.Hzwd#RJ{e|t{M|SuXRGyXH>o0/');
define('NONCE_KEY',        '+tTz}oM~xR}Bj{ ^1|Z|tbZ)47QH^YV$,oXMW?,^l+*li)fZ{*w1=XbFxHK!bPdH');
define('AUTH_SALT',        'JQ+TK#Ix@.z+IA#KbNs`)[wly7]w5Q;l]ftGUmzRlH:!?jEBmb[T*;3 < kR%I,D');
define('SECURE_AUTH_SALT', 'Hx?3<R>OL+rA`19tdd4PA+pw?2`Als r.D@R|RnYjPBlo8JU qTB HgxJ=+FDQc^');
define('LOGGED_IN_SALT',   'T%L; u;ip4jH!xY+ |B@^Lo($r]S8u?=I6M<L/lnE}j3>_:W0LF#3Vj0UJ%=n|(L');
define('NONCE_SALT',       '_Kp#mC!B[A;6[]:Q0mlDid2}4@j2O9W+%X2se]-S<rJu`HK)Q$.%5T0jxZ,L[/Ku');
# Localized Language Stuff
define( 'WP_CACHE', TRUE );
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'PWP_NAME', 'rliatlas' );
define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', 0775 );
define( 'FS_CHMOD_FILE', 0664 );
umask(0002);
define( 'WPE_APIKEY', '6c91d7835cb9e7207d256f9049d6774db9e0cbcc' );
define( 'WPE_CLUSTER_ID', '120205' );
define( 'WPE_CLUSTER_TYPE', 'pod' );
define( 'WPE_ISP', true );
define( 'WPE_BPOD', false );
define( 'WPE_RO_FILESYSTEM', false );
define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );
define( 'WPE_SFTP_PORT', 2222 );
define( 'WPE_LBMASTER_IP', '' );
define( 'WPE_CDN_DISABLE_ALLOWED', true );
define( 'DISALLOW_FILE_MODS', FALSE );
define( 'DISALLOW_FILE_EDIT', FALSE );
define( 'DISABLE_WP_CRON', false );
define( 'WPE_FORCE_SSL_LOGIN', false );
define( 'FORCE_SSL_LOGIN', false );
/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/
define( 'WPE_EXTERNAL_URL', false );
define( 'WP_POST_REVISIONS', FALSE );
define( 'WPE_WHITELABEL', 'wpengine' );
define( 'WP_TURN_OFF_ADMIN_BAR', false );
define( 'WPE_BETA_TESTER', false );
$wpe_cdn_uris=array ( );
$wpe_no_cdn_uris=array ( );
$wpe_content_regexs=array ( );
$wpe_all_domains=array ( 0 => 'rliatlas.wpengine.com', 1 => 'rliatlas.wpenginepowered.com', );
$wpe_varnish_servers=array ( 0 => 'pod-120205', );
$wpe_special_ips=array ( 0 => '35.196.100.184', );
$wpe_netdna_domains=array ( );
$wpe_netdna_domains_secure=array ( );
$wpe_netdna_push_domains=array ( );
$wpe_domain_mappings=array ( );
$memcached_servers=array ( );
define('WPLANG','');
# WP Engine ID
# WP Engine Settings
# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');