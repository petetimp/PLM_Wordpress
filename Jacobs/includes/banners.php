<?php
function get_page_banner($index){
	$banner=null;

	if(is_page(1729)){
		if($index == '0'){
			//$banner="/files/2013/10/smallbusiness.jpg";
		}else{
			$banner="/files/2017/08/blog-banner.png";
		}
	}else if (is_page(1728)){
		if($index == '0'){
			//$banner="/files/2017/07/professionalLiability.jpg";
		}else{
			$banner="/files/2017/08/firm-news-banner.png";
		}
	}else if (is_page(1772)){
		if($index == '0'){
			//$banner="/files/2017/07/employmentLabor.jpg";
		}else{
			$banner="/files/2017/08/testimonials-banner-2.png";
		}
	}else if (is_page(1798)){
		if($index == '0'){
			//$banner="/files/2017/07/appellate.jpg";
		}else{
			$banner="/files/2017/08/civil-rights-banner.png";
		}
	}else if (is_page(1820)){
		if($index == '0'){
			//$banner="/files/2017/07/education.jpg";
		}else{
			$banner="/files/2017/08/med_mal_banner.png";
		}
	}else if (is_page(1875)){
		if($index == '0'){
			//$banner="/files/2017/07/governmental.jpg";
		}else{
			$banner="/files/2017/08/employment-law-banner.png";
		}
	}else if (is_page(1892)){
		if($index == '0'){
			//$banner="/files/2017/08/personalInjury-banner-1.png";
		}else{
			$banner="/files/2017/08/personal-injury-banner.png";
		}		
	}
	else if (is_page(1829)){
		if($index == '0'){
			//$banner="/files/2017/07/education.jpg";
		}else{
			$banner="/files/2017/08/sa.jpg";	
		}		
	}
	else if (is_page(1834)){
		if($index == '0'){
			//$banner="/files/2017/07/education.jpg";
		}else{
			$banner="/files/2017/08/transvaginal-mesh-banner.png";	
		}		
	}
	else if (is_page(1836)){
		if($index == '0'){
			//$banner="/files/2017/07/education.jpg";
		}else{
			$banner="/files/2017/08/xarelto-banner.png";	
		}		
	}else{}

	if ($banner == null){
		//$banner="/files/2017/07/religiousEntities.jpg";
		//return $banner;
	}
	
	return $banner;
}
?>