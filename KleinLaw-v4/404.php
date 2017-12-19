<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div class="col-sm-12 blog-main">

<div class="blog-post">
<section id="banner-img-container" class="vc_section"><div id="banner-img" class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_single_image wpb_content_element vc_align_center">

<figure class="wpb_wrapper vc_figure">
<div class="vc_single_image-wrapper   vc_box_border_grey"><img src="/files/2017/09/our-team-banner.jpg" class="vc_single_image-img attachment-full" alt="" srcset="/files/2017/09/our-team-banner.jpg 1920w, /files/2017/09/our-team-banner-300x90.jpg 300w, /files/2017/09/our-team-banner-768x230.jpg 768w, /files/2017/09/our-team-banner-1024x306.jpg 1024w" sizes="(max-width: 1920px) 100vw, 1920px" width="1920" height="574"></div>
</figure>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="vc_section content">
<div class="vc_row wpb_row vc_row-fluid">
<div class="wpb_column vc_column_container vc_col-md-8">
<div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h1>NOT FOUND</h1>
					<h2><?php _e( 'This is somewhat embarrassing, isn’t it?', 'twentythirteen' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

					<?php get_search_form(); ?>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-sm-4 col-xs-12" id="blog-sidebar">
<?php echo do_shortcode( '[practice_area_one]');?>
</div>
</div>
</section>
</div>
</div>

<?php get_footer(); ?>