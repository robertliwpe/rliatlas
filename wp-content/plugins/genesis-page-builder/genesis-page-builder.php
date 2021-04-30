<?php
/**
 * Plugin Name: Genesis Blocks Pro
 * Plugin URI: https://wpengine.com/genesis-pro
 * Author: WP Engine
 * Author URI: http://wpengine.com
 * Description: Part of Genesis Pro, Genesis Blocks Pro enables you to create beautiful and effective content faster with block-based page-building tools.
 * Version: 1.3.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Genesis\PageBuilder
 */

namespace Genesis\PageBuilder;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize Genesis Blocks Free
 */
function genesis_blocks_free_loader() {

	$lib_path         = plugin_dir_path( __FILE__ ) . 'lib/';
	$gb_pre_installed = function_exists( 'genesis_blocks_main_plugin_file' );
	$gb_lib_exists    = file_exists( $lib_path . 'genesis-blocks/genesis-blocks.php' );

	/**
	 * Check to see if Genesis Blocks is already installed from wordpress.org.
	 * If it is, deactivate it and trigger this loader to run again
	 * to load Genesis Blocks from lib/genesis-blocks.
	 */
	if ( $gb_lib_exists && $gb_pre_installed ) {
		add_action(
			'plugins_loaded',
			function() {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
				\deactivate_plugins( \plugin_basename( genesis_blocks_main_plugin_file() ) );
				add_action( 'plugins_loaded', __NAMESPACE__ . '\genesis_blocks_free_loader', 11 );
			}
		);
	}

	if ( $gb_lib_exists && ! $gb_pre_installed ) {
		require_once $lib_path . 'genesis-blocks/genesis-blocks.php';
	}

	/**
	 * For some reason, Genesis Blocks was not bundled in lib/genesis-blocks.
	 * Show an admin notice for a graceful fallback.
	 */
	if ( ! $gb_lib_exists ) {
		add_action( 'admin_notices', __NAMESPACE__ . '\do_missing_gb_lib_notice' );
	}

}
add_action( 'plugins_loaded', __NAMESPACE__ . '\genesis_blocks_free_loader', 1 );

/**
 * Deactivates the Genesis Blocks Pro plugin if it exists.
 */
