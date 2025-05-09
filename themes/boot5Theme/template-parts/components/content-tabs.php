<?php

$tabs = get_sub_field('tab_panes');

?>


<section class="tabs-section page-section">

  <div class="container">


      <?php if ($tabs) :

        $i = 0;

        $nav_markup = '<ul class="nav nav-tabs list-unstyled" role="tablist">';
        $pane_markup = '<div class="tab-content" id="myTabContent">';

        $lis = array();
        $panes = array();

          foreach( $tabs as $tab ):

            $li = '<li class="nav-item mb-0" role="presentation">';
            $li .= '<button class="nav-link ';
            if ($i == 0) {
              $li .= 'active';
            }
            $li .= '" id="' . $tab['tab_pane_slug'] . '-tab" data-bs-toggle="tab" data-bs-target="#' . $tab['tab_pane_slug'] . '" type="button" role="tab" aria-controls="' . $tab['tab_pane_slug']  . '" aria-selected="';

            if ($i == 0) {
              $li .= 'true';
            } else {
              $li .= 'false';
            }

            $li .= '">' . $tab['tab_pane_title'] . '</button></li>';

            $lis[] = $li;

            $content = '<div class="tab-pane fade ';
            if ($i == 0) {
              $content .= 'active show';
            }
            $content .= '" id="' . $tab['tab_pane_slug'] . '" role="tabpanel" aria-labelledby="' . $tab['tab_pane_slug'] . '-tab">';
            $content .= $tab['tab_pane_content'];
            $content .= '</div>';

            $panes[] = $content;

            $i++; 

          endforeach;

      $nav_markup .= implode('',$lis);
      $nav_markup .= '</ul>';

      $pane_markup .= implode('',$panes);
      $pane_markup .= '</div>';


      ?>

        <div class="tabs">

          <?php echo $nav_markup; ?>
          <?php echo $pane_markup; ?>

        </div><!-- tab-section -->

  <?php endif; ?><!--if ($tabs)-->

  </div>

</section><!-- /section.tabs-section  -->