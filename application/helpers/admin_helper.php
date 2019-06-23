<?php 
	function admin_url($url = '')
	{
		if($url == ''){
			return base_url('admin');
		}
		return base_url('admin/'.$url); 
	}

	function pre($arr, $die = true){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		if($die == true)
			die();
	}
 ?>