<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taikhoan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Taikhoan_model');
	}

	public function index()
	{
		$input['where'] = array('quyen' => 3);
		$sum_nguoidung = $this->Taikhoan_model->get_total($input);
		$limit = 10;
		$this->load->library('pagination');
		
		$config['base_url'] = admin_url('taikhoan/index');
		$config['total_rows'] = $sum_nguoidung;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$this->pagination->initialize($config);
		
		
		$uri = intval($this->uri->segment(4));
		//Quyền = 3 = nguoi dung
		$sql = "SELECT * FROM `tai_khoan` INNER JOIN trang_thai On trang_thai.id_trang_thai = tai_khoan.trang_thai  Where quyen = 3 limit  $uri,$limit";
		$nguoi_dung = $this->Taikhoan_model->query($sql);
		$this->data['nguoi_dung'] = $nguoi_dung;

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['temp'] = 'admin/taikhoan/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	function duyet(){
		$id = $this->uri->segment(4);
		$input = array(
			'trang_thai' => '6'
		);
		if($this->Taikhoan_model->update($id, $input)){
			$this->session->set_flashdata('message', 'Duyệt ID ' . $id . ' thành công!');
		}else{
			$this->session->set_flashdata('message', 'Duyệt ID ' . $id . ' không thành công!');
		}
		redirect(admin_url('taikhoan'),'refresh');
	}

	function khoiphucmatkhau(){
		$id = $this->uri->segment(4);
		$input = array(
			'mat_khau'	=> md5('123456')
		);
		if($this->Taikhoan_model->update($id, $input)){
			$this->session->set_flashdata('message', 'Khôi phục mật khẩu cho ID ' . $id . ' thành công!');
		}else{
			$this->session->set_flashdata('message', 'Khôi phục mật khẩu cho ID ' . $id . ' không thành công!');
		}
		redirect(admin_url('taikhoan'),'refresh');
	}

	function doimatkhau(){
		if ($this->input->post()) {
			$this->form_validation->set_rules('mat_khau_cu', 'Mật khẩu cũ', 'trim|required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]');
			$this->form_validation->set_rules('mat_khau_moi', 'Mật khẩu mới', 'trim|required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]');
			$this->form_validation->set_rules('mat_khau_moi_2', 'Nhập lại mật khẩu', 'trim|required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]|matches[mat_khau_moi]');
		
			if ($this->form_validation->run() == TRUE) {
				# code...
				$email = 'admin@gmail.com';
				$mat_khau_cu = md5($this->input->post('mat_khau_cu'));
				$mat_khau_moi = md5($this->input->post('mat_khau_moi'));

				$input = array(
					'mat_khau' => $mat_khau_moi
				);
				$where = array(
					'email' 	=> $email,
					'mat_khau' 	=> $mat_khau_cu
				);
				if($this->Taikhoan_model->update_rule($where, $input)){
						$this->session->set_flashdata('message', 'Thay đổi mật khẩu thành công');
						$this->session->unset_userdata('login');
						redirect(admin_url('login'),'refresh');
				}else{
					$this->session->set_flashdata('message', 'Thay đổi mật khẩu không thành công! Vui lòng kiểm tra lại!');
					redirect(admin_url('taikhoan/doimatkhau'),'refresh');
				}

			}
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['temp'] = 'admin/taikhoan/doimatkhau';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	function camhoatdong(){
		$id = $this->uri->segment(4);
		$input = array(
			'trang_thai' => 7
		);
		if($this->Taikhoan_model->update($id, $input)){
			$this->session->set_flashdata('message', 'Cấm ID ' . $id . ' hoạt động thành công!');
		}else{
			$this->session->set_flashdata('message', 'Cấm ID ' . $id . ' hoạt động không IDthành công!');
		}
		redirect(admin_url('taikhoan'),'refresh');
	}

	function hoatdong(){
		$id = $this->uri->segment(4);
		$input = array(
			'trang_thai' => 6
		);
		if($this->Taikhoan_model->update($id, $input)){
			$this->session->set_flashdata('message', 'Cho phép ID ' . $id . ' hoạt động thành công!');
		}else{
			$this->session->set_flashdata('message', 'Cho phép ID ' . $id . ' hoạt động không thành công!');
		}
		redirect(admin_url('taikhoan'),'refresh');
	}



	function logout(){
		if($this->session->userdata('login')){
			$this->session->unset_userdata('login');
		}
		redirect(admin_url('login'));
	}
}

/* End of file Taikhoan.php */
/* Location: ./application/controllers/Taikhoan.php */