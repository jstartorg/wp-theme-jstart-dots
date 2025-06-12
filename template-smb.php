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
<style>
	#smb-content-wrapper {
		display:flex;
		column-gap: 1rem;
		:first-child {
			flex:1;
		}
		:nth-child(2) {
			flex:3;
		}
	}
</style>
<!--     <h1 class="js_page_title"><?php the_title(); ?></h1> -->
	<div id="smb-content-wrapper">
		<div class="ast-left-sidebar">
			<?php dynamic_sidebar('sidebar_smb'); ?>
		</div>
		<div id="smb-content" <?php astra_primary_class(); ?>>
			<?php astra_primary_content_top(); ?>
			<?php astra_content_page_loop(); ?>
			<?php astra_primary_content_bottom(); ?>
		</div>
	</div>
<?php get_footer(); ?>
