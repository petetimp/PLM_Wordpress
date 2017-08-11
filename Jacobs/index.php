<?php get_header(); ?>
<div class="col-sm-12 blog-main">
    
    <?php 
    if ( have_posts() ) { 
        while ( have_posts() ) : the_post();
    ?>
    <div class="blog-post">
		<?php 
	if(!is_page()){
		?>
        <h2 class="blog-post-title"><?php the_title(); ?></h2>
		<?php
			}
			if(!is_page()){
		?>
				<p class="blog-post-meta"><?php the_date(); ?> by <?php the_author(); ?></p>
		<?php
			}
			the_content(); 
		?>
    </div><!-- /.blog-post -->
    <?php
        endwhile;
    }

	if(is_single() || is_archive()){
    ?>
    <nav>
        <ul class="pager">
            <li><?php next_posts_link('Previous'); ?></li>
            <li><?php previous_posts_link('Next'); ?></li>
        </ul>
    </nav>
    <?php
    }
	?>
</div><!-- /.blog-main -->

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
