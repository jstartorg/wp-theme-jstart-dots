<?php /* Template Name: Site Management Binder */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header(); ?>
<script type="text/javascript">
	const current_user = '<?= wp_get_current_user()->user_email; ?>'
        const currentEmail = '<?= wp_get_current_user()->user_email; ?>'
        const currentUsername = '<?= wp_get_current_user()->user_login; ?>'
</script>
	<div id="smb-content-wrapper">
		<div class="ast-left-sidebar">
			<?php dynamic_sidebar('sidebar_smb'); ?>
		</div>
		<div id="smb-content" <?php astra_primary_class(); ?>>
			<?php
				if(current_user_can('edit_pages'))
					edit_post_link(__('Edit'));
				astra_primary_content_top();
				astra_content_page_loop();
				astra_primary_content_bottom();
			?>
		</div>
	</div>
<?php get_footer(); ?>
