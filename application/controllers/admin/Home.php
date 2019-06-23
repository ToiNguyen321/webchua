<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Binhluan_model');
		$this->load->model('Website_model');
	}

	public function index()
	{

		$limit = 5;
		$total_rows = $this->Binhluan_model->get_total();
		$this->load->library('pagination');
		
		$config['base_url'] = admin_url('home/index');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';

		
		$this->pagination->initialize($config);
		
		$uri = intval($this->uri->segment(4));

		$sql = "SELECT binh_luan.id, binh_luan.id_chua, chua.ten AS ten_chua, binh_luan.id_tai_khoan, binh_luan.noi_dung, binh_luan.ngay_binh_luan, binh_luan.trang_thai, tai_khoan.ten_nguoi_dung, trang_thai.ten_trang_thai FROM `binh_luan` INNER JOIN tai_khoan ON binh_luan.id_tai_khoan = tai_khoan.id INNER JOIN chua ON binh_luan.id_chua = chua.id INNER JOIN trang_thai ON binh_luan.trang_thai = trang_thai.id_trang_thai limit $uri,$limit";

		$binh_luan = $this->Binhluan_model->query($sql);
		// pre($binh_luan);
		$this->data['binh_luan'] = $binh_luan;
		$this->data['tong_view'] = $this->select_view();
		$this->data['tong_chua'] = $this->select_tong_chua();
		$this->data['tong_phan_hoi'] = $this->select_tong_phan_hoi();
		$this->data['tong_thanh_vien'] = $this->select_tong_thanh_vien();
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['temp'] = 'admin/home/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}
	function duyet(){
		//Trạng thái  == 8 là duyệt
		$id_binh_luan = $this->uri->segment(4);
		if(empty($id_binh_luan) || !is_numeric($id_binh_luan)){
			$this->session->set_flashdata('message', 'Truy cập lỗi!');
			redirect(admin_url(),'refresh');
		}
		$input = array(
			'trang_thai' => 8
		);
		if ($this->Binhluan_model->update($id_binh_luan, $input)) {
			$this->session->set_flashdata('message', 'Thay đổi trạng thái bình luận thành công!');
		}else{
			$this->session->set_flashdata('message', 'Thay đổi trạng thái bình luận không thành công!');
		}
		redirect(admin_url(),'refresh');
	}

	function spam(){
		//Trạng thái  == 4 là bình luận spam
		$id_binh_luan = $this->uri->segment(4);
		if(empty($id_binh_luan) || !is_numeric($id_binh_luan)){
			$this->session->set_flashdata('message', 'Truy cập lỗi!');
			redirect(admin_url(),'refresh');
		}
		$input = array(
			'trang_thai' => 4
		);
		if ($this->Binhluan_model->update($id_binh_luan, $input)) {
			$this->session->set_flashdata('message', 'Đánh dầu bình luận spam thành công!');
		}else{
			$this->session->set_flashdata('message', 'Đánh dầu bình luận spam không thành công!');
		}
		redirect(admin_url(),'refresh');
	}
	private function select_view(){
		$this->load->model('Website_model');
		$id =  1;
		$view = $this->Website_model->get_info($id, 'thong_tin');
		$view = json_decode($view->thong_tin);
		$view_web = $view[1];
		return $view_web;
	}
	private function select_tong_chua(){
		$this->load->model('Chua_model');
		$tong_chua = $this->Chua_model->get_total();
		return $tong_chua;
	}
	private function select_tong_thanh_vien(){
		$this->load->model('Taikhoan_model');
		$input['where'] = array(
			'quyen' => 3
		);
		$tong_thanh_vien = $this->Taikhoan_model->get_total($input);
		return $tong_thanh_vien;
	}
	private function select_tong_phan_hoi(){
		$this->load->model('Phanhoi_model');
		$tong_phan_hoi = $this->Phanhoi_model->get_total();
		return $tong_phan_hoi;
	}
	function error404(){
		redirect(base_url('admin'));
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */