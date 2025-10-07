<style>
.fund-card { display: flex; align-items: center; gap: 12px; padding: 16px; border-bottom: 1px solid #eeeeee; max-width: 100%; }
.fund-avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; }
.fund-info { flex: 1; }
.fund-header { display: flex; justify-content: space-between; align-items: center; }
.fund-title { font-size: 16px; font-weight: bold; color: #3a2374; margin: 0; text-transform: capitalize; }
.fund-goal { font-size: 18px; color: #3a2374; font-weight: 400; }
.fund-raised { margin: 4px 0; font-size: 14px; color: #3a2374; }
.fund-progress { width: 100%; height: 16px; background: #f1eaff; border-radius: 10px; overflow: hidden; }
.fund-bar { height: 100%; background: #7b5ca0; border-radius: 10px; transition: 0.3s all; }
.fund-header p.fund-raised { margin: 0; }
@media(max-width:600px){
.fund-goal { font-size: 13px; }
.fund-header p.fund-raised { font-size: 12px; }
.fund-title { font-size: 13px; }
.fund-card { padding: 16px 0px; margin-top: 0px; }
.fund-avatar { width: 50px; height: 50px; }
</style>
<?php
$args = array(
    'post_type'      => 'leaderboard',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        $post_id = get_the_ID();
        $goal_amount   = get_field('goal_amount');
        $raised_amount = get_field('raised_amount');
        $goal_amount   = is_numeric($goal_amount) ? floatval($goal_amount) : 0;
        $raised_amount = is_numeric($raised_amount) ? floatval($raised_amount) : 0;
        $percentage = ($goal_amount > 0) ? ($raised_amount / $goal_amount) * 100 : 0;
        $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail');
        if (!$thumbnail) {
            $thumbnail = "https://via.placeholder.com/60";
        }
        ?>
        <div class="fund-card">
            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" class="fund-avatar">
            <div class="fund-info">
                <h3 class="fund-title"><?php the_title(); ?></h3>
                <div class="fund-header">
                    <p class="fund-raised">$<?php echo number_format($raised_amount, 2); ?> RAISED</p>
                    <span class="fund-goal">GOAL: $<?php echo number_format($goal_amount, 2); ?></span>
                </div>
                
                <div class="fund-progress">
                    <div class="fund-bar" style="width: <?php echo min(round($percentage, 2), 100); ?>%;"></div>
                </div>
            </div>
        </div>

        <?php
    endwhile;
    wp_reset_postdata();
else :
    echo "<p>No leaderboard posts found.</p>";
endif;
?>