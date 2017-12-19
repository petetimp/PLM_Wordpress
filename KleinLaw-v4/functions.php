<?php
function PLMTheme_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap','PLM');
	wp_register_style('PLM', get_template_directory_uri() . '/client.css' );
	wp_enqueue_style( 'PLM-style', get_stylesheet_uri(), $dependencies);
	wp_enqueue_style('Animations-CSS', "https://daneden.github.io/animate.css/animate.min.css");
	wp_enqueue_style('plm-slider', get_template_directory_uri().'/bootstrap/css/plmSlider.css');
	if (!wp_script_is( '/wp-content/plugins/js_composer/assets/css/js_composer.min.css', 'enqueued' )) {
		wp_enqueue_style('js_composer_front','/wp-content/plugins/js_composer/assets/css/js_composer.min.css');
	}	
}

function PLMTheme_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', $dependencies, '', true ); 
	wp_enqueue_script('velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.min.js', $dependencies, '', true );
	wp_enqueue_script('wow', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', $dependencies, '', true );
	wp_enqueue_script('plm-slider', get_template_directory_uri().'/bootstrap/js/plmSlider.js', $dependencies, '', true ); 
}

add_action( 'wp_enqueue_scripts', 'PLMTheme_enqueue_scripts');
add_action( 'wp_enqueue_scripts', 'PLMTheme_enqueue_styles' );


function PLMTheme_wp_setup() {
    add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-logo', array(
		'flex-width' => true
	) );
}

add_action( 'after_setup_theme', 'PLMTheme_wp_setup' );

function PLMTheme_register_menu() {
    register_nav_menu('header-menu', __( 'Header Menu' ));
	register_nav_menu('footer-menu-1', __( 'Footer Menu 1' ));
	register_nav_menu('footer-menu-2', __( 'Footer Menu 2' ));
	register_nav_menu('footer-menu-3', __( 'Footer Menu 3' ));
}

add_action( 'init', 'PLMTheme_register_menu' );

//[practice_area_one]
function practice_area_one_function( $atts ){
	global $post;
	$sidebarHTML.='<section id="practice-area-sidebar">
					<h3>PRACTICE AREAS</h3>
					<ul>';
	
	$args = array(
		// Arguments for your query.
		'post_type' => 'page',
		'post_parent' => '1019',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => '-1'
	);
	 
	// Custom query.
	$query = new WP_Query( $args );
	 
	// Check that we have query results.
	if ( $query->have_posts() ) {
	 
		// Start looping over the query results.
		while ( $query->have_posts() ) {
			$query->the_post();
	
			$sidebarHTML.=' <li>
								<a href="' . get_the_permalink()  . '">' . get_the_title() . '</a>';
								
			$children = get_pages( array( 'child_of' => get_the_ID() ) );
				
			if($children){
				$sidebarHTML.='<span class="handle">+</span>
							   <ul class="children-content"> ';
				
					foreach( $children as $child ) {
						if($child->ID != 191){
							$sidebarHTML.='<li><a href="' . get_page_link( $child->ID ) . '">' . get_the_title($child->ID) . '</a>';
							
							$grandchildren = get_pages( array( 'child_of' => $child->ID ) );
							
							if($grandchildren){
									foreach( $grandchildren as $grandchild ) {
										$sidebarHTML.='<ul class="grandchildren"><li><a href="' . get_page_link( $grandchild->ID ) . '">' . get_the_title($grandchild->ID) . '</a></li></ul>';		
									}
							}
							
							$sidebarHTML.="</li>";
						}
					}
				
				$sidebarHTML.=	'</ul>';
			}
					
			$sidebarHTML.='</li>';			

		}
	}
	// Restore original post data.
	wp_reset_postdata();
	
	$sidebarHTML.="</ul>
			</section>";
			
	
	
	
	return $sidebarHTML;
}

add_shortcode( 'practice_area_one', 'practice_area_one_function' );

