<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phanhoi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Phanhoi_model');
		
	}

	public function index()
	{
		$this->load->library('pagination');
		/**
		Phân trang
		*/
		//Lấy ra tổng số phản hồi
		$sum_phanhoi = $this->Phanhoi_model->get_total();
		$limit = 10;


		
		
		$config['base_url'] = admin_url('phanhoi/index');
		$config['total_rows'] = $sum_phanhoi;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$this->pagination->initialize($config);
		
		$uri = intval($this->uri->segment(4));

		//Query Join bảng phan_hoi va trang_thai qua truong trang_thai
		//sắp xếp theo trang thái và ngày gửi. ưu tiên trạng thái trước rồi mới đến ngày gửi

		$sql = "SELECT * FROM phan_hoi INNER JOIN trang_thai on phan_hoi.trang_thai = trang_thai.id_trang_thai order By trang_thai ASC, ngay_gui DESC LIMIT $uri, $limit ";
		$phanhoi = $this->Phanhoi_model->query($sql);

		

		$this->data['phanhoi'] = $phanhoi;
		$this->data['message'] = $this->session->flashdata('message');

		$this->data['temp'] = 'admin/phanhoi/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	public function xem(){
		$id = $this->uri->segment(4);
		$trang_thai = $this->uri->segment(5);
		$input['where'] = array('id' => $id);
		$input['join'] = array('trang_thai','phan_hoi.trang_thai', 'trang_thai.id_trang_thai' );
		
		
		$phanhoi = $this->Phanhoi_model->get_row($input);
		$this->data['phanhoi'] = $phanhoi;

		//Sau khi xem thì update lại trạng thái.
		if($trang_thai == 1){
			$data = array('trang_thai' => 2);
			$this->Phanhoi_model->update($id, $data);
		}

		$this->data['temp'] = 'admin/phanhoi/xem';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	public function spam(){
		$id = $this->uri->segment(4);
		$data = array('trang_thai' => 4);
		if($this->Phanhoi_model->update($id, $data)){
			$this->session->set_flashdata('message', 'Đánh giấu spam thành công!');
		}else{
			$this->session->set_flashdata('message', 'Đánh giấu spam không thành công!');
		}
		redirect(admin_url('phanhoi'),'refresh');
	}

	public function traloi(){
		$id = $this->uri->segment(4);
		
		
		if($this->input->post()){
			$this->form_validation->set_rules('tieu_de_gui', 'Tiêu đề gửi', 'required|min_length[10]|max_length[100]');
			$this->form_validation->set_rules('noi_dung', 'Nội dung trả lời', 'required|min_length[50]|max_length[1000]');
			if ($this->form_validation->run() == TRUE) {

				$email_nguoi_gui = 'dragon862466@gmail.com';
				$email_nguoi_nhan = trim($this->input->post('email_nhan'));
				$tieu_de_gui = trim($this->input->post('tieu_de_gui'));
				$noi_dung = $this->input->post('noi_dung');

				

				$config['charset'] = "utf-8";
				$config['newline'] = "\r\n";
				$config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "smtp.gmail.com"; //neu sử dụng gmail
				$config['smtp_user'] 	= "dragon862466@gmail.com";
				$config['smtp_pass'] 	= "04061997";
				$config['smtp_port'] 	= 587; 	//nếu sử dụng gmail
				$config['wordwrap']		=true;
				$config['mailtype'] = "html";
				$config['smtp_crypto'] = 'ssl';

				$this->load->library('email', $config);
				
				$this->email->from("dragon862466@gmail.com"); //Người gửi. địa chỉ, tên
				$this->email->to($email_nguoi_nhan); //ĐỊa chỉ mail nhận
				$this->email->subject($tieu_de_gui); //Tiêu đề mail.
				$this->email->message($noi_dung); //Nội dung mail
				
				if (!$this->email->send()){
					$this->session->set_flashdata('message', "Trả lời phản hồi không thành công!");	
				}else{

					$data = array('trang_thai' => 3);
					if($this->Phanhoi_model->update($id, $data)){
						$this->session->set_flashdata('message', 'Trả lời phản hồi thành công!');
					}else{
						$this->session->set_flashdata('message', 'Trả lời phản hồi không thành công!');
					}

				}


				redirect(admin_url('phanhoi'),'refresh');
			}
		}

		

		

		$input['field'] = array('id','email', 'ten');
		$input['where'] = array('id' => $id);
		$phanhoi = $this->Phanhoi_model->get_row($input);
		$this->data['phanhoi'] = $phanhoi;

		$this->data['temp'] = 'admin/phanhoi/traloi';
		$this->load->view('admin/main', $this->data, FALSE);
	}

}

/* End of file Phanhoi.php */
/* Location: ./application/controllers/Phanhoi.php */