<?php 
get_header(); 

global $post;

if ($post->post_type=="post"){
	$blog_heading= "";
	$blog_banner="/files/2017/12/blog-banner.jpg";
}else if($post->post_type=="news_releases"){
	$blog_heading= "NEWS RELEASES";
	$blog_banner="/files/2017/09/news-banner.jpg";
}else if($post->post_type=="settlements"){
	$blog_heading= "SETTLEMENTS";
	$blog_banner="/files/2017/08/blog-banner.png";
}else if($post->post_type=="testimonials"){
	$blog_heading= "TESTIMONIALS";
	$blog_banner="/files/2017/08/testimonials-banner-2.png";
}
							

?>
	<div id="banner-img" class="vc_row wpb_row vc_row-fluid">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner ">
				<div class="wpb_wrapper">
					<div class="wpb_single_image wpb_content_element vc_align_center">
		
						<figure class="wpb_wrapper vc_figure">
							<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1918" height="521" src="<?php echo $blog_banner; ?>" class="vc_single_image-img attachment-full" alt=""></div>
						</figure>
					</div>
					<div class="wpb_text_column wpb_content_element content" id="banner-h1">
						<div class="wpb_wrapper">
							
							<h2><?php echo $blog_heading; ?></h2>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="row content">
	<div class="col-sm-8 blog-main">
		
		<?php 
		if ( have_posts() ) { 
			while ( have_posts() ) : the_post();
		?>
		
		<div class="blog-post">
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
				<li><?php next_posts_link('Previous'); ?></li>
				<li><?php previous_posts_link('Next'); ?></li>
			</ul>
		</nav>

	</div><!-- /.blog-main -->

	<?php //get_sidebar(); ?>
	<div class="col-sm-4">
	<?php echo do_shortcode('[practice_area_one]'); ?>
	<?php if(!is_page(21)){	//Don't add this to contact page ?>
		<h3 class="consultation-text" style="text-align: center;">NEED A CONSULTATION?</h3>

		<div class="img-wrapper">
			<img data-toggle="modal" data-target="#formModal" class="aligncenter size-full wp-image-4097" src="http://klein-law2.premierlegalmarketing.com/files/2017/12/CTA-button.png" alt="" width="278" height="55" />
		</div>
	<?php 	if(!is_page(18)){//Don't add this to testimonials page ?>
		<div id="plm-slider">
			<h3>TESTIMONIALS</h3>
			<div class="arrow arrow-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
					<div data-wow-duration="1s" class="wow fadeInLeft currSlide" id='slide-1'>
						<p>"Richard C. Klein helped me get the help I needed from my ex to raise and care for my autistic child. He came recommended for special needs child cases and I was satisfied with his effort and the outcome of my case." - Client</p>
					</div>
					<div data-wow-duration="1s" class="wow fadeInLeft" id='slide-2'>
						<p>"Mr. Klein has battled relentlessly to help me achieve custody of my child . His skill and dedication and accessibility is something that has helped me through this period. He is always there and is a skilled negotiator as well. He has become far more that just my “divorce attorney”. I know that I am protected with his help." - K.R.</p>
					</div>
					<div data-wow-duration="1s" class="wow fadeInLeft" id='slide-3'>
						<p>"I had a spouse who would simply not follow Court Orders. Richard knew just how to get the protection for myself and my daughter that I needed. He was always there with kind words and skilled beyond my expectations." - N.B.</p>
					</div>
					<div data-wow-duration="1s" class="wow fadeInLeft" id='slide-4'>
						<p>"Over 10 years ago Mr. Klein handled my divorce. He negotiated an agreement that worked perfectly. All of these years later, when it came time for me to retire, I went back to him. I would not consider another attorney. He has argued forcefully in Court for me and I know that I am in the best of hands with him." - G. McG</p>
					</div>
					<!--<div data-wow-duration="1s" class="wow fadeInLeft" id='slide-5'>
						<p>"I was so worried that no one would understand what it meant to have a special needs child during divorce. Mr. Klein knew about this in detail and I know has written and dealt with so many of these situations. Now, she is protected and the Court, thanks to Richard, understood that special care was needed when it came to custody and parenting time. I am so grateful that I found an attorney with his degree of knowledge. His fees are fair and he demonstrated unbelievable compassion." - K.L.</p>
					</div>-->
					<div class="arrow arrow-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
		</div>
	<?php   } 
		  }
	?>
	</div>
</div>
<?php get_footer(); ?>