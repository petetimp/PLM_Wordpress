<?php
/*
Plugin Name: PLM Post Shortcode
Plugin URI:  https://premierlegalmarketing.com
Description: Blog/Post Type shortcode with several options
Version:     20170619
Author:      premierlegalmarketing.com
Author URI:  https://premierlegalmarketing.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: plmorg
Domain Path: /languages

PLM Post Shortcode is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
PLM Post Shortcode is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with PLM Post Shortcode. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

/**
 * Google Font URL
 * Combine multiple google font in one URL
 * @link https://shellcreeper.com/?p=1476
 * @author David Chandra <david@shellcreeper.com>
 */
function tamatebako_google_fonts_url( $fonts, $subsets = array() ){
 
    /* URL */
    $base_url    =  "//fonts.googleapis.com/css";
    $font_args   = array();
    $family      = array();
 
    /* Format Each Font Family in Array */
    foreach( $fonts as $font_name => $font_weight ){
        $font_name = str_replace( ' ', '+', $font_name );
        if( !empty( $font_weight ) ){
            if( is_array( $font_weight ) ){
                $font_weight = implode( ",", $font_weight );
            }
            $family[] = trim( $font_name . ':' . urlencode( trim( $font_weight ) ) );
        }
        else{
            $family[] = trim( $font_name );
        }
    }
 
    /* Only return URL if font family defined. */
    if( !empty( $family ) ){
 
        /* Make Font Family a String */
        $family = implode( "|", $family );
 
        /* Add font family in args */
        $font_args['family'] = $family;
 
        /* Add font subsets in args */
        if( !empty( $subsets ) ){
 
            /* format subsets to string */
            if( is_array( $subsets ) ){
                $subsets = implode( ',', $subsets );
            }
 
            $font_args['subset'] = urlencode( trim( $subsets ) );
        }
 
        return add_query_arg( $font_args, $base_url );
    }
 
    return '';
}

/**
 * Get dynamic array of Google Fonts form Google Fonts API
 * --STILL IN DEVELOPMENT--
 */
function get_google_fonts(){
	$access_key="AIzaSyCexm2cZ2OochGBJVH6nWzZezM6XZQn-Zg";
	$url ='https://www.googleapis.com/webfonts/v1/webfonts?key=' . $access_key;
	
	$data = file_get_contents($url);
	$font_json=json_decode($data, true);
	
	$font_Array=array();
	
	foreach($font_json['items'] as $item){
		$font_Array[]=$item['family'];	
	}
	
	return $font_Array;

}

/**
 * Enqueue front facing CSS
 * 
 */
function plm_blog_enqueue_styles() {
    wp_register_style('plm-blog-font-css', '/wp-content/plugins/plm-post-shortcode/public/css/front.css' );
	wp_enqueue_style('PLM Blog Css', '/wp-content/plugins/plm-post-shortcode/public/css/front.css'); 
}

add_action( 'wp_enqueue_scripts', 'plm_blog_enqueue_styles' );


/**
 * Returns array of categories from blog
 */
function get_blog_categories(){
	$categories = get_categories(
		array(
    		'orderby' => 'name',
    		'order'   => 'ASC'
   		) 
	);
	
   $category_Array=array("");
	
   foreach( $categories as $category ) {
   		 $category_Array[] = $category->name;    
   }
	
   return $category_Array;
}

//This action runs the custom shortcode GUI function before Visual Composer initializes
add_action( 'vc_before_init', 'plm_blog_integrateWithVC' );


/**
 * This function maps all of the custom GUI fields to the custom VC shortcode
 */
