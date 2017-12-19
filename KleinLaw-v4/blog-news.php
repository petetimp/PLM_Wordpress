<?php
/*
Template Name: Blog/News
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
       	<div class="content">
        	<div class="col-sm-8 col-xs-12 body-content">

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

			<div id="blog-sidebar" class="col-sm-4 col-xs-12">
				<?php
					if(is_page(201)){
						dynamic_sidebar("news-sidebar");
					}else{
						dynamic_sidebar("blog-sidebar");	
					}
				?>
			</div>
		</div>
      
	<?php get_footer(); ?>