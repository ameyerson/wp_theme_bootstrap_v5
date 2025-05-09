<?php global $logo_markup; ?>

			</main>

			<footer class="site-footer">

				<div class="container hidden-print">

					<div class="row g-3">

						<div class="col-lg-3">

							<div class="logo-wrapper"><?php if ($logo_markup) echo $logo_markup; ?></div>

						</div>

					</div>

				</div>

				<div id="colophon">

					<div class="container">

						<div class="row">

							<div class="col-lg-10 d-flex flex-column flex-lg-row align-items-lg-center ">

								<p>Copyright © <?php  echo date('Y'); ?></p>

							</div>

						</div>

					</div>

				</div>

			</footer>

		</div><!-- .site-content -->
		
	</div><!-- #page -->

	<?php get_template_part( 'template-parts/footer/modal', 'video' ); ?> 

<?php wp_footer(); ?>

</body>
</html>
