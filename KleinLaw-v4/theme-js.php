<script>
				//Submenu Code
				$=jQuery.noConflict();

				$(document).ready(
					function($){

						//Practice area sidebar script
						$("#practice-area-sidebar > ul > li").click(
							function(){
								var childContent=$(this).children(".children-content");
								if( childContent.css("display")=="none"){
									$(this).children(".handle").text("-");
									childContent.slideDown();
								}else{
									$(this).children(".handle").text("+");
									childContent.slideUp();
								}   
							}
						);


						$("#practice-area-sidebar .handle").click(
							function(e){
								e.stopPropagation();
								var childContent=$(this).next(".children-content");
								if( childContent.css("display")=="none"){
									$(this).text("-");
									childContent.slideDown();
								}else{
									$(this).text("+");
									childContent.slideUp();
								}   
							}
						);
						
						$("#searchsubmit").hover(
							function(){
								 $(".blog-masthead #s").css("visibility","visible").css("width","250px").css("background-color","white"); 
							}
							,function(){
								if(!$(".blog-masthead #s").is(":focus")){
									 $(".blog-masthead #s").css("visibility", "visibile");
								}
							} 
						);

						$(".blog-masthead #s").blur(
							function(){
								$(".blog-masthead #s").css("visibility", "hidden");
							}
						);

						
						if(innerWidth < 768){
							$(".menu-item-has-children").append("<span class='mobile-dropdown'>+</span>");
						}
						
						$(window).resize(
                            function(){
                                if(innerWidth > 767){
                                    $(".blog-nav").slideDown();
                                }else{
                                    $(".blog-nav").slideUp();
                                }
                            }
                        );
						
						$('.mobile-menu').click(
                            function(){
                                $(".blog-nav").slideToggle();
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

						$(".menu-item-has-children > a").hover(
							function(){
								$(this).children("i").css("visibility","hidden");		
							},
							function(){
								$(this).children("i").css("visibility","visible");		
							}
						);

						//For search result pages

						$('.blog-main #searchsubmit').val('Submit');

						//For Main Blog Pages 
						<?php if(is_page(20)){ ?>
								$('#Klein #dummy-blog-container .date').each(
									function(){
										$(this).insertAfter($(this).parents(".dummy-post").find(".post-content"));
									}
								);

								$("#Klein .snippet").each(
									function(){
										$(this).prependTo($(this).parents(".dummy-post").find(".row.inner"));	
									}
								);

						<?php } ?>

						plmSlider.init(
							{	
								runSlides: 8000,
								forwardAnimation: "fadeInLeft",
								backwardAnimation: "fadeInRight"
							}

						);
						
					}
				);
</script>
