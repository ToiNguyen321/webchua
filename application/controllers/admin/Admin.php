<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Taikhoan_model');
	}

	public function index()
	{
		
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */