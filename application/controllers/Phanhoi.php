<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phanhoi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Phanhoi_model');
	}

	public function index()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('ten', 'Tên', 'trim|required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[15]|max_length[255]|valid_email');
			$this->form_validation->set_rules('tieu_de', 'Tiêu đề', 'trim|required|min_length[10]|max_length[255]');
			$this->form_validation->set_rules('noi_dung', 'Nội dung', 'trim|required|max_length[500]');
			
			if ($this->form_validation->run() == TRUE) {
				$ten = $this->input->post('ten');
				$email = $this->input->post('email');
				$tieu_de = $this->input->post('tieu_de');
				$noi_dung = $this->input->post('noi_dung');
				$input = array(
					'ten' 			=> $ten,
					'email'			=> $email,
					'tieu_de'		=> $tieu_de,
					'noi_dung'		=> $noi_dung,
					'trang_thai'	=> 1,
					'ngay_gui'		=> now()
 				);
 				if($this->Phanhoi_model->create($input)){
 					$this->session->set_flashdata('message', 'Gửi phản hồi thành công! Cảm ơn bạn!');
 					redirect(base_url('phanhoi'),'refresh');
 				}else{
 					$this->session->set_flashdata('message', 'Gửi phản hồi không thành công, xin mời thử lại!');
 					redirect(base_url('phanhoi'),'refresh');
 				}				
			}
		}
		
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['temp'] = 'site/phanhoi/index';
		$this->load->view('site/main', $this->data, FALSE);
	}

}

/* End of file Phanhoi.php */
/* Location: ./application/controllers/Phanhoi.php */