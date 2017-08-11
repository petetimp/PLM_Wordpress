<script>
//Submenu Code

				jQuery(document).ready(
					function($){
						
						jQuery("#searchsubmit").hover(
							function(){
								 jQuery(".blog-masthead #s").css("visibility","visible").css("width","250px").css("background-color","white"); 
							}
							,function(){
								if(!jQuery(".blog-masthead #s").is(":focus")){
									 jQuery(".blog-masthead #s").css("visibility", "visibile");
								}
							} 
						);

						jQuery(".blog-masthead #s").blur(
							function(){
								jQuery(".blog-masthead #s").css("visibility", "hidden");
							}
						);

						
						if(innerWidth < 768){
							$(".menu-item-has-children").append("<span class='mobile-dropdown'>+</span>");
						}
						
						jQuery(window).resize(
                            function(){
                                if(innerWidth > 767){
                                    jQuery(".blog-nav").slideDown();
                                }else{
                                    jQuery(".blog-nav").slideUp();
                                }
                            }
                        );
						
						jQuery('.mobile-menu').click(
                            function(){
                                jQuery(".blog-nav").slideToggle();
                            }
                        );
						
						$(window).resize(
							function(){
									if(innerWidth > 767){
										$(".mobile-dropdown").remove();
									}else{ 
										if(!$("span").hasClass("mobile-dropdown")){
											$(".menu-item-has-children").append("<span class='mobile-dropdown'>+</span>");
										}
										
										if($(".sub-menu .sub-menu")){
											$(".sub-menu .sub-menu + .mobile-dropdown").addClass("inner");
										}
									}
							}
						);
						
						if($(".sub-menu .sub-menu")){
							$(".sub-menu .sub-menu + .mobile-dropdown").addClass("inner");
						}
						
						
						$(document).on("click", ".mobile-dropdown",
							function(){
								if($(this).text()=="+"){
									$(this).text("-");
									$(this).parents("li").children(".sub-menu").slideDown();
									$(this).addClass("minus");  
								}else{
									$(this).text("+");
									
									if($(this).hasClass("inner")){
										$(this).parents("li").children(".sub-menu .sub-menu").slideUp();	
									}else{
										$(this).parents("li").children(".sub-menu").slideUp();
									}
									
									$(this).removeClass("minus");
								}
							}
						);
						
						
						$(".back-to-top a").click(
							function(){
								$("#top").velocity('scroll',
									{
										duration: 1000,
										easing: 'ease-in-out'
									}
								);
							}
						);
						
					
						
						$(".menu-item").hover(
							function(){
								if(innerWidth > 767){
									$(this).children(".sub-menu").show("fast");
								}
							},
							function(){
								if(innerWidth > 767){
									$(this).children(".sub-menu").hide("fast");
								}
							}
						);
					}
				);
	
			<?php if(!is_single() && !is_archive()){ ?>	
			//Reposition sidebar script
				jQuery(window).load(
					function(){
						setTimeout(
							function(){
								if(innerWidth > 767){
								<?php if(is_front_page()){ ?>
									var paddingTop=parseInt(jQuery(".tp-bgimg").height()) + 20 + "px";
								<?php }else{ ?>
									var paddingTop=parseInt(jQuery("div#banner-img img").height()) + 20 + "px";
								<?php } ?>
									jQuery(".blog-sidebar").css(
										{
											"padding-top" : paddingTop,
											"visibility" : "visible"
										}
									);
								}else{
									jQuery(".blog-sidebar").css(
										{
											"padding-top" : "20px",
											"visibility" : "visible"
										}
									);
								}
							},500
						);
					}
				);

				jQuery(window).resize(
					function(){
						setTimeout(
							function() {    
								if(innerWidth > 767){
								<?php if(is_front_page()){ ?>
									var paddingTop=parseInt(jQuery(".tp-bgimg").height()) + 20 + "px";
								<?php }else{ ?>
									var paddingTop=parseInt(jQuery("div#banner-img img").height()) + 20 + "px";
								<?php } ?>
									jQuery(".blog-sidebar").css(
										{
											"padding-top" : paddingTop,
											"visibility" : "visible"
										}
									);
								}else{
									jQuery(".blog-sidebar").css(
										{
											"padding-top" : "20px",
											"visibility" : "visible"
										}
									);
								}
							},150
						);
					}
				);
			<?php } ?>
</script>