<?php

$slides = get_sub_field('slides');
$background_color = get_sub_field('background_color');
$this_carousel_id = bin2hex(random_bytes(2));

?>


<section class="carousel-section page-section <?php echo $background_color ?>">

  <div class="container">

      <?php if ($slides) : ?>

        <div id="carousel-<?php echo $this_carousel_id; ?>" class="image-carousel usaaef-carousel">


      <?php

        $i = 0;

        $slide_div = array();
        $coins = array();

          foreach( $slides as $slide ):

            $slide_div = '<div class="carousel-slide';
            if ($i == 0)
              $slide_div .= ' active';
            $slide_div .=  '">';

            $slide_image = $slide['slide_image'];
            $slide_image_src = wp_get_attachment_image_url($slide_image, 'large', false);
            $slide_image_alt = get_post_meta($slide_image , '_wp_attachment_image_alt', true) ?: $slide['slide_title'];

            $slide_div .= '<div class="col-md-6 image-wrapper"><img class="m-0" src="' . $slide_image_src . '" alt="' . $slide_image_alt . '"></div>';

            $slide_div .= '<div class="col-md-6"><div class="slide-body">';
            if ($slide['slide_title'] != '') { $slide_div .= '<div class="h3">' . $slide['slide_title'] . '</div>';}
            $slide_div .= $slide['slide_content'] . '</div></div>';

            $slide_div .= '</div>';

            $slide_divs[] = $slide_div;


            $coin = '<button type="button" data-target="#carousel-' . $this_carousel_id . '"';
            if ($i == 0) {
              $coin .=  'class="active" aria-current="true"'; 
            }
            $coin .= 'aria-label="' . $slide['slide_title'] . '"><span></span></button>';

            $coins[] = $coin;

            $i++; 

          endforeach;

          $slide_markup = '';

          $slide_markup = implode('',$slide_divs);
          $coin_pager_markup = '<div class="coin-pager image-coin-pager">';
          $coin_pager_markup .= implode('',$coins);
          $coin_pager_markup .= '</div>';
      ?>

            <div class="carousel-inner <?php if (count($slides) > 1) echo 'has-slides'; ?>">

              <?php echo $slide_markup; ?>

            </div>

            <div class="carousel-nav hidden-print">

              <button class="image-carousel-prev carousel-prev" type="button" data-target="#carousel-<?php echo $this_carousel_id; ?>" style="opacity: 0;" tabindex="-1" aria-hidden="true">
                <i class="las la-angle-left"></i>
                <span class="visually-hidden">Previous</span>
              </button>
              
              <?php echo $coin_pager_markup; ?>

              <button class="image-carousel-next carousel-next" type="button" data-target="#carousel-<?php echo $this_carousel_id; ?>" tabindex="0">
                <i class="las la-angle-right"></i>
                <span class="visually-hidden">Next</span>
              </button>

            </div>

        </div>

  <?php endif; ?><!--if ($slides)-->

  </div>

</section><!-- /section.carousel-section   -->

