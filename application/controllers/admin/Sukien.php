<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sukien extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sukien_model');
	}

	public function index()

	{	

		$sum_sukien = $this->Sukien_model->get_total();
		$this->data['sum_sukien'] = $sum_sukien;
		$limit =8;
		$this->load->library('pagination');
		
		$config['base_url'] = admin_url('sukien/index');
		$config['total_rows'] = $sum_sukien;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$this->pagination->initialize($config);
		

		$uri = intval($this->uri->segment(4));

		$data['limit'] = array($limit, $uri);

		
		$sukien = $this->Sukien_model->get_list($data);

		$this->data['sukien'] = $sukien;
		$this->data['message'] = $this->session->flashdata('message');	
		$this->data['temp'] = 'admin/sukien/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	function add(){

		if($this->input->post()){
			$this->form_validation->set_rules('ten', 'Tên sự kiện', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('ngay_dien_ra', 'Ngày diễn ra', 'required|min_length[5]|max_length[255]|date');
			// $this->form_validation->set_rules('mo_ta', 'Mô tả sự kiện', 'required|min_length[5]|max_length[500]');
			if ($this->form_validation->run()) {
				$ten = $this->input->post('ten');
				$ngay_dien_ra = $this->input->post('ngay_dien_ra');
				$mo_ta = $this->input->post('mo_ta');
				$input = array(
					'ten' => $ten,
					'ngay_dien_ra' => $ngay_dien_ra,
					'mo_ta' => $mo_ta
				);

				if($this->Sukien_model->create($input)){
					$this->session->set_flashdata('message', 'Thêm mới thành công!');
					
				}else{
					$this->session->set_flashdata('message', 'Thêm mới không thành công!');
				}
				redirect(admin_url('sukien/index'),'refresh');
			}
		}
		

		$this->data['temp'] = 'admin/sukien/add';
		$this->load->view('admin/main', $this->data, FALSE);
	}


	function edit(){
		$id = $this->uri->segment(4);
		if($this->input->post()){
			$this->form_validation->set_rules('ten', 'Tên sự kiện', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('ngay_dien_ra', 'Ngày diễn ra', 'required|min_length[5]|max_length[255]|date');
			$this->form_validation->set_rules('mo_ta', 'Mô tả sự kiện', 'required|min_length[5]|max_length[500]');
			if ($this->form_validation->run()) {
				$ten = $this->input->post('ten');
				$ngay_dien_ra = $this->input->post('ngay_dien_ra');
				$mo_ta = $this->input->post('mo_ta');
				$input = array(
					'ten' => $ten,
					'ngay_dien_ra' => $ngay_dien_ra,
					'mo_ta' => $mo_ta
				);

				if($this->Sukien_model->update($id,$input)){
					$this->session->set_flashdata('message', 'Cập nhật thành công!');
					
				}else{
					$this->session->set_flashdata('message', 'Cập nhật không thành công!');
				}
				redirect(admin_url('sukien'),'refresh');
			}
		}
		
		$input = array();
		$input['where'] = array( 'id' => $id);
		$this->data['sukien'] = $this->Sukien_model->get_list($input)[0];
		$this->data['temp'] = 'admin/sukien/edit';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	function del(){
		$id = $this->uri->segment(4);
		if($this->Sukien_model->delete($id)){
			$this->session->set_flashdata('message', 'Xóa thành công!');
					
		}else{
			$this->session->set_flashdata('message', 'Xóa không thành công!');
		}
		redirect(admin_url('sukien'),'refresh');
	}
}

/* End of file Sukien.php */
/* Location: ./application/controllers/Sukien.php */