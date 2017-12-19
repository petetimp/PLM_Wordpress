<?php
function get_page_banner($index){
	global $post;
	$banner=null;

	if(is_page(1019)){
		$banner="/files/2017/12/practice-areas-banner.jpg";
	}else if(is_page(3805) || is_page(3755)){
		$banner="/files/2017/12/child-support-banner.jpg";
	}else if(is_page(3750) || is_page(3813)){
		$banner="/files/2017/12/special-needs-children-banner.jpg";
	}else if(is_page(3806) || is_page(3816) ){
		$banner="/files/2017/12/same-sex-marriage-banner.jpg";
	}else if(is_page(3748) || is_page(3812) || is_page(3815) ){
		$banner="/files/2017/12/prenuptial-agreement-banner.jpg";
	}else if(is_page(3807)){
		$banner="/files/2017/12/domestic-violence-banner.jpg";
	}else if(is_page(3809) || is_page(3811)){
		$banner="/files/2017/12/high-net-worth-divorce-banner.jpg";
	}else if(is_page(3810)){
		$banner="/files/2017/12/grandparents-rights-banner.jpg";
	}else if(is_page(21)){
		$banner="/files/2017/12/contact-us-banner.jpg";//not a practice area but using the template
	}else if(is_page(16)){//attorney page
		$banner="/files/2017/12/attorney-banner.jpg";
	}else if(is_page(3817)){
		$banner="/files/2017/12/effect-special-needs-children-divorce.jpg";
	}else if (is_page(20)){//blog page
		$banner="/files/2017/12/blog-banner.jpg";
	}else if (is_page(18)){//testimonial page
		$banner="/files/2017/12/testimonials-banner.jpg";
	}else{}

	if ($banner == null){//should never happen
		$banner="";
		return $banner;
	}
	
	return $banner;
}
?>