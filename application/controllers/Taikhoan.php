<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taikhoan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Taikhoan_model');
		$this->data['message'] = $this->session->flashdata('message');
	}

	// public function index()
	// {
	// 	$this->data['temp'] = 'site/taikhoan/dangnhap';
	// 	$this->load->view('site/main', $this->data, FALSE);
	// }
	public function dangky()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('ten_nguoi_dung', 'Tên người dùng', 'trim|required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[255]|valid_email|callback_email_check');
			$this->form_validation->set_rules('mat_khau', 'Mật khẩu', 'trim|required|min_length[6]|max_length[255]|callback_mat_khau_check');
			$this->form_validation->set_rules('mat_khau_lai', 'Nhập lại mật khẩu', 'trim|required|min_length[6]|max_length[255]|callback_mat_khau_lai_check');
			if ($this->form_validation->run() == TRUE) {
				$ten_nguoi_dung = $this->input->post('ten_nguoi_dung');
				$email = $this->input->post('email');
				$mat_khau = md5(trim($this->input->post('mat_khau')));
				$input = array(
					'ten_nguoi_dung' 	=> $ten_nguoi_dung,
					'email'				=> $email,
					'mat_khau'			=> $mat_khau,
					'quyen'				=> 3,
					'trang_thai'		=> 5,
					'ngay_tao'			=> now()
				);
				if($this->Taikhoan_model->create($input)){
					$this->session->set_flashdata('message', $email . ' Đăng ký thành công, tài khoản đang trong quá trình phê duyệt!');
					redirect(base_url('taikhoan/dangnhap'),'refresh');
				}else{
					$this->session->set_flashdata('message', 'Đăng ký không thành công, xin mời thử lại!');
					redirect(base_url('taikhoan/dangky'),'refresh');
				}				
			}
		}
		$this->data['temp'] = 'site/taikhoan/dangky';
		$this->load->view('site/main', $this->data, FALSE);
	}
	function email_check(){
		$email = $this->input->post('email');
		$input['where'] = array('email' => $email);
		$check_email =  $this->Taikhoan_model->get_total($input);
		if($check_email == 0){
			return true;
		}
		$this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại trên hệ thống, vui lòng xem lại!');
		return FALSE;
	}
	public function dangnhap()
	{
		/**
		Trang_thai == 5 -> Chờ duyệt
		Trang_thai == 6-> Được hoạt động
		Trang_thai == 7 -> Bị khóa

		*/
		if ($this->input->post()) {
			$email = $this->input->post('email');
			$mat_khau = md5(trim($this->input->post('mat_khau')));
			$sql = "SELECT * FROM tai_khoan WHERE email = '$email' AND quyen IN (3) limit 1";
			$nguoi_dung = $this->Taikhoan_model->query($sql);
			if(!empty($nguoi_dung)){

				$sql2 = "SELECT * FROM tai_khoan WHERE email = '$email' AND BINARY  mat_khau = '$mat_khau' AND quyen IN (3) limit 1";
				$nguoi_dung2 = $this->Taikhoan_model->query($sql2);

				if (!empty($nguoi_dung2)) {
					$nguoi_dung = $nguoi_dung[0];
					$trang_thai = $nguoi_dung->trang_thai;
					if($trang_thai == 5){
						$this->session->set_flashdata('message', 'Tài khoản của bạn đang trong quá trình duyệt, xin mời thử lại sau!');
						redirect(base_url('taikhoan/dangnhap'),'refresh');
					}else if ($trang_thai == 7) {
						$this->session->set_flashdata('message', 'Tài khoản của bạn đã bị khóa, xin mời liên hệ hỗ trợ!');
						redirect(base_url('taikhoan/dangnhap'),'refresh');
					}else{
						$tt_nguoi_dung = array(
							'id_nguoi_dung'		=> $nguoi_dung->id,
							'ten_nguoi_dung' 	=> $nguoi_dung->ten_nguoi_dung,
							'email_dang_nhap' 	=> $nguoi_dung->email
						);
						$this->session->set_userdata('nguoi_dung', $tt_nguoi_dung);
						redirect(base_url(),'refresh');
					}
				}else{
					$this->session->set_flashdata('message', 'Đăng nhập không thành công, mật khẩu không chính xác!');
					redirect(base_url('taikhoan/dangnhap'),'refresh');
				}

			}else{
				$this->session->set_flashdata('message', 'Đăng nhập không thành công, tài khoản không tồn tại!');
				redirect(base_url('taikhoan/dangnhap'),'refresh');
			}							
		}
		$this->data['temp'] = 'site/taikhoan/dangnhap';
		$this->load->view('site/main', $this->data, FALSE);
	}

	public function dangxuat()
	{
		$this->session->unset_userdata('nguoi_dung');
		redirect(base_url(),'refresh');
	}

	function view(){
		$nguoi_dung = $this->session->userdata('nguoi_dung');
		if(!$nguoi_dung){
			redirect(base_url(),'refresh');
		}
		
		
		if ($this->input->post()) {
			$id_nguoi_dung = $nguoi_dung['id_nguoi_dung'];
			$email = $nguoi_dung['email_dang_nhap'];

			// $this->form_validation->set_rules('ten_nguoi_dung', 'Tên người dùng', 'trim|required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('mat_khau_moi', 'Mật khẩu mới', 'trim|required|min_length[6]|max_length[255]|callback_mat_khau_moi_check');
			$this->form_validation->set_rules('mat_khau_moi_lai', 'Nhập lại mật khẩu mới', 'trim|required|min_length[6]|max_length[255]|matches[mat_khau_moi]');
			$this->form_validation->set_rules('mat_khau_cu', 'Mật khẩu cũ', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$ten_nguoi_dung = $this->input->post('ten_nguoi_dung');
				$mat_khau_cu = md5($this->input->post('mat_khau_cu'));
				$mat_khau_moi = md5($this->input->post('mat_khau_moi'));
				$input = array(
					// 'ten_nguoi_dung' => $ten_nguoi_dung,
					'mat_khau'		=> $mat_khau_moi
				);
				$where = array(
					'email' 	=> $email,
					'mat_khau' 	=> $mat_khau_cu
				);
				if($this->Taikhoan_model->update_rule($where, $input)){
					$this->session->set_flashdata('message', 'Thay đổi mật khẩu thành công');
					$this->session->unset_userdata('nguoi_dung');
					redirect(base_url('taikhoan/dangnhap'),'refresh');
				}else{
					$this->session->set_flashdata('message', 'Thay đổi mật khẩu không thành công! Vui lòng kiểm tra lại!');
					redirect(base_url('taikhoan/view'),'refresh');
				}
			}			
		}
		$this->data['temp'] = 'site/taikhoan/view';
		$this->load->view('site/main', $this->data, FALSE);
	}

	function mat_khau_lai_check(){
		$mat_khau_lai = md5($this->input->post('mat_khau_lai'));
		$mat_khau =  md5($this->input->post('mat_khau'));
		if($mat_khau_lai == $mat_khau){
			return TRUE;
			
		}
		$this->form_validation->set_message(__FUNCTION__, 'Hai trường mật khẩu phải giống nhau!');
		return FALSE;
	}

	function mat_khau($input){
		$mat_khau_moi = $this->input->post($input);
		if(preg_match('/^[a-zA-Z0-9]+$/',$mat_khau_moi)){
			return TRUE;
			
		}
		$this->form_validation->set_message(__FUNCTION__, 'Mật khẩu không được viết có dấu!');
		return FALSE;
	}
	function mat_khau_moi_check(){
		$mat_khau_moi = $this->input->post('mat_khau_moi');
		if(preg_match('/^[a-zA-Z0-9]+$/',$mat_khau_moi)){
			return TRUE;
			
		}
		$this->form_validation->set_message(__FUNCTION__, 'Mật khẩu không được viết có dấu!');
		return FALSE;
	}
	function mat_khau_check(){
		$mat_khau = $this->input->post('mat_khau');
		if(preg_match('/^[a-zA-Z0-9]+$/',$mat_khau)){
			return TRUE;
			
		}
		$this->form_validation->set_message(__FUNCTION__, 'Mật khẩu không được viết có dấu!');
		return FALSE;
	}
	

}

/* End of file Taikhoan.php */
/* Location: ./application/controllers/Taikhoan.php */