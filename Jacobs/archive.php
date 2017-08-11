<?php 
	get_header();

	if($post->post_type=="settlements"){
		$blog_heading= "SETTLEMENTS";
	}else{
		$blog_heading= "ARCHIVES";	
	}

?>
	<div id="banner-img" class="vc_row wpb_row vc_row-fluid">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner ">
				<div class="wpb_wrapper">
					<div class="wpb_single_image wpb_content_element vc_align_center">
		
						<figure class="wpb_wrapper vc_figure">
							<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1918" height="521" src="/files/2017/08/blog_banner.png" class="vc_single_image-img attachment-full" alt=""></div>
						</figure>
					</div>
					<div class="wpb_text_column wpb_content_element  content" id="banner-h1">
						<div class="wpb_wrapper">
							<h1><?php echo $blog_heading; ?></h1>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="content">
<div class="col-sm-8 blog-main body-content">
    
    <?php 
    if ( have_posts() ) { 
        while ( have_posts() ) : the_post();
    ?>
	
    <div class="blog-post content">
        <h1 class="blog-post-title"><?php the_title(); ?></h2>
		<p class="blog-post-meta"><?php the_date(); ?></p>
		<?php
			the_content(); 
		?>
    </div><!-- /.blog-post -->
    <?php
        endwhile;
		
    } 
    ?>
    <nav>
        <ul class="pager">
			<li class="prev-post-link"></li>
            <li class="next-post-link" ></li>
        </ul>
    </nav> 

</div><!-- /.blog-main -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>