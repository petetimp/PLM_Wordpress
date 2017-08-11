jQuery(document).ajaxSuccess(
	function(){
		if(jQuery("select.show_post_content").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='post-content hidden']").show();
		}
		
		if(jQuery("select.show_blog_title").attr("data-option")== "Yes"){
			jQuery("[data-param_settings*='blog-title hidden']").show();
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
		

	}
);