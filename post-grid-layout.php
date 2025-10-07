<?php
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/post-grid-style.css">
<style>
    #overlay{   
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100%;
  max-width: 100%;
  height:100%;
  display: none;
  background: rgb(152 130 198 / 88%);
  margin:0;
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
</style>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
<div class="d-grid grid-style main-grid column-template-4 lg-column-template-3 md-column-template-2 sm-column-template-1 grid-gap-36 lg-grid-gap-54 md-grid-gap-54 sm-grid-gap-60">

<?php
// Get all categories for books
$book_terms = get_terms( array(
    'taxonomy'   => 'books-category',
    'hide_empty' => true,
) );

usort( $book_terms, function( $a, $b ) {
    preg_match('/\d+/', $a->name, $a_num);
    preg_match('/\d+/', $b->name, $b_num);
    return (int)$a_num[0] - (int)$b_num[0];
});
 $discription = "";
if ( !empty($book_terms) && !is_wp_error($book_terms) ) :
    foreach ( $book_terms as $book_term ) : 
    
      
    ?>
    <div>
        <!-- Category Title -->
        <div class="post-header">
            <div class="week-detail"><span><?php echo esc_html( $book_term->name ); ?></span></div>
        </div>

        <?php
        // Query posts from this category
        $args = array(
            'post_type'      => 'books',
            'posts_per_page' => 20,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'books-category',
                    'field'    => 'term_id',
                    'terms'    => $book_term->term_id,
                ),
            ),
        );
        $books_query = new WP_Query( $args );

        if ( $books_query->have_posts() ) :
            while ( $books_query->have_posts() ) : $books_query->the_post();

                $books_date      = get_field('book_date');
                $writer_name     = get_field('writer_name');
                $illustrator_name= get_field('illustrator_name');
                $record_year     = get_field('record_year');
                $house_name      = get_field('house_name');
        ?>
 <?php
$coming_soon = get_field('coming_soon'); 
$button_class = '';

if ( (is_array($coming_soon) && in_array('Yes', $coming_soon))   
  || ($coming_soon === 'Yes')                                   
  || ($coming_soon === 1)                                      
) {
    $button_class = '';
}else{
$button_class = 'learn-more-btn';

}
?>
        <a href="javascript:void(0)" class="<?php echo $button_class; ?>" data-id="<?php echo get_the_ID(); ?>" style="text-decoration: none;">
            <div class="grid-item <?php echo ( is_array(get_field('check_mark')) && in_array('Yes', get_field('check_mark')) ) ? 'check_mark' : ''; ?>">
                <div class="post-inner">
                    <div class="post-header">
                       
                        <div class="day-detail"><span><?php echo $books_date; ?></span></div>
                        <div class="curve-style"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/curve-line.svg" alt="curve-icon"></div>
                    </div>

                    <div class="post-body">
                        <div class="featured-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                            <?php else: ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/featured-image.jpg" alt="featured-image">
                            <?php endif; ?>
                        </div>
                        <div class="post-content">
                            <div class="post-title-heading">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <div class="post-info-detail">
                                <span class="custom-field custom-field-1">Written By <strong><?php echo $writer_name; ?></strong></span>
                                <span class="custom-field custom-field-2">Illustrated by <strong><?php echo $illustrator_name; ?></strong></span>
                                <span class="custom-field custom-field-3"><strong><?php echo $record_year; ?></strong></span>
                            </div>
                            <?php 
                              if($book_term->name == 'Week 20'){
                                echo "<div class='post-excerpt'>";
                                  the_excerpt();
                                echo "</div>";
                              }
                            ?>
                            
                               <?php 
$coming_soon = get_field('coming_soon'); 
?>


    <?php if ( is_array($coming_soon) && in_array('Yes', $coming_soon) ) : ?>
    <div class="post-detail-button coming-soon">
        <span>Coming soon</span>
         </div>
    <?php else : ?>
        <div class="post-detail-button">
            <span>Learn more</span>
       </div>
    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <?php endwhile; wp_reset_postdata(); endif; ?>
</div>
    <?php endforeach;
endif;
?>

