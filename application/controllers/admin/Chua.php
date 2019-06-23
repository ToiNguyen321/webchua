<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chua extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Chua_model');
		$this->load->model('Danhmuc_model');
		$this->load->model('Sukien_model');

		$this->load->model('Phuong_model');
		$this->load->model('Quan_model');
		$this->load->model('Tinh_model');

		$this->load->library('pagination');
		$this->load->library('Upload_library');
		date_default_timezone_set('Asia/Ho_Chi_Minh');


		//load danh sách danh mục
		$this->data['danh_muc'] = $this->load_danh_muc();

		//Load danh sách sự kiện
		$su_kien['field'] = array('id', 'ten', 'ngay_dien_ra');
		$su_kien = $this->Sukien_model->get_list($su_kien);
		$this->data['su_kien'] = $su_kien;

		//Load danh sách tỉnh
		$tinh['field'] = array('provinceid', 'name', 'type');
		$tinhs = $this->Tinh_model->get_list($tinh);
		$this->data['tinhs'] = $tinhs;


	}

	public function index()
	{
		$sum_chua = $this->Chua_model->get_total();
		$this->data['sum_chua'] = $sum_chua;
		$limit = 3;
		$this->load->library('pagination');
		
		$config['base_url'] = admin_url('chua/index');
		$config['total_rows'] = $sum_chua;
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

		
		$chua = $this->Chua_model->get_list($data);
		$this->data['chua'] = $chua;
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['temp'] = 'admin/chua/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}


	function add(){
		//form add
		if($this->input->post()){
			$this->form_validation->set_rules('ten', 'Tên', 'required|min_length[4]');
			$this->form_validation->set_rules('tieu_de', 'Tiêu đề', 'required|min_length[10]|max_length[500]');
			$this->form_validation->set_rules('nguoi_chu_tri', 'Người chủ trì', '');
			$this->form_validation->set_rules('danh_muc', 'Danh mục', 'required');
			$this->form_validation->set_rules('id_tinh', 'Tỉnh', 'required');
			$this->form_validation->set_rules('mo_ta', 'Mô tả hiển thị', 'required');
			if ($this->form_validation->run() == true) {
				# code...
				$input = array();
				$input['ten'] = $this->input->post('ten');

				$path = './upload/chua';

				$anh = $this->upload_library->upload($path, 'anh');

				if(!empty($anh['file_name'])){
					$input['anh'] = $anh['file_name'];
				}else{
					$input['anh'] = 'no-image.png';
				}


				$list_anh = $this->upload_library->upload_file($path, 'list_anh');
				$input['list_anh'] = json_encode($list_anh);

				$input['tieu_de'] = $this->input->post('tieu_de');
				$input['nguoi_chu_tri'] = $this->input->post('nguoi_chu_tri');
				$input['nam_xay_dung'] = $this->input->post('nam_xay_dung');
				$input['id_tinh'] = $this->input->post('id_tinh');
				$input['id_quan'] = $this->input->post('id_quan');
				$input['id_phuong'] = $this->input->post('id_phuong');
				$input['so_nha'] = $this->input->post('so_nha');
				$input['id_danh_muc'] = $this->input->post('danh_muc');
				$input['view'] = 0;
				$input['mo_ta'] = $this->input->post('mo_ta');

				$su_kien = $this->input->post('su_kien');
				if(empty($su_kien)){
					$su_kien = array(0);
				}
				$input['su_kien'] = json_encode($su_kien);
				
				$input['ngay_tao'] = now();

				if($this->Chua_model->create($input)){
					$this->session->set_flashdata('message', 'Thêm mới thành công!');
				}else{
					$this->session->set_flashdata('message', 'Thêm mới thất bại!');
				}
				redirect(admin_url('chua'));
			}

		}

		

		// //Load danh sách sự kiện
		// $su_kien['field'] = array('id', 'ten', 'ngay_dien_ra');
		// $su_kien = $this->Sukien_model->get_list($su_kien);
		// $this->data['su_kien'] = $su_kien;

		// //Load danh sách tỉnh
		// $tinh['field'] = array('provinceid', 'name', 'type');
		// $tinhs = $this->Tinh_model->get_list($tinh);
		// $this->data['tinhs'] = $tinhs;

		$this->data['temp'] = 'admin/chua/add';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	function load_danh_muc(){
		//load danh sách danh mục
		$danh_muc['field'] = array('id', 'ten' );
		$danh_muc['where'] = array('parent_id' => 0);
		$danh_muc_cha = $this->Danhmuc_model->get_list($danh_muc);
		foreach ($danh_muc_cha as $value) {
			$danh_muc['where'] = array('parent_id' => $value->id);
			$sub = $this->Danhmuc_model->get_list($danh_muc);
			$value->subs = $sub;
		}
		return $danh_muc_cha;
	}

	function view()
	{
		$id = $this->uri->segment(4);
		$sql = "SELECT chua.id, chua.ten, `so_nha`, `tieu_de`, `nguoi_chu_tri`, `view`, `mo_ta`, `nam_xay_dung`, `anh`, `list_anh`, `su_kien`, `ngay_tao`, danh_muc.ten AS danh_muc, ward.name AS phuong, ward.type AS type_phuong, district.name AS quan, district.type AS type_quan, province.name AS tinh, province.type AS type_tinh FROM `chua` INNER JOIN ward on chua.id_phuong = ward.wardid INNER JOIN district on chua.id_quan = district.districtid INNER JOIN province on chua.id_tinh = province.provinceid INNER JOIN danh_muc on chua.id_danh_muc = danh_muc.id WHERE chua.id = $id";
		$chua = $this->Chua_model->query($sql);
		$chua = $chua[0];
		if(!empty($chua->so_nha)){
			$chua->dia_chi = $chua->so_nha . ', ' . $chua->type_phuong . ' ' . $chua->phuong. ', ' . $chua->type_quan . ' ' . $chua->quan. ', ' .$chua->type_tinh. ' ' .$chua->tinh;
		}else{
			$chua->dia_chi = $chua->type_phuong . ' ' . $chua->phuong. ', ' . $chua->type_quan . ' ' . $chua->quan. ', ' .$chua->type_tinh. ' ' .$chua->tinh;
		}

		
		$su_kien = implode(',', json_decode($chua->su_kien));
		$sql_sk = "SELECT ten FROM `su_kien` WHERE id IN ($su_kien)";
		$su_kien = $this->Sukien_model->query($sql_sk);
		$su_kien = $su_kien;
		
		$this->data['su_kien'] = $su_kien;

		$this->data['chua'] = $chua;
		
		$this->data['temp'] = 'admin/chua/view';
		$this->load->view('admin/main', $this->data, FALSE);
	}

	 function edit(){
	 	$id = $this->uri->segment(4);

	 	//Form edit
	 	if($this->input->post()){
			$this->form_validation->set_rules('ten', 'Tên', 'required|min_length[4]');
			$this->form_validation->set_rules('tieu_de', 'Tiêu đề', 'required|min_length[10]|max_length[255]');
			$this->form_validation->set_rules('nguoi_chu_tri', 'Người chủ trì', '');
			$this->form_validation->set_rules('danh_muc', 'Danh mục', 'required');
			$this->form_validation->set_rules('id_tinh', 'Tỉnh', 'required');
			$this->form_validation->set_rules('mo_ta', 'Mô tả hiển thị', 'required');
			if ($this->form_validation->run() == true) {
				# code...
				$input = array();
				$input['ten'] = $this->input->post('ten');

				$path = './upload/chua';

				$anh = $this->upload_library->upload($path, 'anh');

				if(!empty($anh['file_name'])){
					$input['anh'] = $anh['file_name'];
				}


				$list_anh = $this->upload_library->upload_file($path, 'list_anh');
				if(!empty($list_anh)){
					$input['list_anh'] = json_encode($list_anh);
				}
				

				$input['tieu_de'] = $this->input->post('tieu_de');
				$input['nguoi_chu_tri'] = $this->input->post('nguoi_chu_tri');
				$input['nam_xay_dung'] = $this->input->post('nam_xay_dung');
				$input['id_tinh'] = $this->input->post('id_tinh');
				$input['id_quan'] = $this->input->post('id_quan');
				$input['id_phuong'] = $this->input->post('id_phuong');
				$input['so_nha'] = $this->input->post('so_nha');
				$input['id_danh_muc'] = $this->input->post('danh_muc');
				$input['mo_ta'] = $this->input->post('mo_ta');
				$su_kien = $this->input->post('su_kien');
				if(empty($su_kien)){
					$su_kien = array(0);
				}
				$input['su_kien'] = json_encode($su_kien);

				if($this->Chua_model->update($id, $input)){
					$this->session->set_flashdata('message', 'Cập nhật thành công!');
				}else{
					$this->session->set_flashdata('message', 'Cập nhật thất bại!');
				}
				redirect(admin_url('chua'));
			}

		}




	 	$input['where'] = array('id' => $id);
	 	$chua = $this->Chua_model->get_row($input);
	 	$this->data['chua'] = $chua;

	 	//Lấy danh sách tất cả các quận theo id tỉnh.
	 	$id_tinh = $chua->id_tinh;
	 	$input['where'] = array('provinceid' => $id_tinh);
	 	$quans = $this->Quan_model->get_list($input);
	 	$this->data['quans'] = $quans;

	 	//Lấy danh sách tất cả các quận theo id quận.
	 	$id_quan = $chua->id_quan;
	 	$input['where'] = array('districtid' =>  $id_quan);
	 	$phuongs = $this->Phuong_model->get_list($input);
	 	$this->data['phuongs'] = $phuongs;


	 	$this->data['temp'] = 'admin/chua/edit';
		$this->load->view('admin/main', $this->data, FALSE);
	 }


	function del()
	{
		$id = $this->uri->segment(4);
		$input['feild'] = array('anh', 'list_anh');
		$input['where'] = array('id' => $id);
		$chua = $this->Chua_model->get_row($input);
		
		//Xóa ảnh
		$path = './upload/chua/';
		$list_anh = json_decode($chua->list_anh);

		
		$one_anh = $chua->anh;
		
		//Xóa các bình luận có liên quan đến chùa
		$this->load->model('Binhluan_model');
		$where = array('id_chua' => $id);

		$this->Binhluan_model->del_rule($where);
	 	
		if($this->Chua_model->delete($id)){
			//Xoa list_anh
			if(!empty($list_anh)){
				foreach ($list_anh as $anh) {
					if($anh != ''){
						if(file_exists($path.$anh)){
							unlink($path.$anh);
						}
					}
				}
			}

			//Xoa anh dai dien
			if(!empty($one_anh)){
				if($one_anh != '' && $one_anh != 'no-image.png'){
					if(file_exists($path.$one_anh)){
						unlink($path.$one_anh);
					}
				}
			}

			$this->session->set_flashdata('message', 'Xóa thành công!');
			redirect(admin_url('chua'),'refresh');
		}else {
			$this->session->set_flashdata('message', 'Xóa thất bại!');
			redirect(admin_url('chua'),'refresh');
		}
	}

}

/* End of file Chua.php */
/* Location: ./application/controllers/Chua.php */