function deactivate_genesis_blocks_pro() {
	if ( function_exists( '\Genesis\BlocksPro\genesis_blocks_pro_main_plugin_file' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		\deactivate_plugins( \plugin_basename( \Genesis\BlocksPro\genesis_blocks_pro_main_plugin_file() ) );
	}
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\deactivate_genesis_blocks_pro', 0 );

/**
 * Returns the full path and filename of the main Genesis Page Builder plugin file.
 *
 * @return string
 */
function main_plugin_file() {
	return __FILE__;
}

/**
 * Bootstraps the plugin.
 */
function plugin_loader() {

	// Check for a proper version of Genesis Blocks before proceeding.
	if ( ! function_exists( 'genesis_blocks_register_layout_component' ) ) {
		return;
	}

	$includes_dir = plugin_dir_path( __FILE__ ) . 'includes/';

	require_once $includes_dir . 'layouts/register-layout-components.php';
	require_once $includes_dir . 'updates/update-functions.php';
	require_once $includes_dir . 'permissions/block-settings.php';
	require_once $includes_dir . 'settings/analytics.php';
	require_once $includes_dir . 'settings/tabs/general.php';
	require_once $includes_dir . 'settings/tabs/block-permissions.php';
	require_once $includes_dir . '../src/blocks/portfolio/index.php';

	add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\settings_page_assets', 20 );
	add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\permissions_assets', 20 );

}
add_action( 'plugins_loaded', __NAMESPACE__ . '\plugin_loader', 11 );

/**
 * Loads the plugin translation files.
 */
function textdomain() {
	load_plugin_textdomain( 'genesis-page-builder', false, basename( __DIR__ ) . '/languages' );
}
add_action( 'init', __NAMESPACE__ . '\textdomain' );

/**
 * Loads the block editor scripts and styles.
 */
function editor_assets() {

	// Editor scripts.
	wp_enqueue_script(
		'genesis-page-builder-blocks',
		plugins_url( '/build/blocks.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor', 'wp-edit-post', 'wp-data', 'wp-plugins', 'wp-api' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/blocks.js' ),
		true
	);

	wp_localize_script(
		'genesis-page-builder-blocks',
		'genesis_page_builder_globals',
		array(
			'blockSettingsPermissions' => \Genesis\PageBuilder\Permissions\block_settings_permissions(),
			'allRoles'                 => get_editable_roles(),
		)
	);

	// Editor styles.
	wp_enqueue_style(
		'genesis-page-builder-editor-styles',
		plugins_url( '/build/editor.styles.build.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/editor.styles.build.css' )
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\editor_assets' );

/**
 * Loads frontend scripts and styles.
 */
function frontend_assets() {
	wp_enqueue_style(
		'genesis-page-builder-frontend-styles',
		plugins_url( '/build/frontend.styles.build.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/frontend.styles.build.css' )
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\frontend_assets' );
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\frontend_assets' );

/**
 * Loads the necessary scripts to get registered block data
 * on the settings page outside the post editor.
 */
function settings_page_assets() {

	if ( 'toplevel_page_genesis-blocks-settings' !== get_current_screen()->id ) {
		return;
	}

	wp_enqueue_script( 'react' );
	wp_enqueue_script( 'react-dom' );

	wp_add_inline_script(
		'wp-blocks',
		sprintf( 'wp.blocks.setCategories( %s );', wp_json_encode( get_block_categories( get_post() ) ) ),
		'after'
	);

	do_action( 'enqueue_block_editor_assets' );

	$block_registry = \WP_Block_Type_Registry::get_instance();

	foreach ( $block_registry->get_all_registered() as $block_name => $block_type ) {
		if ( ! empty( $block_type->editor_script ) ) {
			wp_enqueue_script( $block_type->editor_script );
		}
	}

	wp_enqueue_style(
		'genesis-page-builder-settings-page-styles',
		plugins_url( '/includes/settings/styles/settings-permissions.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'includes/settings/styles/settings-permissions.css' )
	);
}

/**
 * Loads block settings permission scripts in the block editor.
 */
function block_settings_permissions_assets() {
	wp_enqueue_script(
		'genesis-page-builder-block-settings-permissions-scripts',
		plugins_url( '/build/settingsPermissions.js', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/settingsPermissions.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\block_settings_permissions_assets' );

/**
 * Loads the settings page assets related to block settings permissions.
 */
function permissions_assets() {

	if ( 'toplevel_page_genesis-blocks-settings' !== get_current_screen()->id ) {
		return;
	}

	wp_add_inline_script(
		'wp-blocks',
		sprintf( 'wp.blocks.setCategories( %s );', wp_json_encode( [ [ 'slug' => 'genesis-blocks' ] ] ) ),
		'after'
	);

	do_action( 'enqueue_block_editor_assets' );

	wp_enqueue_script(
		'genesis-page-builder-settings-page-scripts',
		plugins_url( '/build/settingsPage.js', __FILE__ ),
		array( 'wp-i18n', 'wp-components', 'wp-plugins', 'wp-hooks', 'wp-data', 'wp-api-fetch', 'genesis-blocks-settings-app' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/settingsPage.js' ),
		true
	);
}

/**
 * Displays a notice if Genesis Blocks is missing
 * from the lib/genesis-blocks directory.
 * Runs on admin_notices hook.
 *
 * @see plugin_loader()
 */
function do_missing_gb_lib_notice() {
	printf( '<div class="error"><p>%s</p></div>', esc_html__( 'The Genesis Blocks library is missing. Please download and install Genesis Blocks Pro again.', 'genesis-page-builder' ) );
}