</div>


  
    <div class="overlay-popup" style="display:none;">
  <div class="popup-content">
     <div class="inner-popup">
                <div class="close-button">
                    <img class="close-button-new" src="<?php echo get_stylesheet_directory_uri(); ?>/images/close-icon.svg" alt="close-btn">
                </div>
    <div class="single-group-section d-flex">
      
      <div class="single-featured">
        <div class="wrapper">
          <div class="slider"></div>
          <div class="slider-nav"></div>
        </div>

        <div class="single-header">
          <div class="single-post-title"><h2 class="popup-title"></h2></div>
          <div class="single-post-info-detail">
            <span class="popup-writer"></span>
            <span class="popup-illustrator"></span>
            <span class="popup-record"></span>
            <span class="popup-date"></span>
          </div>
        </div>
      </div>

      <div class="single-detail-panel">
           <div class="single-header">
            <div class="single-post-title">
           <h2 class="popup-title"></h2>
                  </div>
              <div class="single-post-info-detail">
             <span class="custom-field custom-field-1 popup-writer"></span>
           <span class="custom-field custom-field-2 popup-illustrator"></span>
           <span class="custom-field custom-field-4 popup-date"></span>
       <span class="custom-field custom-field-3 popup-record"></span>
     
         </div>
    </div>

