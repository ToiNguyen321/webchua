<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Danhmuc extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Danhmuc_model');
	}

	public function index()
	{
		$input['where'] = array('id !=' => 1, 'parent_id !=' => 1);

		$sum_danhmuc = $this->Danhmuc_model->get_total($input);
		$this->data['sum_danhmuc'] = $sum_danhmuc;
		$limit = 10;
		$this->load->library('pagination');
		
		$config['base_url'] = admin_url('danhmuc/index');
		$config['total_rows'] = $sum_danhmuc;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$this->pagination->initialize($config);
		

		$uri = intval($this->uri->segment(4));

		$input['limit'] = array($limit, $uri);

		
		$danhmuc = $this->Danhmuc_model->get_list($input);

		$this->data['danhmuc'] = $danhmuc;
		$this->data['message'] = $this->session->flashdata('message');
		// $this->data['danhmuc'] = $this->Danhmuc_model->get_list($input);
		$this->data['temp'] = 'admin/danhmuc/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	function add(){

		if($this->input->post()){
			$this->form_validation->set_rules('ten', 'Tên danh mục', 'required|min_length[4]');
			$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required|min_length[1]|integer');
			if ($this->form_validation->run() == true) {
				# code...
				$input = array();
				$input['ten'] = $this->input->post('ten');
				$input['parent_id'] = $this->input->post('parent_id');
				$input['sort_order'] = $this->input->post('sort_order');
				if($this->Danhmuc_model->create($input)){
					$this->session->set_flashdata('message', 'Thêm mới thành công!');
				}else{
					$this->session->set_flashdata('message', 'Thêm mới thất bại!');
				}
				redirect(admin_url('danhmuc'));
			}

		}
		$data = array();
		$data['where'] = array(
			'parent_id' => '0'
		);
		$parent_id = $this->Danhmuc_model->get_list($data);
		$this->data['parent_id'] = $parent_id;

		$this->data['temp'] = 'admin/danhmuc/add';
		$this->load->view('admin/main', $this->data, false);
	}


	function edit(){
		$this->load->library('form_validation');
		$this->load->helper('form');
		$id = $this->uri->segment(4);
		$input = array(
			'where' => array(
			'id'	=>$id
			)
		);
		$danhmuc = $this->Danhmuc_model->get_row($input);
		$this->data['danhmuc'] = $danhmuc;

		if($this->input->post()){
			$this->form_validation->set_rules('ten', 'Tên danh mục', 'required|min_length[4]');
			$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required|min_length[1]|integer');

			if ($this->form_validation->run() == true) {
				# code...
				$input = array();
				$input['ten'] = $this->input->post('ten');
				$input['parent_id'] = $this->input->post('parent_id');
				$input['sort_order'] = $this->input->post('sort_order');

				if($this->Danhmuc_model->update($id,$input)){
					$this->session->set_flashdata('message', 'Cập nhật thành công!');
				}else{
					$this->session->set_flashdata('message', 'Cập nhật thất bại!');
				}

				redirect(admin_url('danhmuc'));
			}

		}
		$data = array();
		$data['where'] = array(
			'parent_id' => '0'
		);
		$parent_id = $this->Danhmuc_model->get_list($data);
		$this->data['parent_id'] = $parent_id;

		$this->data['temp'] = 'admin/danhmuc/edit';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	
	function del(){
		$id = $this->uri->segment(4);

		//Chuyển các chùa có trong danh mục xóa sang danh mục tạm thời.
		$this->load->model('Chua_model');
		$where = array('id_danh_muc' => $id);
		$input = array('id_danh_muc' => 2);

		if($this->Chua_model->update_rule($where, $input)){
			if($this->Danhmuc_model->delete($id)){
				$this->session->set_flashdata('message', 'Xóa thành công!');		
			}else{
				$this->session->set_flashdata('message', 'Xóa không thành công!');
			}
		}else{
			$this->session->set_flashdata('message', 'Xóa không thành công!');
		}
		redirect(admin_url('danhmuc'),'refresh');
	}

}

/* End of file Danhmuc.php */
/* Location: ./application/controllers/Danhmuc.php */