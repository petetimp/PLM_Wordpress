</div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer container-fluid">
	<?php if(is_front_page()){ ?>
	<div class="row">
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
	<?php } ?> 
	<div class="row">
		<div class="copyright col-md-12"><?php if ( is_active_sidebar( 'footer_copyright_text' ) ) { dynamic_sidebar( 'footer_copyright_text' ); } ?></div>
	</div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript" src="//cdn.callrail.com/companies/489803697/324645a4de30b87b7600/12/swap.js"></script>
</body>
</html>