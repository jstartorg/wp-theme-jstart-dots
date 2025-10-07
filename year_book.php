<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/post-grid-style.css">
<div class="popup-content">
                    <div class="single-group-section d-flex">
                        <div class="single-featured" style="width:100%;">
                            <!-- <img src="" alt="featured-image"> -->
                             <div class="wrapper">
                                <div class="slider">
                               <?php
                                if ( have_rows('image_repeater') ): ?>
                                 <?php while ( have_rows('image_repeater') ): the_row(); ?>
                                  <?php $images = get_sub_field('images'); ?>
                   <?php if( !empty($images) ): ?>
                                    <div><img src="<?php echo esc_url($images['url']); ?>" alt="<?php echo esc_attr($images['alt']); ?>"></div>
                                    <?php endif; ?>
                                    <?php endwhile; ?> 
                                    <?php endif; ?>
                                </div>
                                <div class="slider-nav">
                                <?php
                                if ( have_rows('image_repeater') ): ?>
                                 <?php while ( have_rows('image_repeater') ): the_row(); ?>
                                 <?php $images = get_sub_field('images'); ?>
                   <?php if( !empty($images) ): ?>
                                    <div><img src="<?php echo esc_url($images['url']); ?>" alt="<?php echo esc_attr($images['alt']); ?>"></div>
                                    <?php endif; ?>
                                    <?php endwhile; ?> 
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://rawgit.com/kenwheeler/slick/master/slick/slick.js"></script>
<script type="text/javascript">
        $('.slider').slick({
            autoplaySpeed: 1000,
            pauseOnHover: true,
            arrows: false,
            dots: false,
            infinite: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            infinite: false,
            focusOnSelect: true,
            asNavFor: '.slider',
        });
    </script>
<link rel="stylesheet" href="https://rawgit.com/kenwheeler/slick/master/slick/slick.css">