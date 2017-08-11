<?php
function get_page_banner($index){
	$banner=null;

	if(is_page(1729)){
		if($index == '0'){
			//$banner="/files/2013/10/smallbusiness.jpg";
		}else{
			$banner="/files/2017/08/blog_banner.png";
		}
	}else if (is_page(1728)){
		if($index == '0'){
			//$banner="/files/2017/07/professionalLiability.jpg";
		}else{
			$banner="/files/2017/08/blog_banner.png";
		}
	}else if (is_page(1772)){
		if($index == '0'){
			//$banner="/files/2017/07/employmentLabor.jpg";
		}else{
			$banner="/files/2017/08/blog_banner.png";
		}
	}else if (is_page(1798)){
		if($index == '0'){
			//$banner="/files/2017/07/appellate.jpg";
		}else{
			$banner="http://jcdelaw.premierlegalmarketing.com/files/2017/08/civil_rights_banner.png";
		}
	}else if (is_page(753)){
		if($index == '0'){
			//$banner="/files/2017/07/education.jpg";
		}else{
			$banner="http://jcdelaw.premierlegalmarketing.com/files/2017/08/civil_rights_banner.png";
		}
	}else if (is_page(750)){
		if($index == '0'){
			$banner="/files/2017/07/governmental.jpg";
		}else{
			$banner="/files/2017/07/governmentalNEW.jpg";
		}
	}else if (is_page(860)){
		if($index == '0'){
			$banner="/files/2017/07/religiousEntities.jpg";
		}else{
			$banner="/files/2017/07/religiousEntitiesNEW.jpg";
		}		
	}else{}

	if ($banner == null){
		//$banner="/files/2017/07/religiousEntities.jpg";
		//return $banner;
	}
	
	return $banner;
}
?>