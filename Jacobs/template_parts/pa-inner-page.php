<?php
/*
Template Name: PA Inner Page
*/
?><?php get_header();
		get_template_part('includes/banners');
 ?>
		<div id="banner-img" class="vc_row wpb_row vc_row-fluid vc_row-no-padding" style="position: relative; left: 0px; box-sizing: border-box;">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="wpb_single_image wpb_content_element vc_align_center" style="margin-bottom:0;">
		
							<figure class="wpb_wrapper vc_figure">
								<div class="vc_single_image-wrapper   vc_box_border_grey">
									<!--<img src="<?php echo get_page_banner('0'); ?>" class="vc_single_image-img attachment-full normal" alt="" >-->
									<img src="<?php echo get_page_banner('1'); ?>" class="vc_single_image-img attachment-full fader" alt="" >
								</div>
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="content">
			<div class="col-xs-8 inner-practice-area body-content">

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
			<div class="col-xs-4">
				<?php dynamic_sidebar('practice-sidebar'); ?>
			</div>
		</div>  
	<?php get_footer(); ?>