<?php
	/*
	Plugin Name: PLM Dropdown Archive
	Plugin URI:  https://premierlegalmarketing.com
	Description: Blog/Post Type shortcode with several options
	Version:     20170806
	Author:      premierlegalmarketing.com
	Author URI:  https://premierlegalmarketing.com
	License:     GPL2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: plmorg
	Domain Path: /languages

	PLM Dropdown Archive is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.

	PLM Post Shortcode is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with PLM Dropdown Archive If not, see https://www.gnu.org/licenses/gpl-2.0.html.
	*/

	function plm_dropdown_archives_flush(){
    	// clear the permalinks after the post type has been registered
    	flush_rewrite_rules();
	}

	register_activation_hook( __FILE__, 'plm_dropdown_archives_flush' );
	register_deactivation_hook( __FILE__, 'plm_dropdown_archives_flush' );

	function plm_dropdown_archives( $atts){
		global $wpdb;

		$atts = shortcode_atts(
			array(
				'post_type' => get_post_type()
			), $atts, 'plm_dropdown_archive' 
		);

		$post_type=$atts["post_type"];

        $months = $wpdb->get_results(   "SELECT DISTINCT MONTH( post_date ) AS month ,
                                        YEAR( post_date ) AS year,
                                        COUNT( id ) as post_count FROM $wpdb->posts
                                        WHERE post_status = 'publish' and post_date <= NOW()
                                        and post_type = '$post_type'
                                        GROUP BY month , year
                                        ORDER BY post_date DESC");
		
  		if (is_ssl()) {
    		$protocol="https://";
  		}else{
			$protocol="http://";	
		}

		$archiveHTML.=
			"<select id='post-type-select' onchange='document.location.href=this.options[this.selectedIndex].value;'>
				<option>Select Month</option>";
		foreach($months as $month){
			$archiveHTML.=
				"<option value=" . $protocol . $_SERVER['HTTP_HOST'] . "/" . $month->year . "/" . date('m', mktime(0, 0, 0, $month->month, 1, $month->year)) . "/" . "?post_type=" . $post_type . ">" .
					date('F', mktime(0, 0, 0, $month->month, 10)) . " " . $month->year	
			  . "</option>";
		}
		
		$archiveHTML.="</select>";
		
		return $archiveHTML;
	}

	add_shortcode( 'plm_dropdown_archive', 'plm_dropdown_archives' );
?>		