function plm_blog_integrateWithVC() {
	
   $optionCategories=get_blog_categories();
   $fontOptions=get_google_fonts();
	   
   vc_map( 
	   array(
		   "name" => __( "PLM Blog", "plmorg" ),
		   "base" => "plm_blog",
		   "class" => "plm-blog",
		   'admin_enqueue_css' => array('/wp-content/plugins/plm-post-shortcode/admin/vc-extend/plm-blog-admin.css'),
		   'admin_enqueue_js' => array('/wp-content/plugins/plm-post-shortcode/admin/vc-extend/plm-blog-admin.js'),
		   "category" => __( "Content", "plmorg"),
		   "params" => 
	   		  array(
				 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Number of posts", "plmorg" ),
					"param_name" => "number",
					"value" => __( array("1","2","3","4","5","6","7","8","9","10","-1"), "plmorg" ),
					"description" => __( "Please Select Number of Posts. (-1 means all)", "plmorg" )
				 ),
	   			 array(
					"type" => "posttypes",
					"class" => "",
					"heading" => __( "Post Type", "plmorg" ),
					"param_name" => "post_type",
	   				"value" => 'post',
					"description" => __( "Post Type for Posts", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Categories", "plmorg" ),
					"param_name" => "category_name",
					"value" => __($optionCategories),
					"description" => __( "Display Posts Based on Category", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Exclude Categories", "plmorg" ),
					"param_name" => "exclude_categories",
					"value" => __("0","plmorg"),
					"description" => __( "Exclude Categories Based on Category IDs (separate multiple categories with commas)", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Post Order", "plmorg" ),
					"param_name" => "post_order",
					"value" => __(array("DESC","ASC")),
					"description" => __( "Please Choose Order of Posts", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Sort By", "plmorg" ),
					"param_name" => "order_by",
					"value" => __(array("date", "none", "ID", "author", "title", "name", "type", "modified", "parent", "rand", "comment","relevance", "menu_order", "meta_value")),
					"description" => __( "Choose What to Sort Posts By. See <a target=\"_blank\" href=\"https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters\">here</a> for full list of parameters.", "plmorg" )
				 ),
	   			 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Blog Width", "plmorg" ),
					"param_name" => "blog_width",
					"value" => __( "400px", "plmorg" ),
					"description" => __( "Please Specify Width of Blog (Any CSS unit accepted)", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "pagination",
					"heading" => __( "Pagination", "plmorg" ),
					"param_name" => "pagination",
					"value" => __( array("No","Yes"), "plmorg" ),
					"description" => __( "Show Pagination? (Can't be used with Load More Posts)", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "pagination hidden",
					"heading" => __( "Pagination Style", "plmorg" ),
					"param_name" => "pagination_style",
					"value" => __( array("Prev/Next","Numbered"), "plmorg" ),
					"description" => __( "Pick the style for the blog pagination.", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "load-more-posts",
					"heading" => __( "Load More Posts", "plmorg" ),
					"param_name" => "load_more_posts",
					"value" => __( array("No","Yes"), "plmorg" ),
					"description" => __( "Show the Load More Posts Button? (Can't be used with Pagination)", "plmorg" )
				 ),
	   			 array(
					"type" => "textfield",
					"class" => "load-more-posts hidden",
					"heading" => __( "Number of Load More Posts", "plmorg" ),
					"param_name" => "load_more_posts_number",
					"value" => __( array("No","Yes"), "plmorg" ),
					"description" => __( "Number of Posts to Show after load more button has been clicked.", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "featured-image",
					"heading" => __( "Featured Image", "plmorg" ),
					"param_name" => "featured_image",
					"value" => __( array("No","Yes"), "plmorg" ),
					"description" => __( "Show the Featured Image?", "plmorg" )
				 ),
	   			 array(
					"type" => "textfield",
					"class" => "featured-image hidden",
					"heading" => __( "Featured Image Size", "plmorg" ),
					"param_name" => "featured_image_size",
					"value" => __( "300x300", "plmorg" ),
					"description" => __( "Please Specify Width and Height of Featured Image and use Number Values (for example, 'Width'x'Height', 350x200)", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "featured-image hidden",
					"heading" => __( "Blog Post Column Size", "plmorg" ),
					"param_name" => "blog_post_column_size",
					"value" =>__( array("1/3-2/3","1/4-3/4"), "plmorg" ),
					"description" => __( "Please Specify the Column Size for your Blog Posts", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "featured-image hidden",
					"heading" => __( "Default Featured Image", "plmorg" ),
					"param_name" => "default_featured_image",
					"value" => __( "/wp-content/plugins/plm-post-shortcode/public/images/default-placeholder-300x300.png", "plmorg" ),
					"description" => __( "Please Specify Default Featured Image as an URI", "plmorg" )
				 ),
	   			 array(
					"type" => "checkbox",
					"class" => "blog-box-shadow",
					"heading" => __( "Include Box Shadow?", "plmorg" ),
					"param_name" => "blog_shadow",
					"value" => __( "", "plmorg" ),
					"description" => __( "Please Indicate if You'd Like a Shadow Around Your Widget", "plmorg" )
				 ),
	   			 array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Background Color", "plmorg" ),
					"param_name" => "b_color",
					"value" => '#0f4b91',
					"description" => __( "Choose Background Color for Widget", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "show-blog-title",
					"heading" => __( "Show Blog Title", "plmorg" ),
					"param_name" => "show_blog_title",
					"value" => __( array("No","Yes"), "plmorg" ),
					"description" => __( "Show the Title of the Blog?", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "blog-title hidden",
					"heading" => __( "Title of Blog", "plmorg" ),
					"param_name" => "blog_title",
					"value" => __( "RECENT POSTS", "plmorg" ),
					"description" => __( "Please Input Title of Blog", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "blog-title hidden",
					"heading" => __( "HTML Tag", "plmorg" ),
					"param_name" => "blog_title_html",
					"value" => __( array("h3","h1","h2","h4","h5","h6","p","div","section"), "plmorg" ),
					"description" => __( "HTML Tag for Title", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "blog-title hidden",
					"heading" => __( "Blog Title Alignment", "plmorg" ),
					"param_name" => "blog_title_alignment",
					"value" => __( array("center","left","right"), "plmorg" ),
					"description" => __( "Alignment for Blog Title", "plmorg" )
				 ),
	   			 array(
					"type" => "colorpicker",
					"class" => "blog-title hidden",
					"heading" => __( "Blog Title Color", "plmorg" ),
					"param_name" => "blog_title_color",
					"value" => '#ffffff',
					"description" => __( "Choose Blog Title Color", "plmorg" )
				 ),
	   			 array(
					"type" => "dropdown",
					"class" => "blog-title hidden",
					"heading" => __( "Blog Title Font Family", "plmorg" ),
					"param_name" => "blog_title_font_family",
					"value" => __($fontOptions,"plmorg"),
					"description" => __( "Please Pick the Font Family for the Blog Title", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "blog-title hidden ",
					"heading" => __( "Blog Title Font Size", "plmorg" ),
					"param_name" => "blog_title_font_size",
					"value" => __( "24px", "plmorg" ),
					"description" => __( "Please Input Font Size for Blog Title", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "show-post-content",
					"heading" => __( "Include Post Content?", "plmorg" ),
					"param_name" => "show_post_content",
					"value" => __(array("No","Yes"),"plmorg"),
					"description" => __( "Select whether you'd like to show post content", "plmorg" )
				 ),
				 array(
					"type" => "colorpicker",
					"class" => "post-content hidden",
					"heading" => __( "Post Content Color", "plmorg" ),
					"param_name" => "post_content_color",
					"value" => '#ffffff',
					"description" => __( "Choose Post Content Font Color", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "post-content hidden",
					"heading" => __( "Post Content Font Size", "plmorg" ),
					"param_name" => "post_content_font_size",
					"value" => '13px',
					"description" => __( "Choose Post Content Font Size", "plmorg" )
				 ),
	   			 array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Post Title Color", "plmorg" ),
					"param_name" => "post_color",
					"value" => '#ffffff',
					"description" => __( "Choose Post Title Color", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Post Title Font Size", "plmorg" ),
					"param_name" => "post_title_font_size",
					"value" => __( "18px", "plmorg" ),
					"description" => __( "Please Input Font Size for Post Title", "plmorg" )
				 ),
	   			 array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Date Color", "plmorg" ),
					"param_name" => "date_color",
					"value" => '#ffffff',
					"description" => __( "Choose Post Date Color", "plmorg" )
				 ),
	   			 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Before Date Text", "plmorg" ),
					"param_name" => "before_date_text",
					"value" => __( "", "plmorg" ),
					"description" => __( "Text to Go Before Post Date (Default is ' ')", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Date Font Size", "plmorg" ),
					"param_name" => "date_font_size",
					"value" => __( "14px", "plmorg" ),
					"description" => __( "Please Input Font Size for Post Date", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Date Position", "plmorg" ),
					"param_name" => "date_position",
					"value" => __( array("Before Post Title", "After Post Title"), "plmorg" ),
					"description" => __( "Choose Before or After Post Title", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "show-excerpt",
					"heading" => __( "Show the Excerpt?", "plmorg" ),
					"param_name" => "show_excerpt",
					"value" => __(array("No","Yes"),"plmorg"),
					"description" => __( "Select Whether You'd Like to Show the Excerpt.", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "show-excerpt hidden",
					"heading" => __( "Excerpt Length", "plmorg" ),
					"param_name" => "excerpt_length",
					"value" => __( "55", "plmorg" ),
					"description" => __( "Specify Excerpt Length (In Words)", "plmorg" )
				 ),
	   			array(
					"type" => "colorpicker",
					"class" => "show-excerpt hidden",
					"heading" => __( "Excerpt Color", "plmorg" ),
					"param_name" => "excerpt_color",
					"value" => '#ffffff',
					"description" => __( "Choose Excerpt Color", "plmorg" )
				 ),
	   			 array(
					"type" => "textfield",
					"class" => "show-excerpt hidden",
					"heading" => __( "Excerpt Font Size", "plmorg" ),
					"param_name" => "excerpt_font_size",
					"value" => __( "16px", "plmorg" ),
					"description" => __( "Specify Excerpt Font Size", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "show-excerpt hidden",
					"heading" => __( "Post End Chars", "plmorg" ),
					"param_name" => "excerpt_end_chars",
					"value" => __( "...", "plmorg" ),
					"description" => __( "Input What You'd Like to Use At the End of Each Excerpt (Default is ...)", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "read-more",
					"heading" => __( "Read More Link", "plmorg" ),
					"param_name" => "read_more",
					"value" => __(array("No","Yes"),"plmorg"),
					"description" => __( "Show Read More Link?", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "read-more hidden",
					"heading" => __( "Read More Text", "plmorg" ),
					"param_name" => "read_more_text",
					"value" => __( "Read More &gt;&gt;", "plmorg" ),
					"description" => __( "Input What You'd Like to Use for Each Read More Link (Default is Read More >>)", "plmorg" )
				 ),
				 array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'plmorg' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'plmorg' )
				 )
	   			 
      		)
   		)
   );
	
}

//Not sure what this does, but it was in the documentation
class WPBakeryShortCode_plm_blog extends WPBakeryShortCode {
}

//This filter officially registers the [plm_blog] shortcode with Visual composer
add_filter( 'vc_grid_item_shortcodes', 'plm_blog_add_grid_shortcodes' );

/**
 * Officially registers the [plm_blog] shortcode with Visual composer
 */
function plm_blog_add_grid_shortcodes( $shortcodes ) {
   $shortcodes['plm_blog'] = array(
     'name' => __( 'PLM Blog', 'plmorg' ),
     'base' => 'plm_blog',
     'category' => __( 'Content', 'plmorg' ),
     'description' => __( 'PLM blog shortcode with several options', 'plmorg' ),
     'post_type' => Vc_Grid_Item_Editor::postType(),
  );
   return $shortcodes;
}

/**
 * Proper function for hooking plugin activation/deactivation
 */
function plm_post_shortcode_flush(){
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'plm_post_shortcode_flush' );
register_deactivation_hook( __FILE__, 'plm_post_shortcode_flush' );

/**
 * Function that actually parses shortcode and blog HTML
 * @param atts {{ array }} shortcode attributes present in shortcode
 */
function plm_post_shortcode( $atts){
	global $post;


	$css = '';

	//Default attribute values are set here.  If others are present in the shortcode, they will be used instead
	$atts = shortcode_atts(
		array(
			'number' => '3',
			'blog_width' => '300px',
			'pagination' => 'No',
			'pagination_style' => 'Prev/Next',
			'load_more_posts' => 'No',
			'load_more_posts_number' => '',
			'blog_shadow' => '',
			'featured_image' => 'No',
			'featured_image_size' => '300x300',
			'default_featured_image' => '',
			'blog_post_column_size' => '',
			'show_blog_title' => 'No',
			'blog_title' => 'RECENT POSTS',
			'blog_title_html'=> 'h3',
			'blog_title_alignment' => 'center',
			'post_type' => 'post',
			'show_post_content' => 'No',
			'post_content_color' => "#ffffff",
			'post_content_font_size'=>"13px",
			'category_name' => '',
			'exclude_categories' => '0',
			'post_order' => 'DESC',
			'order_by' => 'date',
			'b_color' => '#0f4b91',
		    "blog_title_color" => "#ffffff",
		    "post_color" => "#ffffff",
		    "date_color" => "#ffffff",
			"before_date_text" => "",
			"date_font_size" => "14px",
			"post_title_font_size" => "18px",
			"blog_title_font_size" => "24px",
			"blog_title_font_family" => "Open Sans",
			"date_position" => "Before Post Title",
			"show_excerpt" => "No",
			"excerpt_color" => "#ffffff",
			"excerpt_font_size" => "16px",
			"excerpt_length" => "55",
			"excerpt_end_chars" => "...",
			"read_more" => "No",
			"read_more_text" => "Read More &gt;&gt;",
			'css' => ''
		), $atts, 'plm_blog' 
	);

	//parse out inline style from Visual Composer Design Options tab
	$leftBracket=stripos($atts['css'],"{");
	$atts['css']=substr($atts['css'],$leftBracket + 1);
	$atts['css']=rtrim($atts['css'],"}");
	
	//parse out height and width of featured image
	$xImage=stripos($atts['featured_image_size'],"x");
	//echo "<script>console.log('".$xImage."')</script>";
	$imageWidth=substr($atts['featured_image_size'], 0, 3);
	$imageWidth=(int) preg_replace('/\D/', '', $imageWidth);
	$imageHeight=substr($atts['featured_image_size'], $xImage + 1, 3);
	//echo "<script>console.log('".$imageHeight."')</script>";
	$imageHeight=(int) preg_replace('/\D/', '', $imageHeight);
	

	//This code is for the 'load more posts' / pagination component
	if($atts['load_more_posts_number'] != '' || $atts['pagination']=='Yes'){
		$postsPerPage=$atts['number'];
		$atts['number']="-1";//we set number of posts to unlimited to have all posts on one page
		
		//Can't have pagination and load more posts at same time
		if($atts['pagination']=='Yes'){
			$atts['load_more_posts'] = 'No';	
		}
	}
	
	//Set args for WP_Query
	$args = array(
		// Arguments for your query.
		'post_type' => $atts['post_type'],
		'orderby' => $atts['order_by'],
		'order' => $atts['post_order'],
		'posts_per_page' => $atts['number'],
		'category_name' => $atts['category_name'],
		'category__not_in' => array($atts['exclude_categories'])
	);
	
	// Custom query.
	$query = new WP_Query( $args );
	 
	// Check that we have query results.
	if ( $query->have_posts() ) {
		
		//Custom Pagination
		$postCount = $query->found_posts;//number of found posts
		
		$numPages = intval($postCount / $postsPerPage);//number of pages
		$modulus = fmod($postCount,$postsPerPage);
		$onPage=1;
		$postNum=1;
		
		if($modulus != 0){//if this is greater than 0 we add a page for leftover posts
			$numPages += 1; 
		}
		
		//Featured Image/Blog Post Column Width
		if($atts['blog_post_column_size'] == "1/4-3/4"){
			$atts['blog_post_column_size']=array(3,9);
		}
		else{
			$atts['blog_post_column_size']=array(4,8);
		}
		//blog box shadow
		if($atts['blog_shadow']=="true"){
			$blogHTML="<div id='dummy-blog-container'  style='background-color:" . $atts['b_color'] . ";" . $atts['css'] . ";width:" . $atts['blog_width'] .";box-shadow: 2px 2px 5px #999;'>
				<div class='container-fluid'>";
		}else{
			$blogHTML="<div id='dummy-blog-container'  style='background-color:" . $atts['b_color'] . ";" . $atts['css'] . ";width:" . $atts['blog_width'] .";'>
				<div class='container-fluid'>";
		}
		//Show title of Blog
		if($atts['show_blog_title'] == "Yes"){
			$blogHTML.="<div class='row heading'>
						<div class='col-md-12'>
							<".$atts['blog_title_html']." style='text-align:" . $atts['blog_title_alignment'] . ";'><a style='color:" . $atts['blog_title_color' ] . ";font-size:" . $atts['blog_title_font_size'] . "' href='/blog'>" . $atts['blog_title'] . "</a></".$atts['blog_title_html'].">
						</div>
					</div>";
		}
		//We're not showing featured images
		if($atts['featured_image'] == "No"){
			$blogHTML.="<div class='row inner'>
						<div class='col-md-12'>";
		}
				
	
		// Start looping over the query results.
		while ( $query->have_posts() ) {
			$query->the_post();
			
			
			//no read more functionality
			if($atts['read_more'] == "No"){
				$atts['read_more_text'] = " ";		
			}
				
			if($atts['pagination']=='Yes'){
				if($postNum > $postsPerPage){
					$postsPerPage+=$postsPerPage/$onPage;
					$onPage++;					
				}

				//Add data- hooks to html for js	
				$blogHTML.="<div class='dummy-post' data-post= " . $postNum . " data-page=" . $onPage . ">";
				$postNum++;
			}else{
				$blogHTML.="<div class='dummy-post'>";
			}
			//this is if the user wants featured images displayed
			if($atts['featured_image'] == "Yes"){
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
				//default featured image code
				if ($atts['default_featured_image']==''){
					$atts['default_featured_image']="/wp-content/plugins/plm-post-shortcode/public/images/default-placeholder-300x300.png";
				}
				
				$blogHTML.="<div class='row inner'>
							<div class='col-md-" . $atts['blog_post_column_size'][0] . "'>
								<div class='featured-image-container'>
									<a href='" . get_permalink() . "'><img onerror='defaultImage(this);' src='". esc_url($featured_img_url) ."' style='width:" . $imageWidth . "px;height:" . $imageHeight . "px;'/></a>
								</div>
							</div>
							<script>function defaultImage(img){img.src='" . $atts['default_featured_image'] . "'}</script>
							<div class='col-md-" . $atts['blog_post_column_size'][1] . "'>";	
			}
			//post link
			$blogHTML.="<a href='" . get_permalink() . "'>";
			//Display Date position according to user selection
			if($atts['date_position']=="Before Post Title"){
				$blogHTML.="
							<div style='color:" . $atts['date_color' ] . ";font-size:". $atts['date_font_size' ] .";' class='date'>" . $atts['before_date_text' ] . get_the_date() . "</div>
							<div style='color:" . $atts['post_color' ] . ";margin-bottom:15px;font-size:". $atts['post_title_font_size' ] .";' class='snippet'>" . get_the_title() . "</div>
					</a>";
			}else{
				$blogHTML.="
							<div style='color:" . $atts['post_color'] . ";font-size:". $atts['post_title_font_size' ] .";' class='snippet'>" . get_the_title() . "</div>
							<div style='color:" . $atts['date_color' ] . ";font-size:". $atts['date_font_size' ] .";margin-bottom:15px;' class='date'>" . $atts['before_date_text']  . get_the_date() . "</div>
					</a>";
			}
			//we're showing the post content
			if ($atts['show_post_content'] == "Yes"){
				$blogHTML.=
						"<div style='color:" . $atts['post_content_color'] . ";font-size:". $atts['post_content_font_size' ] .";' class='post-content'>" . get_the_content() . "<a class='full-post' href='". get_permalink() ."'>" . $atts['read_more_text'] . "</a></div>
				</div>";
			//we're showing the excerpt instead
			}else if ($atts['show_excerpt'] == "Yes"){
				
				$blogHTML.=
						"<div style='color:" . $atts['excerpt_color'] . ";font-size:". $atts['excerpt_font_size' ] .";' class='post-content'>" . excerpt($atts['excerpt_length'],$atts['excerpt_end_chars']) . "<a class='full-post' href='". get_permalink() ."'>" . $atts['read_more_text'] . "</a></div>
				</div>";
			}else{
				$blogHTML.="</div>";
			}
			//Ending HTML for featured image
			if($atts['featured_image'] == "Yes"){
				$blogHTML.="</div></div>";
			}
			
		}
		
		// Restore original post data.
		wp_reset_postdata();
		//wp_reset_query();
		
		//based on featured image code
		if($atts['featured_image'] == "Yes"){
			$blogHTML.="	
					</div>
				</div>
			";
		}else{
			$blogHTML.="	
						</div>
					</div>
				</div>
			</div>
			";
		}
		
		if($atts['pagination']=='Yes'){
			//This is for numbered page functionality
			if($atts['pagination_style']=='Numbered'){
				$blogHTML.='<div class="pagination numbered" data-onpage="1">
								<div class="page-prev">&lt;&lt;</div>
									<ul class="pages">
										<li class="currentItem" data-item="1">1</li>
									</ul>
									<script>
										for(var i=2; i<=' . $onPage . ';i++){
											$("<li data-item=" + i + ">" + i + "</li>").appendTo(".pagination.numbered .pages")
										}
									</script>
									
								<div class="page-next">&gt;&gt;</div>
							</div>
							<script type="text/javascript">
								$=jQuery.noConflict();
								$(document).ready(
									function(){
										$(".pagination.numbered .pages li").click(
											function(){
												var onPage=$(this).attr("data-item");
												var lastPage=$("ul.pages li:last-child").text();
												
												$(".pagination").attr("data-onpage", onPage);
												$("[data-page]").removeClass("currentPage").slideUp("fast");
												$("[data-page" + "=" + onPage + "]").addClass("currentPage").slideDown("fast");
												
												if(onPage > 1){
													$(".page-prev").css("display","inline-block");
												}else{
													$(".page-prev").css("display","none");
												}
													
												if(onPage == lastPage){
													$(".page-next").css("display","none");
												}else{
													$(".page-next").css("display","inline-block");
												}
												
												//numerical code
												$(".pages li").removeClass("currentItem");
												$("[data-item=" + onPage + "]").addClass("currentItem");
											}
										);
									}
								);
							</script>
							';	
			}else{
				//This is for 'Prev Next Page functionality'
				$blogHTML.='<div class="pagination" data-onpage="1"><div class="page-prev">Previous Page</div><div class="page-next">Next Page</div></div>';
			}
					$blogHTML.='<script type="text/javascript">
								$=jQuery.noConflict();
    							$(document).ready(
									function(){
										var minHeight=$("div#dummy-blog-container").height() + "px";
										
										$("div#dummy-blog-container").css("min-height",minHeight).css("min-height",minHeight);
									
										$("[data-page = 1]").addClass("currentPage");
										
										var lastPage;
										//Hide Next Button if only 1 page
										$(".dummy-post").each(
											function(){
												
												if(parseInt($(this).attr("data-page"))>=2){
													$(".page-next").css("display","inline-block");
												}else{
													$(".page-next").css("display","none");
												}
												
												lastPage=$(this).attr("data-page");
											}
										);
										//Handles pagination click
										$(".pagination > div").click(
											function(){
												var onPage=$(".pagination").attr("data-onpage");
												var selector;
												if($(this).hasClass("page-next")){
													$(".pagination").attr("data-onpage", ++onPage);
													$("[data-page]").removeClass("currentPage").slideUp("fast");
													$("[data-page" + "=" + onPage + "]").addClass("currentPage").slideDown("fast");
													//hide prev button on first page
													if(onPage > 1){
														$(".page-prev").css("display","inline-block");
													}else{
														$(".page-prev").css("display","none");
													}
													//Hide next button if on last page
													if(onPage == lastPage){
														$(".page-next").css("display","none");
													}else{
														$(".page-next").css("display","inline-block");
													}
												}else{
													$(".pagination").attr("data-onpage", --onPage);
													$("[data-page]").removeClass("currentPage").slideUp("fast");
													$("[data-page" + "=" + onPage + "]").addClass("currentPage").slideDown("fast");
													//hide prev button on first page
													if(onPage > 1){
														$(".page-prev").css("display","inline-block");
													}else{
														$(".page-prev").css("display","none");
													}
													//Hide next button if on last page
													if(onPage == lastPage){
														$(".page-next").css("display","none");
													}else{
														$(".page-next").css("display","inline-block");
													}
												}
												
												//numerical code
												$(".pages li").removeClass("currentItem");
												$("[data-item=" + onPage + "]").addClass("currentItem");
											}
										);
									}
								);
							</script>';
			;
		}
		//This is for the load more posts button
		if($atts['load_more_posts']=='Yes'){
				$currentElems=array();
			//create array for current elements
			for($index=0;$index < $atts['load_more_posts_number']; $index++){
				$currentElems[$index]=$atts['load_more_posts_number'] + $index;
			}

			$atts['load_more_posts_number']++;
		
			
			$blogHTML.='<div class="load-more">LOAD MORE POSTS</div>
							<script type="text/javascript">
								$=jQuery.noConflict();
								var currentElems=['.implode(",",$currentElems).'];
    							$(document).ready(
									function(){
										var firstPress=true;
										//only show posts from first set of posts
										$(".dummy-post:nth-child(n+'. $atts['load_more_posts_number'] .')").slideUp();
										$(".load-more").click(
											function(){
												for(var i=0; i < currentElems.length; i++){
													var currentElement=currentElems[i];
													if(firstPress){currentElement+=1;currentElems[i]+=1}
													
													$(".dummy-post:nth-child("+ currentElement +")").slideDown();
													//console.log('. $numPages .');
													currentElems[i]=currentElems[i] + currentElems.length;   
												}
												firstPress=false;

											}
										);
									}
								);
							</script>';
		}
		return $blogHTML;
		
	
	}else{
		return "No Posts to Show";
    }
	
	
		
}
	/*Modified function - original found here: https://stackoverflow.com/questions/4082662/multiple-excerpt-lengths-in-wordpress*/
	function excerpt($limit, $chars) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt) . $chars;
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
    }

//adds shortcode to Wordpress	
add_shortcode( 'plm_blog', 'plm_post_shortcode' );

?>