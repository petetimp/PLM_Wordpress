jQuery(document).ready(
	function(){
		var numPages;
		var d = new Date();
		var currentYear = d.getFullYear();
		var selector='[data-year*=' + currentYear +']';
		
		jQuery(selector).show();
		jQuery("ul.archive-years li:first-child .archive-year").addClass("active");
		
		var pagination=jQuery(".pagination-container");
		
		numPages=calculatePagination(jQuery(selector));
		jQuery(".pagination-container").attr("data-pages",numPages).attr("data-year",currentYear).attr("data-onpage",'1');
		
		var onPage=pagination.attr("data-onpage");
		var pages=pagination.attr("data-pages");
		var year=pagination.attr("data-year");
		
		if(onPage==pages){
			jQuery(".pagination.prev").hide();
		}
		
		jQuery("h2.expandable").click(
			function(){
				if(jQuery(this).next(".post-content").css("display")=='none'){
					jQuery(this).next(".post-content").slideDown("fast");	
				}else{
					jQuery(this).next(".post-content").slideUp("fast");	
				}
			}
		);
		
		function calculatePagination(element){
			var max=1;
			jQuery(element).each(
				function(){
					if(jQuery(this).attr("data-page") > max){
						max = jQuery(this).attr("data-page");
					}
				}
			);
			return max;
		}
		
		jQuery(".pagination.prev").click(
			function(){
				var pagination=jQuery(this).parents('.pagination-container');
				
				var onPage=pagination.attr("data-onpage");
				var pages=pagination.attr("data-pages");
				var year=pagination.attr("data-year");
				
				onPage++;
				
				
				pagination.attr("data-onpage", onPage);
				
				if(onPage==pages){
					jQuery(".pagination.prev").hide();
				}
				
				if(onPage !== 1){
					jQuery(".pagination.next").show();
				}
				
				jQuery(".plm-archive-widget article.blog-post").slideUp("fast");
				jQuery(".plm-archive-widget article.blog-post[data-page='" + onPage + "'][data-year='" + year + "']").slideDown("fast");
				
				
			}
		);
		
		jQuery(".pagination.next").click(
			function(){
				var pagination=jQuery(this).parents('.pagination-container');
				
				var onPage=pagination.attr("data-onpage");
				var pages=pagination.attr("data-pages");
				var year=pagination.attr("data-year");
				
				onPage--;
				
				
				pagination.attr("data-onpage", onPage);
				
				if(onPage!==pages){
					jQuery(".pagination.prev").show();
				}
				
				if(onPage==1){
					jQuery(".pagination.next").hide();
				}else{
					jQuery(".pagination.next").show();	
				}
				
				jQuery(".plm-archive-widget article.blog-post").slideUp("fast");
				jQuery(".plm-archive-widget article.blog-post[data-page='" + onPage + "'][data-year='" + year + "']").slideDown("fast");
				
				
			}
		);
				
		
		jQuery("span.archive-year a").click(
			function(e){
				e.preventDefault();
				var year=jQuery(this).text();
				jQuery("[data-year]").slideUp('fast');
				jQuery('[data-year*=' + year +'][data-page=1]').slideDown('fast');
				
				jQuery("ul.archive-years li .archive-year").removeClass("active");
				jQuery("span.archive-year a").each(
					function(){
						if(jQuery(this).text()==year){
							jQuery(this).parents(".archive-year").addClass("active");
						}
					}
				);
				
				numPages=calculatePagination(jQuery("article.blog-post[data-year*='" + year + "']"));
				jQuery(".pagination-container").attr("data-pages",numPages).attr("data-year",year).attr("data-onpage",'1');

				if(numPages == 1){
					jQuery(".pagination.prev").hide();
				}else{
					jQuery(".pagination-container").show();
					jQuery(".pagination.prev").show();
				}
			}
		);		
	}
);