//[practice_area_two]
function practice_area_two_function( $atts ){
	global $post;
	$sidebarHTML.='<section id="practice-area-sidebar">
					<h3>PRACTICE AREAS</h3>
					<ul>';
	
	$args = array(
		// Arguments for your query.
		'post_type' => 'page',
		'post_parent' => '33',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => '-1'
	);
	 
	// Custom query.
	$query = new WP_Query( $args );
	 
	// Check that we have query results.
	if ( $query->have_posts() ) {
	 
		// Start looping over the query results.
		while ( $query->have_posts() ) {
			$query->the_post();
			
			$bgImage = get_field('practice_area_background_image', $post->ID );
			$boxText= get_field('practice_area_box_text', $post->ID ); 
			
			$sidebarHTML.='<li data-bg="'. $bgImage .'">
								<a href="' . get_the_permalink()  . '">' . get_the_title() . '</a>';
								
			$children = get_pages( array( 'child_of' => get_the_ID() ) );
			
			$sidebarHTML.='		<ul class="pa-content">
									<li>' . $boxText . '</li>	
								</ul>';
			
			if($children){
				
				$sidebarHTML.='<span class="handle">+</span>
							   <ul class="children-content"> ';
				
					foreach( $children as $child ) {
						if($child->ID != 191){
							$sidebarHTML.='<li><a href="' . get_page_link( $child->ID ) . '">' . get_the_title($child->ID) . '</a>';
							
							$grandchildren = get_pages( array( 'child_of' => $child->ID ) );
							
							if($grandchildren){
									foreach( $grandchildren as $grandchild ) {
										$sidebarHTML.='<ul class="grandchildren"><li><a href="' . get_page_link( $grandchild->ID ) . '">' . get_the_title($grandchild->ID) . '</a></li></ul>';		
									}
							}
							
							$sidebarHTML.="</li>";
						}
					}
				
				$sidebarHTML.=	'</ul>';
			}
					
			$sidebarHTML.='</li>';			

		}
	}
	// Restore original post data.
	wp_reset_postdata();
	
	$sidebarHTML.="</ul>
			</section>";
	
	return $sidebarHTML;
	
}

add_shortcode( 'practice_area_two', 'practice_area_two_function' );

function PLMTheme_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Footer - Copyright Text',
        'id'            => 'footer_copyright_text',
        'before_widget' => '<div class="footer_copyright_text">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name'          => 'Sidebar - Default',
        'id'            => 'sidebar-2',
        'before_widget' => '<div class="sidebar-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
	
	register_sidebar( array(
        'name'          => 'Footer - First Column',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
	
	register_sidebar( array(
        'name'          => 'Footer - Second Column',
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
	
	register_sidebar( array(
        'name'          => 'Footer - Third Column',
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
	
	register_sidebar( array(
        'name'          => 'Footer - Fourth Column',
        'id'            => 'footer-4',
        'before_widget' => '<div class="footer-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

	register_sidebar( array(
        'name'          => 'Blog Sidebar',
        'id'            => 'blog-sidebar',
        'before_widget' => '<div class="blog-side">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
	
	register_sidebar( array(
        'name'          => 'News Sidebar',
        'id'            => 'news-sidebar',
        'before_widget' => '<div class="news-side">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
	
	register_sidebar( array(
        'name'          => 'Header Contact and Social',
        'id'            => 'header-contact',
        'before_widget' => '<div class="header-contact">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
	register_sidebar( array(
        'name'          => 'Practice Areas Sidebar',
        'id'            => 'practice-sidebar',
        'before_widget' => '<div class="practice-area-sidebar">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
 
}
add_action( 'widgets_init', 'PLMTheme_widgets_init' );

add_action( 'init', 'create_post_types' );
function create_post_types() {
  /*register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __( 'Testimonials' ),
        'singular_name' => __( 'Testimonial' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
  
  register_post_type( 'settlements',
    array(
      'labels' => array(
        'name' => __( 'Settlements' ),
        'singular_name' => __( 'Settlement' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );*/
}
?>