<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$controllers = $this->uri->segment(1);
		switch ($controllers) {
			case 'admin':
			$this->load->helper('admin');
			$this->check_login_admin();
			break;
			
			default:
				// code...
			$this->check_login_nguoi_dung();
			$this->capnhatview();
			$this->data['danhmucs'] = $this->load_danh_muc();
			$this->data['tinhs'] = $this->load_tinh();
			$this->data['sukiens'] = $this->load_su_kien();
			$this->data['su_kien_hom_nay'] = $this->su_kien_hom_nay();
			$this->data['su_kien_gan_nhat'] = $this->su_kien_gan_nhat();
			$this->data['hai_binh_luan_ngau_nhien'] = $this->hai_binh_luan_ngau_nhien();
			break;
		}
		
	}

	private function capnhatview(){
		$this->load->model('Website_model');
		$id =  1;
		$view = $this->Website_model->get_info($id, 'thong_tin');
		$view = json_decode($view->thong_tin);
		$view_web = $view[1] + 1;
		$view_cap_nhat = array($view[0], $view_web);
		$view_cap_nhat = json_encode($view_cap_nhat);
		$input = array(
			'thong_tin' => $view_cap_nhat
		);
		$this->Website_model->update($id, $input);
	}

	private function su_kien_hom_nay(){
		$this->load->model('Sukien_model');
		$date_now = date('Y-m-d');
		$input['limit'] = array(1,0);
		$input['where'] = array('ngay_dien_ra' => $date_now);
		$su_kien_hom_nay = $this->Sukien_model->get_row($input);

		return $su_kien_hom_nay;
	}

	private function su_kien_gan_nhat(){
		$this->load->model('Sukien_model');
		$date_now = date('Y-m-d');
		$input['order'] = array('ngay_dien_ra','ASC');
		$input['limit'] = array(3,0);
		$input['where'] = array('ngay_dien_ra >' => $date_now);
		$su_kien_gan_nhat = $this->Sukien_model->get_list($input);
		
		return $su_kien_gan_nhat;
	}


	private function load_tinh(){
		$this->load->model('Tinh_model');
		$tinhs = $this->Tinh_model->get_list();
		return $tinhs;
	}

	private function load_danh_muc(){
		$this->load->model('Danhmuc_model');
		$input = array();
		$input['where'] = array('parent_id' => 0, 'id !=' => '1');
		$danhmucs = $this->Danhmuc_model->get_list($input);
		foreach ($danhmucs as $row) {
			$input['where'] = array( 'parent_id' => $row->id);
			$sub = $this->Danhmuc_model->get_list($input);
			$row->subs = $sub;
		}
		return $danhmucs;
	}

	private function load_su_kien(){
		$this->load->model('Sukien_model');
		$su_kiens = $this->Sukien_model->get_list();
		return $su_kiens;
	}

	private function check_login_admin(){
		$controllers = $this->uri->segment(2);
		$controllers = strtolower($controllers);
		$login = $this->session->userdata('login');
		if(!$login && $controllers != 'login'){
			redirect(admin_url('login'),'refresh');
		}
		if($login && $controllers == 'login'){
			redirect(admin_url(),'refresh');
		}
	}
	private function check_login_nguoi_dung(){
		$controllers = $this->uri->segment(2);
		$controllers = strtolower($controllers);
		$nguoi_dung = $this->session->userdata('nguoi_dung');
		if(!empty($nguoi_dung)){
			$this->data['nguoi_dung'] = $this->session->userdata('nguoi_dung');
			if ($controllers == 'dangnhap' || $controllers == 'dangky') {
				redirect(base_url());
			}
		}
	}

	private function hai_binh_luan_ngau_nhien(){
		$this->load->model('Binhluan_model');

		$sql = "SELECT binh_luan.id, binh_luan.id_chua, binh_luan.id_tai_khoan, binh_luan.noi_dung, binh_luan.ngay_binh_luan, binh_luan.trang_thai, tai_khoan.ten_nguoi_dung FROM `binh_luan` INNER JOIN tai_khoan ON binh_luan.id_tai_khoan = tai_khoan.id WHERE binh_luan.trang_thai = 8 ORDER BY rand() limit 2";
		$hai_binh_luan_ngau_nhien = $this->Binhluan_model->query($sql);
		return $hai_binh_luan_ngau_nhien;
	}

}

/* End of file My_Controller.php */
/* Location: ./application/controllers/My_Controller.php */