<div class="single-body">
    <div class="single-content popup-content-text">
          <p class="popup-content-text"></p>
            </div>
         </div>

                  <div class="single-footer">
                     <div class="multi-button-group">
                                    <a class="popup-first-btn" href=""></a>
                                    <a class="popup-second-btn" href=""></a>
                                </div>
                                <div class="single-button-group">
                                    <a href="" class="group-icon popup-third-btn">
                                        <img class="popup-third-logo" src="" alt="">
                                        <span class="popup-third-text"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="second-group-section">

                        <div class="addtional-heading additional_download_section-condition">
                            <h4 class="heading"></h4>
                        </div>

                        <div class="additional-download additional_download_section-condition">
                            <div class="multi-download-button-group">
                              
                            </div>
                        </div>

                        <div  class="addtional-heading">
                            <h4>Related Blog Posts</h4>
                        </div>

                        <div class="latest-post-loop d-grid grid-gap-36 column-template-3 lg-column-template-1- md-column-template-1 sm-column-template-1" id="related_post_data">



                            <div class="articles-post">
                                <div class="post-featured-img">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider-image-2.png" alt="*">
                                </div>
                                <div class="latest-featured-content">
                                    <div class="short-info">
                                        <p>Lorem ipsum dolor sit amet, consec tetur nimar adipiscing</p>
                                    </div>
                                    <div class="latest-post-date">
                                        <span>February 13, 2025</span>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                        <div class="addtional-heading">
                            <h4 class="popup-author-heading"></h4>
                        </div>

                        <div class="addtional-content-panel">
                            <p class="popup-author-content"></p>
                        </div>

                        <div class="addtional-heading">
                            <h4 class="popup-illustrator-heading"></h4>
                        </div>

                        <div class="addtional-content-panel">
                            <p class="popup-illustrator-content"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://rawgit.com/kenwheeler/slick/master/slick/slick.js"></script>
   <script>
    jQuery(document).ready(function($){
  $(document).on("click", ".learn-more-btn", function(e){
    e.preventDefault();
$("#overlay").fadeIn(300);　
    let post_id = $(this).data("id");

    $.ajax({
      url: ajaxurl.url,
      type: "POST",
      dataType: "json",
      data: {
        action: "get_book_details",
        post_id: post_id
      },
      beforeSend: function(){
      //$(".overlay-popup").fadeIn();
  $(".popup-content").append('<div class="popup-loading">Loading...</div>');
      },
      success: function(response){
        $("#overlay").fadeOut(300);　
        $(".overlay-popup").fadeIn();
        if(response.success){
            $(".popup-loading").remove();
          let data = response.data;

          // Reset popup-content to HTML skeleton (already in DOM)
          $(".popup-content").html($(".popup-template").html());

          // Append basic fields
          $(".popup-title").text(data.title);
          $(".popup-writer").html('Written By <strong>'+data.writer_name+'</strong>');
          $(".popup-illustrator").html('Illustrated by <strong>'+data.illustrator_name+'</strong>');
          $(".popup-record").html('<strong>'+data.record_year+'</strong>');
          $(".popup-date").html('<strong>'+data.book_date+'</strong>');
          $(".popup-content-text").html(data.content);

          // Author & Illustrator
          $(".popup-author-heading").text(data.author_heading);
          $(".popup-author-content").text(data.author_content);
          $(".popup-illustrator-heading").text(data.illustrator_heading);
          $(".popup-illustrator-content").text(data.illustrator_content);



          // Buttons
          if(data.first_button.text){
            $(".popup-first-btn").text(data.first_button.text).attr("href", data.first_button.link).show();
          } else {
            $(".popup-first-btn").hide();
          }

          if(data.second_button.text){
            $(".popup-second-btn").text(data.second_button.text).attr("href", data.second_button.link).show();
          } else {
            $(".popup-second-btn").hide();
          }

          if(data.third_button.text){
           $(".popup-third-btn").attr("href", data.third_button.link).show();
            $(".popup-third-logo").attr("src", data.third_button.logo.url);
            $(".popup-third-text").text(data.third_button.text);
          } else {
            $(".popup-third-btn").hide();
          }

          $(".heading").text(data.additional_heading);



          
          let additional_html = "";

if (Array.isArray(data.additional_downloads) && data.additional_downloads.length) {
  data.additional_downloads.forEach(function(item){
    additional_html += `<a href="${item.link}"><img src="${item.icon}" alt="${item.alt}">${item.text}</a>`;
  });
}

$(".multi-download-button-group").html(additional_html);


if (data.additional_section_show == "no") {
  $(".additional_download_section-condition").css('display','none');
} else {
  $(".additional_download_section-condition").css('display','block');
}

if (Array.isArray(data.related_posts_data) && data.related_posts_data.length) {
  let html = "";
  data.related_posts_data.forEach(function(post) {
    html += `
      <div class="articles-post">
        <div class="post-featured-img">
          <a href="${post.link}">
            <img src="${post.image}" alt="${post.title}">
          </a>
        </div>
        <div class="latest-featured-content">
          <div class="short-info">
            <p>${post.content}</p>
          </div>
          <div class="latest-post-date">
            <span>${post.date}</span>
          </div>
        </div>
      </div>
    `;
  });
  $("#related_post_data").html(html);
} else {
  $("#related_post_data").html("<p>No related posts found.</p>");
  $(".inner-popup .second-group-section").addClass("hide-section");
}


          
          let sliderHtml = "";
          let sliderNavHtml = "";
          if(data.images.length){
            data.images.forEach(function(img){
              sliderHtml += `<div><img src="${img.url}" alt="${img.alt}"></div>`;
              sliderNavHtml += `<div><img src="${img.url}" alt="${img.alt}"></div>`;
            });
          }
          $(".slider").html(sliderHtml);
          $(".slider-nav").html(sliderNavHtml);

          // Init slick
          $(".slider").slick({
            autoplaySpeed: 1000,
            pauseOnHover: true,
            arrows: false,
            dots: false,
            infinite: false,
            fade: true,
            asNavFor: ".slider-nav"
          });
          $(".slider-nav").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            infinite: false,
            focusOnSelect: true,
            asNavFor: ".slider",
          });
        } else {
          $(".popup-content").html("<p>Error loading content.</p>");
        }
      }
    });
  });

  // Close popup
  $(document).on("click", ".close-button,.close-button-new", function(e){
    if ($(".slider").hasClass("slick-initialized")) {
        $(".slider").slick("unslick");
      }
      if ($(".slider-nav").hasClass("slick-initialized")) {
        $(".slider-nav").slick("unslick");
      }

      // Reset popup to template skeleton
      $(".popup-content").html($(".popup-template").html());
    $(".overlay-popup").css('display','none');
    $(".overlay-popup").fadeOut();
    if ($(e.target).hasClass("overlay-popup") || $(e.target).hasClass("close-button")) {
      $(".overlay-popup").fadeOut();
      $(".overlay-popup").css('display','none');

       if ($(".slider").hasClass("slick-initialized")) {
        $(".slider").slick("unslick");
      }
      if ($(".slider-nav").hasClass("slick-initialized")) {
        $(".slider-nav").slick("unslick");
      }

      // Reset popup to template skeleton
      $(".popup-content").html($(".popup-template").html());
    }
  });
});
    </script>