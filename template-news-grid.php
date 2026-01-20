<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/css/custom-style.css">

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;

  
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999; /* above everything */
  display: none; /* hidden by default */
}


@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


.loader-overlay {
  position: fixed;
  top: 0;
    left: 0;
    right: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.7);
  z-index: 9998;
  display: none;
}

</style>

<div class="sorting-filter">
<div class="filter-dropdown">

<!-- <div class="category-filter">
    <div class="filter-result">
        <?php 
        $default_term = get_term(318, 'category'); ?>
        <span> <?php echo esc_html($default_term->name); ?>  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/appearance-icon.svg" alt="drop-image"></span>
    </div>

    <div class="category-fields" style="display:none;">
        <ul>
            <?php
            $category_ids = [318, 319];

            foreach ($category_ids as $cat_id):
                $category = get_term($cat_id, 'category');

                if ($category && !is_wp_error($category)):
                    $children = get_terms(array(
                        'taxonomy' => 'category',
                        'parent'   => $category->term_id,
                        'orderby'  => 'name',
                        'order'    => 'ASC',
                        'hide_empty' => false
                    ));
            ?>
                    <li class="category-text" data-value="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>

                        <?php if (!empty($children)): ?>
                            <ul class="subcategory-fields">
                                <?php foreach ($children as $child): ?>
                                    <li class="category-text" data-value="<?php echo esc_attr($child->slug); ?>">
                                        <?php echo esc_html($child->name); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
            <?php
                endif;
            endforeach;
            ?>
        </ul>
    </div>
</div> -->




  </div>
</div>
<div class="loader-overlay"></div>
<div class="loader"></div>
<div id="news-results" class="d-grid grid-style main-grid column-template-4 lg-column-template-3 md-column-template-2 sm-column-template-1 grid-gap-36 lg-grid-gap-54 md-grid-gap-54 sm-grid-gap-60">
    <?php
    $terms = get_terms([
    'taxonomy'   => 'category', 
    'hide_empty' => true,
]);

$matching_term_ids = [];
if (!is_wp_error($terms)) {
    foreach ($terms as $term) {
        if (stripos($term->name, 'Read for the record') !== false) {
            $matching_term_ids[] = $term->term_id;
        }
    }
}

if (!empty($matching_term_ids)) {
    $query = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'category__in'   => $matching_term_ids,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
    if($query->have_posts()):
        while($query->have_posts()): $query->the_post(); ?>
            <div class="articles-post blog-post">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <div class="post-featured-img">
                   
                        <?php if(has_post_thumbnail()) { the_post_thumbnail('full',['alt'=>get_the_title()]); }
                        else { ?>
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri().'/images/slider-image-2.png'); ?>" alt="">
                        <?php } ?>
                    
                </div>
                <div class="latest-featured-content">
                    <div class="short-info">
                        <p><?php echo get_the_title();?></p>
                    </div>
                    <div class="latest-post-date">
                        <span class="blog-publish-date"><?php echo esc_html( get_the_date('F j, Y') ); ?></span>
                        <span class="blog-category">
                            <?php
$category = get_the_category();
if (!empty($category)) {
    foreach ($category as $cat) {
        if (stripos($cat->name, 'Read for the record') !== false) {
            echo esc_html($cat->name);
            break; // Stop after first match
        }
    }
}
//$category=get_the_category(); if(!empty($category)) echo esc_html($category[0]->name); ?>
                        </span>
                    </div>
                </div>
  </a>
             </div>
  
        <?php endwhile; wp_reset_postdata();
    endif;
    } ?>
</div>
<script type="text/javascript">
// jQuery(document).ready(function($){
//     function loadPosts(categorySlug) {
//         $('#news-results').fadeOut(200, function(){
//             $.ajax({
//                 url: '<?php echo admin_url("admin-ajax.php"); ?>',
//                 type: 'POST',
//                 data: {
//                     action: 'filter_posts',
//                     category: categorySlug
//                 },
//                 beforeSend: function() {
//                     $('.loader-overlay').show();
//                     $('.loader').show();
//                 },
//                 success: function(response) {
//                     $('#news-results').html(response).fadeIn(200);
//                 },
//                 complete: function(){
//                     $('.loader-overlay').hide();
//                     $('.loader').hide();
//                 }
//             });
//         });
//     }
//     $('.filter-result').click(function(){
//         $('.category-fields').slideToggle(200);
//     });
//     $(document).on('click', '.category-text', function(e){
//         e.stopPropagation();
//         var selectedText = $(this).text();
//         var categorySlug = $(this).data('value');
//         $('.filter-result span').html(selectedText + ' <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/appearance-icon.svg" alt="drop-image">');
//         $('.category-fields').slideUp(200);
//         $('.category-text').removeClass('selected');
//         $(this).addClass('selected');
//         loadPosts(categorySlug);
//     });
//     $(document).click(function(e) {
//         if (!$(e.target).closest('.category-filter').length) {
//             $('.category-fields').slideUp(200);
//         }
//     });
// });
</script>