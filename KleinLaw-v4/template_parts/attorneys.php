<?php
/*
Template Name: Attorneys
*/
?><?php get_header();
		get_template_part('includes/banners');
 ?>
		<div id="banner-img" class="vc_row wpb_row vc_row-fluid vc_row-no-padding" style="position: relative; left: 0px; box-sizing: border-box;">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="wpb_single_image wpb_content_element vc_align_center">
		
							<figure class="wpb_wrapper vc_figure">
								<div class="vc_single_image-wrapper   vc_box_border_grey">
									<img width="1920" height="588" src="<?php echo get_page_banner(); ?>" class="vc_single_image-img attachment-full" alt=""  sizes="(max-width: 1920px) 100vw, 1920px"></div>
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="col-sm-8 col-xs-12">

          <?php 
			if ( have_posts() ) { 
				while ( have_posts() ) {
					the_post();
		  ?>
					<div class="blog-post">
				<?php
					the_content(); 
				?>
					</div><!-- /.blog-post -->
		  <?php
				}
			} 
		  ?>

        </div>

		<div class="col-sm-4 col-xs-12" id="bio-menu">
			<?php dynamic_sidebar('attorney-sidebar'); ?>
		</div>
      
	<?php get_footer(); ?>