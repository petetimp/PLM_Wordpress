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

function plm_blog_enqueue_styles() {
    wp_register_style('plm-blog-font-css', '/wp-content/plugins/plm-post-shortcode/public/css/front.css' );
	wp_enqueue_style('PLM Blog Css', '/wp-content/plugins/plm-post-shortcode/public/css/front.css'); 
}

add_action( 'wp_enqueue_scripts', 'plm_blog_enqueue_styles' );

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


add_action( 'vc_before_init', 'plm_blog_integrateWithVC' );

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
					"value" => "",
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
					"value" => __( array("Yes","No"), "plmorg" ),
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
					"value" => __( "Read More >>", "plmorg" ),
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
					"value" => __( "...", "plmorg" ),
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

class WPBakeryShortCode_plm_blog extends WPBakeryShortCode {
}

add_filter( 'vc_grid_item_shortcodes', 'plm_blog_add_grid_shortcodes' );

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

function plm_post_shortcode_flush(){
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'plm_post_shortcode_flush' );
register_deactivation_hook( __FILE__, 'plm_post_shortcode_flush' );


function plm_post_shortcode( $atts, $content = null){
	global $post;

	$css = '';

	$atts = shortcode_atts(
		array(
			'number' => '3',
			'blog_width' => '300px',
			'blog_shadow' => '',
			'show_blog_title' => 'Yes',
			'blog_title' => 'RECENT POSTS',
			'blog_title_html'=> 'h3',
			'blog_title_alignment' => 'center',
			'post_type' => 'post',
			'show_post_content' => 'No',
			'post_content_color' => "#ffffff",
			'post_content_font_size'=>"13px",
			'category_name' => '',
			'exclude_categories' => '999',
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
			"read_more_text" => "Read More >>",
			'css' => ''
		), $atts, 'plm_blog' 
	);

	//parse out inline style
	$leftBracket=stripos($atts['css'],"{");
	$atts['css']=substr($atts['css'],$leftBracket + 1);
	$atts['css']=rtrim($atts['css'],"}");
	
	
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
		
		if($atts['blog_shadow']=="true"){
			$blogHTML="<div id='dummy-blog-container'  style='background-color:" . $atts['b_color'] . ";" . $atts['css'] . ";width:" . $atts['blog_width'] .";box-shadow: 2px 2px 5px #999;'>
				<div class='container-fluid'>";
		}else{
			$blogHTML="<div id='dummy-blog-container'  style='background-color:" . $atts['b_color'] . ";" . $atts['css'] . ";width:" . $atts['blog_width'] .";'>
				<div class='container-fluid'>";
		}
		
				if($atts['show_blog_title'] == "Yes"){
					$blogHTML.="<div class='row heading'>
						<div class='col-md-12'>
							<".$atts['blog_title_html']." style='text-align:" . $atts['blog_title_alignment'] . ";'><a style='color:" . $atts['blog_title_color' ] . ";font-size:" . $atts['blog_title_font_size'] . "' href='/blog'>" . $atts['blog_title'] . "</a></".$atts['blog_title_html'].">
						</div>
					</div>";
				}
					$blogHTML.="<div class='row inner'>
						<div class='col-md-12'>";
		
		// Start looping over the query results.
		while ( $query->have_posts() ) {
			$query->the_post();
			
			if($atts['read_more'] == "No"){
				$atts['read_more_text'] = " ";		
			}
		
			$blogHTML.="
				<div class='dummy-post'>
					<a href='" . get_permalink() . "'>";
			
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

			if ($atts['show_post_content'] == "Yes"){
				$blogHTML.=
						"<div style='color:" . $atts['post_content_color'] . ";font-size:". $atts['post_content_font_size' ] .";' class='post-content'>" . get_the_content() . "<a class='full-post' href='". get_permalink() ."'>" . $atts['read_more_text'] . "</a></div>
				</div>";
			}else if ($atts['show_excerpt'] == "Yes"){
				
				$blogHTML.=
						"<div style='color:" . $atts['excerpt_color'] . ";font-size:". $atts['excerpt_font_size' ] .";' class='post-content'>" . excerpt($atts['excerpt_length'],$atts['excerpt_end_chars']) . "<a class='full-post' href='". get_permalink() ."'>" . $atts['read_more_text'] . "</a></div>
				</div>";
			}else{
				$blogHTML.="</div>";
			}
		}
		
		// Restore original post data.
		wp_reset_postdata();
		//wp_reset_query();
		
		$blogHTML.="	
						</div>
					</div>
				</div>
			</div>
			";
		
		return $blogHTML;
		
	
	}else{
		return "No Posts to Show";
    }
	
	
		
}
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
	
add_shortcode( 'plm_blog', 'plm_post_shortcode' );

?>