<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body id="Jacobs" <?php body_class(); ?>>
<a id="top"></a>
<div class="blog-masthead">
    <div class="container-fluid">
		<div class="row">
			<div class="blog-header col-sm-4">
				
				<?php 
					if(get_theme_mod( 'custom_logo' )){
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				?>
					<a href="/"><img src=<?php echo $image[0];?> alt="logo" /></a>
				<?php						
					}else{
				?>
						<h1 class="blog-title"><?php bloginfo( 'name' ); ?></h1>
						<?php $description = get_bloginfo( 'description', 'display' ); ?>
						<?php if($description) { ?><p class="lead blog-description"><?php echo $description ?></p><?php } ?>
			    <?php 
					} 
				?>
			</div>
			<div class="mobile-menu button mobile-xs">MENU</div>
			<div class="col-sm-8">
				<?php 
					get_search_form();
					if (is_active_sidebar( 'header-contact' )){
						dynamic_sidebar('header-contact');	
					} 
				?>
				<?php wp_nav_menu( 
					array( 
						'theme_location' => 'header-menu', 
						'menu_class' => 'blog-nav list-inline desktop-xs' 
					)	 
				); 
				?>
			</div>
			<?php require_once('theme-js.php'); ?>
		</div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">