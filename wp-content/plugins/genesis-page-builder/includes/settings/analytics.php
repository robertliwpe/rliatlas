<?php
/**
 * Outputs analytics scripts in the admin if the user has opted in.
 *
 * @package Genesis\PageBuilder\Analytics
 */

namespace Genesis\PageBuilder\Analytics;

/**
 * Loads the opt-in analytics script in wp-admin.
 */
add_action(
	'admin_enqueue_scripts',
	function() {
		if ( empty( get_option( 'genesis_page_builder_analytics_opt_in', false ) ) ) {
			return;
		}
		?>
		<?php
		// phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-17364082-14"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-17364082-14');
		</script>
		<?php
	}
);
