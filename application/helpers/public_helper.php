<?php 
	
	function public_url($url = '')
	{
		if($url == ''){
			return base_url('public');
		}
        return base_url('public/'.$url);
	}

	function chua_url($url = '')
	{
		if($url == ''){
			return base_url('upload/chua');
		}
        return base_url('upload/chua/'.$url);
	}
	
 ?>