</div><!-- /.row -->

</div><!-- /.container -->
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="modalTitle">CONTACT US</h3>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<footer class="blog-footer container-fluid">
	<div class="row content">
			<?php if ( (is_active_sidebar( 'footer-2' ) || has_nav_menu( 'footer-menu-2' ) ) && (!is_active_sidebar( 'footer-3' ) && !has_nav_menu( 'footer-menu-3' )) ) { ?>
				<div class="col-md-6">
					<?php
						if ( has_nav_menu( 'footer-menu-1' ) ) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'footer-menu-1', 
									'menu_class' => 'blog-footer-inner list-inline' 
								) 
							);
						}else{
							dynamic_sidebar( 'footer-1' );
						} 
					?> 
				</div>
				<div class="col-md-6">
					<?php
						if ( has_nav_menu( 'footer-menu-2' ) ) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'footer-menu-2', 
									'menu_class' => 'blog-footer-inner list-inline' 
								) 
							);
						}else{
							dynamic_sidebar( 'footer-2' );
						}
					?>
				</div>
			<?php }else if ( (is_active_sidebar( 'footer-2' ) || has_nav_menu( 'footer-menu-2' ) ) && (is_active_sidebar( 'footer-3' ) || has_nav_menu( 'footer-menu-3' )) && (!is_active_sidebar('footer-4'))) { ?>
				<div class="col-md-4">	
					<?php
						if ( has_nav_menu( 'footer-menu-1' ) ) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'footer-menu-1', 
									'menu_class' => 'blog-footer-inner list-inline' 
								) 
							);
						}else{
							dynamic_sidebar( 'footer-1' );
						} 
					?> 
				</div>
				<div class="col-md-4">
					<?php
						if ( has_nav_menu( 'footer-menu-2' ) ) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'footer-menu-2', 
									'menu_class' => 'blog-footer-inner list-inline' 
								) 
							);
						}else{
							dynamic_sidebar( 'footer-2' );
						}
					?>
				</div>
				<div class="col-md-4">
					<?php
						if ( has_nav_menu( 'footer-menu-3' ) ) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'footer-menu-3', 
									'menu_class' => 'blog-footer-inner list-inline' 
								) 
							);
						}else{
							dynamic_sidebar( 'footer-3' );
						}
					?>
				</div>
			<?php 
				}else if(is_active_sidebar( 'footer-4' )){
			?>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<?php
							if ( has_nav_menu( 'footer-menu-1' ) ) {
								wp_nav_menu( 
									array( 
										'theme_location' => 'footer-menu-1', 
										'menu_class' => 'blog-footer-inner list-inline' 
									) 
								);
							}else{
								dynamic_sidebar( 'footer-1' );
							} 
						?> 
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<?php
							if ( has_nav_menu( 'footer-menu-2' ) ) {
								wp_nav_menu( 
									array( 
										'theme_location' => 'footer-menu-2', 
										'menu_class' => 'blog-footer-inner list-inline' 
									) 
								);
							}else{
								dynamic_sidebar( 'footer-2' );
							}
						?>
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<?php
							if ( has_nav_menu( 'footer-menu-3' ) ) {
								wp_nav_menu( 
									array( 
										'theme_location' => 'footer-menu-3', 
										'menu_class' => 'blog-footer-inner list-inline' 
									) 
								);
							}else{
								dynamic_sidebar( 'footer-3' );
							}
						?>
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<?php	
							dynamic_sidebar( 'footer-4' );
						?>
					</div>
			<?php
				}else{ 
			?>
				<div class="col-md-6">
					<?php
						if ( has_nav_menu( 'footer-menu-1' ) ) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'footer-menu-1', 
									'menu_class' => 'blog-footer-inner list-inline' 
								) 
							);
						}else{
							dynamic_sidebar( 'footer-1' );
						} 
					?> 
				</div>
				<div class="col-md-6"></div>
			<?php } ?>
	</div>
	<div class="row">
		<div class="copyright col-md-12"><?php if ( is_active_sidebar( 'footer_copyright_text' ) ) { dynamic_sidebar( 'footer_copyright_text' ); } ?></div>
	</div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript" src="//cdn.callrail.com/companies/489803697/324645a4de30b87b7600/12/swap.js"></script>
<script>
(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // http://getbootstrap.com/javascript/#carousel
  jQuery('#carouselABC').carousel({ interval: false, duration: 100 });
}());

(function(){
  jQuery('.carousel-showmanymoveone .item').each(function(){
    var itemToClone = jQuery(this);

    for (var i=1;i<6;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = jQuery(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo(jQuery(this));
    }
  });
}());
</script>
</div>
<!--Wrapper-->
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 837007268;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/837007268/?guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>