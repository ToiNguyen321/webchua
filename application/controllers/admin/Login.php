<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends My_Controller {

	function __construct(){
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post()){
			$this->form_validation->set_rules('login', 'Login', 'callback_check_login_');
			if ($this->form_validation->run()) {
				$this->session->set_userdata('login', true);
				redirect(admin_url());
			}
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->load->view('admin/login/index', $this->data);

	}

	function check_login_(){
		$this->load->model('Taikhoan_model');
		$email = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$sql = "SELECT * FROM tai_khoan WHERE email = '$email' AND BINARY mat_khau = '$password' AND quyen IN (1,2) limit 1";
		$user = $this->Taikhoan_model->query($sql);

		if(!empty($user)){
			return true;
		}
		$this->form_validation->set_message(__FUNCTION__, 'Đăng nhập không thành công!');
		return false;
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */