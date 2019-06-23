<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chua extends MY_Controller {
	private $limit = 9;
	private $num_links = 5;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Chua_model');
		$this->load->model('Tinh_model');
		$this->load->model('Binhluan_model');
		$this->load->model('Danhmuc_model');
		$this->load->library('pagination');
	}

	function tinh(){
		$id_tinh = $this->uri->segment(3);
		if(empty($id_tinh)){
			redirect(base_url(),'refresh');
		}
		// pre($id_tinh);
		$input_tinh['where'] = array('provinceid' => $id_tinh);
		$input_tinh['feild'] = array('name', 'type');
		$tinh =  $this->Tinh_model->get_row($input_tinh);
		
		$input['where'] = array('id_tinh' => $id_tinh);
		
		$total_rows = $this->Chua_model->get_total($input);
		

		$config['base_url'] = base_url('chua/tinh/').$id_tinh;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = $this->num_links;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '<i class="fa fa-arrow-right fa-1x" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-arrow-left fa-1x" aria-hidden="true"></i>';

		$this->pagination->initialize($config);
		$uri = intval($this->uri->segment(4));
		// $input['limit'] = array($this->limit, $uri);
		// $input['join'] = array('province','chua.id_tinh' ,'province.provinceid');
		// $chuas = $this->Chua_model->get_list($input);
		$sql = "SELECT chua.id, chua.ten, `so_nha`, `tieu_de`, `nguoi_chu_tri`, `view`,`anh`, province.provinceid, ward.name AS phuong, ward.type AS type_phuong, district.name AS quan, district.type AS type_quan, province.name AS tinh, province.type AS type_tinh 
			FROM `chua` 
			INNER JOIN ward on chua.id_phuong = ward.wardid 
			INNER JOIN district on chua.id_quan = district.districtid 
			INNER JOIN province on chua.id_tinh = province.provinceid  
			WHERE id_tinh = $id_tinh limit $uri,$this->limit";
		$chuas = $this->Chua_model->query($sql);

		foreach ($chuas as $row) {
			$where_comment['where'] = array('id_chua' => $row->id);
			$count = $this->Binhluan_model->get_total($where_comment);
			$row->tong_binh_luan = $count;

			if(!empty($row->so_nha)){
				$row->dia_chi = $row->so_nha . ', ' . $row->type_phuong . ' ' . $row->phuong. ', ' . $row->type_quan . ' ' . $row->quan. ', ' .$row->type_tinh. ' ' .$row->tinh;
			}else{
				$row->dia_chi = $row->type_phuong . ' ' . $row->phuong. ', ' . $row->type_quan . ' ' . $row->quan. ', ' .$row->type_tinh. ' ' .$row->tinh;
			}
		}

		$this->data['chuas'] =  $chuas;
		if ($chuas) {
			$this->data['title'] =  'Danh sách chùa trong '.$tinh->type . ' ' .$tinh->name;
		}
		
		$this->data['temp'] = 'site/chua/index';
		$this->load->view('site/main',$this->data, FALSE); 
	}

	function danhmuc(){
		$id_danh_muc = $this->uri->segment(3);
		if(empty($id_danh_muc)){
			redirect(base_url(),'refresh');
		}
		// pre($id_tinh);
		$input_danh_muc['where'] = array('id' => $id_danh_muc);
		$input_danh_muc['feild'] = array('ten');
		$danh_muc =  $this->Danhmuc_model->get_row($input_danh_muc);
		
		$input['where'] = array('id_danh_muc' => $id_danh_muc);
		
		$total_rows = $this->Chua_model->get_total($input);
		

		$config['base_url'] = base_url('chua/danhmuc/').$id_danh_muc;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = $this->num_links;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '<i class="fa fa-arrow-right fa-1x" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-arrow-left fa-1x" aria-hidden="true"></i>';

		$this->pagination->initialize($config);
		$uri = intval($this->uri->segment(4));
		$input['limit'] = array($this->limit, $uri);
		$input['join'] = array('province','chua.id_tinh' ,'province.provinceid');
		$chuas = $this->Chua_model->get_list($input);

		foreach ($chuas as $row) {
			$where_comment['where'] = array('id_chua' => $row->id);
			$count = $this->Binhluan_model->get_total($where_comment);
			$row->tong_binh_luan = $count;
		}
		
		$this->data['chuas'] =  $chuas;
		if ($chuas) {
			$this->data['title'] =  'Danh sách chùa '.$danh_muc->ten;
		}
		
		$this->data['temp'] = 'site/chua/index';
		$this->load->view('site/main',$this->data, FALSE); 
	}
	private function select_random_2_chua($id_chua = 0, $provinceid =0 , $id_danh_muc = 0){

	 	//SELECT 2 chùa có liên quan. Khác id chùa đang view và có id_tinh or id_danh_muc giống.


		$sql = "SELECT chua.id, chua.ten, `tieu_de`, `nguoi_chu_tri`, `view`, `anh`, province.provinceid, province.name , province.type FROM `chua` INNER JOIN province on chua.id_tinh = province.provinceid WHERE chua.id NOT IN ($id_chua) AND (id_tinh = $provinceid OR id_danh_muc = $id_danh_muc) ORDER BY RAND() limit 2";
		$hai_chua_co_lien_quan = $this->Chua_model->query($sql);
		foreach ($hai_chua_co_lien_quan as $row) {
			$where_comment['where'] = array('id_chua' => $row->id);
			$count = $this->Binhluan_model->get_total($where_comment);
			$row->tong_binh_luan = $count;
		}
		return $hai_chua_co_lien_quan;
		
	}
	function view(){


		/**************/
		$id_chua = $this->uri->segment(3);
		if(empty($id_chua)){
			redirect(base_url(),'refresh');
		}

		$sql = "SELECT chua.id, chua.ten, id_danh_muc, `so_nha`, `tieu_de`, `nguoi_chu_tri`, `view`, `mo_ta`, `nam_xay_dung`, `anh`, `list_anh`, `su_kien`, `ngay_tao`, province.provinceid, danh_muc.ten AS danh_muc, ward.name AS phuong, ward.type AS type_phuong, district.name AS quan, district.type AS type_quan, province.name AS tinh, province.type AS type_tinh FROM `chua` INNER JOIN ward on chua.id_phuong = ward.wardid INNER JOIN district on chua.id_quan = district.districtid INNER JOIN province on chua.id_tinh = province.provinceid INNER JOIN danh_muc on chua.id_danh_muc = danh_muc.id WHERE chua.id = $id_chua limit 1";
		$chuas = $this->Chua_model->query($sql);
		$chua = $chuas[0];

		$input_update = array(
			'view' => $chua->view + 1
		);
		try{
			$this->Chua_model->update($id_chua, $input_update);
		}catch(Exception $e){
			throw $e->getMessage();
		}
		if(!empty($chua->so_nha)){
			$chua->dia_chi = $chua->so_nha . ', ' . $chua->type_phuong . ' ' . $chua->phuong. ', ' . $chua->type_quan . ' ' . $chua->quan. ', ' .$chua->type_tinh. ' ' .$chua->tinh;
		}else{
			$chua->dia_chi = $chua->type_phuong . ' ' . $chua->phuong. ', ' . $chua->type_quan . ' ' . $chua->quan. ', ' .$chua->type_tinh. ' ' .$chua->tinh;
		}
		//Lấy ra danh sách sự kiện

		$su_kien = implode(',', json_decode($chua->su_kien));
		$sql_sk = "SELECT id,ten FROM `su_kien` WHERE id IN ($su_kien)";
		$su_kien = $this->Sukien_model->query($sql_sk);
		$su_kien = $su_kien;
		$this->data['su_kien'] = $su_kien;
		
		//Lấy danh sách bình luận
		$sql_binh_luan = "SELECT binh_luan.id, binh_luan.id_chua, binh_luan.id_tai_khoan, binh_luan.noi_dung, binh_luan.ngay_binh_luan, binh_luan.trang_thai, tai_khoan.ten_nguoi_dung  FROM `binh_luan` INNER JOIN tai_khoan ON binh_luan.id_tai_khoan = tai_khoan.id where id_chua = $chua->id AND binh_luan.trang_thai = 8 ORDER BY binh_luan.ngay_binh_luan DESC LIMIT 5";
		$binh_luan = $this->Binhluan_model->query($sql_binh_luan);
		$this->data['binh_luan'] = $binh_luan;

		$chua->tong_binh_luan = count($binh_luan);
		$this->data['chua'] = $chua;

		//SELECT 2 chùa có liên quan. Khác id chùa đang view và có id_tinh or id_danh_muc giống.
		$this->data['hai_chua_co_lien_quan'] = $this->select_random_2_chua($id_chua, $chua->provinceid, $chua->id_danh_muc);

		$this->data['message'] = $this->session->flashdata('message');
		$this->data['temp'] = 'site/chua/view';
		$this->load->view('site/main',$this->data, FALSE); 
	}

	function sukien(){
		$id_sk = $this->uri->segment(3);
		if(empty($id_sk)){
			redirect(base_url(),'refresh');
		}
		$input_tinh['where'] = array('id' => $id_sk);
		$input_tinh['feild'] = array('ten');
		$su_kien =  $this->Sukien_model->get_row($input_tinh);
		
		$chuas = array();
		$input['join'] = array('province','chua.id_tinh' ,'province.provinceid');
		$chua = $this->Chua_model->get_list($input);

		foreach ($chua as $row) {
			$sk_arr = json_decode($row->su_kien);
			foreach ($sk_arr as $sk) {
				// echo $sk . '<br>';
				if($id_sk == $sk){
					$chuas[] = $row;
					break;
				}
			}
		}
		$total_rows = count($chuas);
		$this->load->library('pagination');
		
		$config['base_url'] = base_url('chua/sukien/').$id_sk;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = $this->num_links;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '<i class="fa fa-arrow-right fa-1x" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-arrow-left fa-1x" aria-hidden="true"></i>';
		
		$this->pagination->initialize($config);
		$uri = intval($this->uri->segment(4));
		$chua_select = array();
		if(count($chuas) >  ($uri + $this->limit - 1)){
			$select = $uri + $this->limit;
		}else{
			$select = count($chuas);
		}
		try {
			for($i = $uri; $i < $select; $i++){
				$chua_select[] = $chuas[$i];
			}
		} catch (Exception $e) {
			
		}
		
		

		foreach ($chua_select as $row) {
			$where_comment['where'] = array('id_chua' => $row->id);
			$count = $this->Binhluan_model->get_total($where_comment);
			$row->tong_binh_luan = $count;
		}


		$this->data['chuas'] =  $chua_select;
		if ($chua_select) {
			$this->data['title'] =  'Danh sách chùa có sự kiện '.$su_kien->ten . ' (' . count($chua_select) . ')';
		}
		
		$this->data['temp'] = 'site/chua/index';
		$this->load->view('site/main',$this->data, FALSE); 

	}


	function binhluan(){

		$id_chua = $this->uri->segment(3);
		if(empty($id_chua)){
			redirect(base_url(),'refresh');
		}

		$nguoi_dung = $this->session->userdata('nguoi_dung');
		if(empty($nguoi_dung)){
			$this->session->set_flashdata('message', 'Vui lòng đăng nhập để bình luận!');
			redirect(base_url('taikhoan/dangnhap'),'refresh');
		}

		if($this->input->post()){
			$this->form_validation->set_rules('binh_luan', 'Nội dung bình luận', 'required|min_length[20]|max_length[500]');
			if ($this->form_validation->run() == TRUE) {
				$noi_dung = $this->input->post('binh_luan');
				$input = array(
					'id_chua' => $id_chua,
					'id_tai_khoan' => $nguoi_dung['id_nguoi_dung'],
					'noi_dung' => $noi_dung,
					'ngay_binh_luan' => now(),
					'trang_thai' => 8
				);

				if($this->Binhluan_model->create($input)){
					$this->session->set_flashdata('message', 'Cảm ơn bạn đã bình luận!');
				}else{
					$this->session->set_flashdata('message', 'Rất tiếc, bình luận không thành công!');
				}
			}
			$this->session->set_flashdata('message', form_error('binh_luan'));
			
		}
		redirect(base_url('chua/view/') . $id_chua,'refresh');

	}

	function search(){

		if ($this->input->post()){

			$this->form_validation->set_rules('tim_theo_loai', 'Trường tìm kiếm', 'trim|required|is_numeric');
			$this->form_validation->set_rules('tim_kiem', 'Nội dung tìm kiêm', 'trim|required|min_length[4]|max_length[50]');

			$id_phan_loai =  $this->input->post('tim_theo_loai');
			if(!is_numeric($id_phan_loai)){
				$this->session->set_flashdata('message', 'Nội dung tìm kiếm không hợp lệ!');
				redirect(base_url(),'refresh');
			}
			if ($this->form_validation->run() == TRUE) {
				# code...
				$truong_tim_kiem = '';

				switch ($id_phan_loai) {
					case 1:
						// Tìm kiếm theo tên
						$truong_tim_kiem = "chua.ten";
						break;
					case 2:
						// Tìm kiếm theo quận
						$truong_tim_kiem = "district.name";
						break;
					case 3:
						// Tìm kiếm theo phường
						$truong_tim_kiem = "ward.name";
						break;
					
					default:
						$this->session->set_flashdata('message', 'Nội dung tìm kiếm không hợp lệ!');
						redirect(base_url(),'refresh');
						break;
				}


				$noi_dung_tim_kiem =  $this->input->post('tim_kiem');
				// $noi_dung_tim_kiem = (!empty($noi_dung_tim_kiem)) ? $noi_dung_tim_kiem : $this->uri->segment(3);
				// $sql_total = "SELECT chua.id FROM `chua` INNER JOIN ward on chua.id_phuong = ward.wardid 
				// 			INNER JOIN district on chua.id_quan = district.districtid 
				// 			INNER JOIN province on chua.id_tinh = province.provinceid  
				// 			WHERE $truong_tim_kiem like '%$noi_dung_tim_kiem%'";
		
				// $query = $this->db->query($sql_total);
				// $total_rows = $query->num_rows();

				// $config['base_url'] = base_url('chua/search/');
				// $config['total_rows'] = $total_rows;
				// $config['per_page'] = $this->limit;
				// $config['uri_segment'] = 3;
				// $config['num_links'] = $this->num_links;
				// $config['first_link'] = 'First';
				// $config['last_link'] = 'Last';
				// $config['next_link'] = '<i class="fa fa-arrow-right fa-1x" aria-hidden="true"></i>';
				// $config['prev_link'] = '<i class="fa fa-arrow-left fa-1x" aria-hidden="true"></i>';

				// $this->pagination->initialize($config);
				// $uri = intval($this->uri->segment(3));
				// $noi_dung_tim_kiem = (!empty($noi_dung_tim_kiem)) ? $noi_dung_tim_kiem : $this->uri->segment(3);

				$sql = "SELECT chua.id, chua.ten, `so_nha`, `tieu_de`, `nguoi_chu_tri`, `view`,`anh`, province.provinceid, ward.name AS phuong, ward.type AS type_phuong, district.name AS quan, district.type AS type_quan, province.name AS tinh, province.type AS type_tinh FROM `chua` INNER JOIN ward on chua.id_phuong = ward.wardid 
							INNER JOIN district on chua.id_quan = district.districtid 
							INNER JOIN province on chua.id_tinh = province.provinceid  
							WHERE $truong_tim_kiem like '%$noi_dung_tim_kiem%' LIMIT $this->limit";

				$chuas = $this->Chua_model->query($sql);
				$total_rows = count($chuas);
				foreach ($chuas as $row) {
					$where_comment['where'] = array('id_chua' => $row->id);
					$count = $this->Binhluan_model->get_total($where_comment);
					$row->tong_binh_luan = $count;

					if(!empty($row->so_nha)){
						$row->dia_chi = $row->so_nha . ', ' . $row->type_phuong . ' ' . $row->phuong. ', ' . $row->type_quan . ' ' . $row->quan. ', ' .$row->type_tinh. ' ' .$row->tinh;
					}else{
						$row->dia_chi = $row->type_phuong . ' ' . $row->phuong. ', ' . $row->type_quan . ' ' . $row->quan. ', ' .$row->type_tinh. ' ' .$row->tinh;
					}
				}

				$this->data['chuas'] =  $chuas;
				if ($chuas) {
					$this->data['title'] =  'Danh sách tìm kiếm [ '. $noi_dung_tim_kiem .' ('.$total_rows.') ]';
				}
				
				$this->data['temp'] = 'site/chua/index';
				$this->load->view('site/main',$this->data, FALSE); 
			
			}else{
				$this->session->set_flashdata('message', form_error('tim_kiem'));
				redirect(base_url(),'refresh');
			}
			
		}else{
			$this->session->set_flashdata('message', 'Lỗi hệ thống!');
			redirect(base_url(),'refresh');
		}
	}

	private function test(){
		$date_now = date('Y-m-d');
		$input['limit'] = array(1,0);
		$input['where'] = array('ngay_dien_ra >' => $date_now);
		$su_kien_hom_nay = $this->Sukien_model->get_row($input);
		echo "<pre>";
		var_dump($su_kien_hom_nay);
		echo "</pre>";
	}
}

/* End of file chua.php */
/* Location: ./application/controllers/chua.php */