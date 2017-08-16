jQuery(document).ajaxSuccess(
	function(){
		if(jQuery("select.show_post_content").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='post-content hidden']").show();
		}
		
		if(jQuery("select.show_blog_title").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='blog-title hidden']").show();
		}
		
		if(jQuery("select.show_excerpt").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='excerpt hidden']").show();
		}
		
		if(jQuery("select.read_more").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='read-more hidden']").show();
		}
		
		if(jQuery("select.featured_image").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='featured-image hidden']").show();
		}
		
		//console.log("Ajax Success");
		jQuery(document).on('change',"select.show_post_content", 
			function() {
				if(this.value=="Yes"){
					jQuery("[data-param_settings*='post-content hidden']").slideDown();
				}else{
					jQuery("[data-param_settings*='post-content hidden']").slideUp();
				}
			}
		);
		
		jQuery(document).on('change',"select.show_blog_title", 
			function() {
				if(this.value=="Yes"){
					jQuery("[data-param_settings*='blog-title hidden']").slideDown();
				}else{
					jQuery("[data-param_settings*='blog-title hidden']").slideUp();
				}
			}
		);
		
		jQuery(document).on('change',"select.show_excerpt", 
			function() {
				if(this.value=="Yes"){
					jQuery("[data-param_settings*='excerpt hidden']").slideDown();
				}else{
					jQuery("[data-param_settings*='excerpt hidden']").slideUp();
				}
			}
		);
		
		jQuery(document).on('change',"select.read_more", 
			function() {
				if(this.value=="Yes"){
					jQuery("[data-param_settings*='read-more hidden']").slideDown();
				}else{
					jQuery("[data-param_settings*='read-more hidden']").slideUp();
				}
			}
		);
		
		jQuery(document).on('change',"select.featured_image", 
			function() {
				if(this.value=="Yes"){
					jQuery("[data-param_settings*='featured-image hidden']").slideDown();
				}else{
					jQuery("[data-param_settings*='feautred-image hidden']").slideUp();
				}
			}
		);

	}
);