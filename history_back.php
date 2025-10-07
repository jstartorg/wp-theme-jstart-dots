<style>
.back-btn { display: flex; align-items: center; justify-content: flex-start; align-content: center; gap: 10px; }
.back-btn>div {cursor:pointer; width:max-content; display: flex; align-items: center; justify-content: flex-start; align-content: center; gap: 10px;}
.back-btn span { position:relative; top:3px; color:#4F387E; text-transform:uppercase; }
</style>
<div class="back-btn">
	<div onclick="window.history.back();">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Back-icon.svg" alt="Back-to-page">
        <span>The Latest</span>
    </div>
</div>