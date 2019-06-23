<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phuong_quan_tinh extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Phuong_model');
		$this->load->model('Quan_model');
		$this->load->model('Tinh_model');
	}


	function phuong(){
		$id_quan = $this->uri->segment(4);
		//Check request ajax;
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest") 
		{
		// most probably ajax request
			$input['where'] = array('districtid' => $id_quan); 
			$phuongs = $this->Phuong_model->get_list($input);
			echo json_encode($phuongs);
			exit();
		}
	}

	function quan(){
		$id_tinh = $this->uri->segment(4);
		//Check request ajax;
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest") 
		{
		// most probably ajax request
			$input['where'] = array('provinceid' => $id_tinh); 
			$quans = $this->Quan_model->get_list($input);
			echo json_encode($quans);
			exit();
		}
		
	}

}

/* End of file Xa_Phuong_Tinh.php */
/* Location: ./application/controllers/Xa_Phuong_Tinh.php */