<?php /* Template Name: Knowledgebase Page */
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
	#kb-content-wrapper {
		display:flex;
		column-gap: 1rem;
		margin: 3vh 7vw;
		width: 100%;
		:first-child {
			flex:1;
		}
		:nth-child(2) {
			flex:3;
		}
	}
</style>
	<div id="kb-content-wrapper">
		<div class="ast-left-sidebar">
			<?php dynamic_sidebar('sidebar_kb'); ?>
		</div>
		<div <?php astra_primary_class(); ?>>
			<?php
				if(current_user_can('edit_page'))
					echo '<div class="edit_link">'.edit_post_link(__('{Edit}')).'</div>';
				astra_primary_content_top();
				astra_content_page_loop();
				astra_primary_content_bottom();
			?>
		</div>
	</div>
<?php get_footer(); ?>
