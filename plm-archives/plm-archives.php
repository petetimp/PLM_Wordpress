<?php
/*
Plugin Name: PLM Archives
Plugin URI:  https://premierlegalmarketing.com
Description: Simple Wordpress Archives Plugin with on-page pagination
Version:     20170728
Author:      premierlegalmarketing.com
Author URI:  https://premierlegalmarketing.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: plmorg
Domain Path: /languages

PLM Archives is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
PLM Archives is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with PLM  Archives. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


function plm_archives_enqueue_styles() {
    wp_register_style('plm-archives-front', '/wp-content/plugins/plm-archives/public/css/front.css' );
	wp_enqueue_style('PLM Archives', '/wp-content/plugins/plm-archives/public/css/front.css'); 
}

global $wp_query;

function plm_archives_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('plm-archives-front-js', '/wp-content/plugins/plm-archives/public/js/front.js', $dependencies, '', true );
}

add_action( 'wp_enqueue_scripts', 'plm_archives_enqueue_scripts' );

add_action( 'wp_enqueue_scripts', 'plm_archives_enqueue_styles' );


add_action( 'vc_before_init', 'plm_archives_integrateWithVC' );



function plm_archives_integrateWithVC() {
	   
   vc_map( 
	   array(
		   "name" => __( "PLM  Archives", "plmorg" ),
		   "base" => "plm_archives",
		   "class" => "plm-archives",
		   'admin_enqueue_css' => array('/wp-content/plugins/plm-archives/admin/vc-extend/plm-archives-admin.css'),
		   'admin_enqueue_js' => array('/wp-content/plugins/plm-archives/admin/vc-extend/plm-archives-admin.js'),
		   "category" => __( "Content", "plmorg"),
		   "params" => 
	   		  array(
				 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Number of posts", "plmorg" ),
					"param_name" => "number",
					"value" => __( array("1","2","3","4","5","6","7","8","9","10","-1"), "plmorg" ),
					"description" => __( "Please Select Number of Posts Per Page (-1 means all)", "plmorg" )
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
					"heading" => __( "Post Order", "plmorg" ),
					"param_name" => "post_order",
					"value" => __(array("DESC","ASC")),
					"description" => __( "Please Choose Order of Posts", "plmorg" )
				 ),				
	   			 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Archive Width", "plmorg" ),
					"param_name" => "archive_width",
					"value" => __( "100%", "plmorg" ),
					"description" => __( "Please Specify Width of Archive (Any CSS unit accepted)", "plmorg" )
				 ),
	   			 array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Background Color", "plmorg" ),
					"param_name" => "b_color",
					"value" => 'transparent',
					"description" => __( "Choose Background Color for Widget", "plmorg" )
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
					"type" => "dropdown",
					"class" => "post-content hidden",
					"heading" => __( "Include Expand Functionality?", "plmorg" ),
					"param_name" => "content_expand",
					"value" => __( array("Yes","No"), "plmorg" ),
					"description" => __( "Expand Single Post Content on Headline Click", "plmorg" )
				 ),
				 array(
					"type" => "colorpicker",
					"class" => "post-content hidden",
					"heading" => __( "Post Content Color", "plmorg" ),
					"param_name" => "post_content_color",
					"value" => '#000000',
					"description" => __( "Choose Post Content Font Color", "plmorg" )
				 ),
				 array(
					"type" => "textfield",
					"class" => "post-content hidden",
					"heading" => __( "Post Content Font Size", "plmorg" ),
					"param_name" => "post_content_font_size",
					"value" => '16px',
					"description" => __( "Choose Post Content Font Size", "plmorg" )
				 ),
	   			 array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Post Title Color", "plmorg" ),
					"param_name" => "post_title_color",
					"value" => '#000000',
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
					"heading" => __( "Date Font Size", "plmorg" ),
					"param_name" => "date_font_size",
					"value" => __( "14px", "plmorg" ),
					"description" => __( "Please Input Font Size for Post Date", "plmorg" )
				 ),
	   			 array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Before Date Text", "plmorg" ),
					"param_name" => "before_date_text",
					"value" => __( "Posted On", "plmorg" ),
					"description" => __( "Text to Go Before Post Date (Default is 'Posted On')", "plmorg" )
				 ),
				 array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __( "Date Position", "plmorg" ),
					"param_name" => "date_position",
					"value" => __( array("Before Post Title", "After Post Title"), "plmorg" ),
					"description" => __( "Place Date Before or After Post Title", "plmorg" )
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

add_filter( 'vc_grid_item_shortcodes', 'plm_archives_add_grid_shortcodes' );

function plm_archives_add_grid_shortcodes( $shortcodes ) {
   $shortcodes['plm_archives'] = array(
     'name' => __( 'PLM Archives', 'plmorg' ),
     'base' => 'plm_archives',
     'category' => __( 'Content', 'plmorg' ),
     'description' => __( 'PLM Specific Achive Plugin.', 'plmorg' ),
     'post_type' => Vc_Grid_Item_Editor::postType(),
  );
   return $shortcodes;
}

function plm_archives_flush(){
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'plm_archives_flush' );
register_deactivation_hook( __FILE__, 'plm_archives_flush' );


function plm_archive( $atts, $content = null){
	global $post;

	$css = '';

	$atts = shortcode_atts(
		array(
			'number' => '-1',
			'post_type' => 'post',
			'post_order' => 'DESC',
			'archive_width' => '100%',
			'order_by' => 'date',
			'b_color' => 'transparent',
			'show_post_content' => 'Yes',
			'content_expand' => 'Yes',
		    "post_content_color" => "#000000",
			"post_content_font_size" => "16px",
			"post_title_color" => "#000000",
			"post_title_font_size" => "16px",
		    "date_color" => "#000000",
			"date_font_size" => "14px",
			"before_date_text"=> "Posted On",
			"date_position" => "Before Post Title",
			'css' => ''
		), $atts, 'plm_archives' 
	);

	//parse out inline style
	$leftBracket=stripos($atts['css'],"{");
	$atts['css']=substr($atts['css'],$leftBracket + 1);
	$atts['css']=rtrim($atts['css'],"}");
	
	
	
	
	$archive_args = array(
	'type'            => 'yearly',
	'limit'           => '',
	'format'          => 'html', 
	'before'          => '<span class="archive-year">',
	'after'           => ' </span>',
	'show_post_count' => false,
	'echo'            => 0,
	'order'           => $atts['post_order'],
    'post_type'     => $atts['post_type']
	);
	
	$archive = wp_get_archives( $archive_args );
	$archive= '<ul class="archive-years">' . $archive . '</ul>';
	
	$args = array(
		// Arguments for your query.
		'post_type' => $atts['post_type'],
		'orderby' => $atts['order_by'],
		'order' => $atts['post_order'],
		'posts_per_page' => -1
	);
	
	$query = new WP_Query( $args );
	
	
	$blogHTML.= "<div class='plm-archive-widget row content' style='background-color:" . $atts['b_color'] . ";" . $atts['css'] . ";width:" . $atts['archive_width']."'>";
	$blogHTML.="<div class='col-xs-12'>" . $archive . "</div></div><div class=' plm-archive-widget row content'><div class='col-xs-12'>";
	
	$count=0;
	$the_page=1;
	$post_year=date('Y');
	$page_increment=false;
	
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$count++;
			$query->the_post();
			
			//parse out single post year
			$the_date=get_the_date();			
			$the_year = substr($the_date,-4);
			
			if($atts['number']==$count && $the_year == $post_year){
				$page_increment=true;
			}
			
			 if($the_year !== $post_year){
				 $count=1;
				 $the_page=1;
			 }
			
			
			
			
			
			$blogHTML.= "<article class='blog-post' data-count='" . $count . "' data-number='" . $atts['number'] . "' data-year='" .  $the_year . "' data-page='" . $the_page . "'>";
			if($atts['date_position']=='Before Post Title'){
				$blogHTML.= "<div class='post-date' style='color:" . $atts['date_color'] . ";font-size:". $atts['date_font_size'] ."'><span class='before-date-text'> " . $atts['before_date_text'] . "</span> " . get_the_date() . "</div>";
			}
			if($atts['content_expand']=='Yes' && $atts['show_post_content'] == 'Yes'){
				$blogHTML.="<h2 class='expandable' style='color:" . $atts['post_title_color'] . ";font-size:" . $atts['post_title_font_size'] . ";cursor:pointer;'>" . strip_tags(get_the_title()) . "</h2>";	
			}else{
				$blogHTML.="<h2 style='color:" . $atts['post_title_color'] . ";font-size:" . $atts['post_title_font_size'] . ";'>" . strip_tags(get_the_title()) . "</h2>";		
			}
			
			if($atts['date_position']=='After Post Title'){
				$blogHTML.= "<div class='post-date' style='color:" . $atts['date_color'] . ";font-size:". $atts['date_font_size'] ."'><span class='before-date-text'> " . $atts['before_date_text'] . "</span> " . get_the_date() . "</div>";
			}
			
			if($atts['show_post_content'] == 'Yes'){
				$blogHTML.="<div class='post-content'>" . get_the_content() . "</div>";	
			}
			
			if($page_increment){
				$the_page++;
				$count=0;
				$page_increment=false;
			}
			
			if($the_year !== $post_year){
				$post_year=$the_year;	
			}
			
			$blogHTML.="<hr></article>";
			
		}
		
			$blogHTML.="</div></div>";
			
		$blogHTML.="<div class='col-xs-12 content no-float'><div class='pagination-container' data-onpage='1'><div class='pagination prev'> &larr; Older Posts</div><div class='pagination next'>Newer Posts &rarr;</div></div></div>";
	
		// Restore original post data.
		wp_reset_postdata();			
		
		return $blogHTML;	
	}else{
		return "No Posts to Show";
    }
		
}	
	
add_shortcode( 'plm_archives', 'plm_archive' );