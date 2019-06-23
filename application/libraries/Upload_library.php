<?php 

	/**
	 * summary
	 */
	class Upload_library
	{
	    /**
	     * summary
	     */
	    var $CI = '';
	    private $path = './upload/chua/';
	    function __construct()
	    {
	    	$this->CI = & get_instance();
	    }

	    function upload($upload_path = '', $input_name = ''){

	    	$config = $this->config($upload_path);
			$this->CI->load->library('upload', $config);
			$data = array();

	    	if ( ! $this->CI->upload->do_upload($input_name)){
	    		
	    		$data = $this->CI->upload->display_errors();
	    	}
	    	else{

	    		$data = $this->CI->upload->data();
	    	}
	    	
	    	return $data;
	    }

	    function upload_file($upload_path = '', $input_name = ''){
	    	$config = $this->config($upload_path);

	    	$image_list = array();

	    	$file = $_FILES[$input_name];
	    	$count = count($file['name']);
	    	for($i = 0; $i < $count; $i++){
	    		$_FILES['userfile']['name'] = $file['name'][$i];
	    		$_FILES['userfile']['type'] = $file['type'][$i];
	    		$_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
	    		$_FILES['userfile']['error'] = $file['error'][$i];
	    		$_FILES['userfile']['size'] = $file['size'][$i];

				$this->CI->load->library('upload', $config);
	    		if ($this->CI->upload->do_upload()){
	    		
	    			$data = $this->CI->upload->data();
	    			$image_list[] = $data['file_name'];
	    		}
	    	}

	    	return $image_list;
	    }

	    function config($upload_path = ''){

	    	$config['upload_path'] = $upload_path;
	    	$config['allowed_types'] = 'gif|jpg|png';
	    	$config['max_size']  = '2048';
	    	$config['max_width']  = '1280';
	    	$config['max_height']  = '1024';
	    	
	    	return $config;
	    	
	    }
	}

 ?>