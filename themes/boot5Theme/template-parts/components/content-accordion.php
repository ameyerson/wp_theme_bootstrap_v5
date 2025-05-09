<?php

$tabs = get_sub_field('accordion_tab');
$background_color = get_sub_field('background_color');
$this_accordion_id = bin2hex(random_bytes(2));

?>


<section class="accordion-section page-section <?php echo $background_color ?>">

  <div class="container">


      <?php if ($tabs) :

        $i = 1;

      ?>

        <div class="accordion" id="accordion-<?php echo $this_accordion_id ?>">

                <?php foreach( $tabs as $tab ): ?>

                    <div class="accordion-item">

                      <h3 class="accordion-header" id="accordiongroup-<?php echo $tab['accordion_tab_slug'] ?>-tab">

                        <button class="accordion-button collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#accordiongroup-<?php echo $tab['accordion_tab_slug'] ?>-panel" 
                                aria-expanded="false" 
                                aria-controls="accordiongroup-<?php echo $tab['accordion_tab_slug'] ?>-panel">

                          <?php echo $tab['accordion_tab_title']; ?>

                        </button>

                      </h3>

                      <div id="accordiongroup-<?php echo $tab['accordion_tab_slug'] ?>-panel" class="accordion-collapse collapse" 
                          data-bs-parent="#accordion-<?php echo $this_accordion_id ?>" 
                          aria-labelledby="accordiongroup-<?php echo $tab['accordion_tab_slug'] ?>-tab">

                          <div class="accordion-body">


                              <?php echo $tab['accordion_tab_content']; ?>


                          </div>

                      </div><!-- accordiongroup-<?php echo $tab['accordion_tab_slug'] ?>-panel -->

                    </div>

                <?php $i++; endforeach; ?>

        </div><!-- accordion -->

  <?php endif; ?><!--if ($tabs)-->

  </div>

</section>