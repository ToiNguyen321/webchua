<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Binhluan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Binhluan_model');
	}

	private function index()
	{


		$sql = "SELECT binh_luan.id, binh_luan.id_chua, chua.ten AS ten_chua, binh_luan.id_tai_khoan, binh_luan.noi_dung, binh_luan.ngay_binh_luan, binh_luan.trang_thai, tai_khoan.ten_nguoi_dung, trang_thai.ten_trang_thai FROM `binh_luan` INNER JOIN tai_khoan ON binh_luan.id_tai_khoan = tai_khoan.id INNER JOIN chua ON binh_luan.id_chua = chua.id INNER JOIN trang_thai ON binh_luan.trang_thai = trang_thai.id_trang_thai";
		$binh_luan = $this->Binhluan_model->query($sql);

		$this->data['binh_luan'] = $binh_luan;
		$this->data['temp'] = 'admin/home/index';
		$this->load->view('admin/main', $this->data, FALSE);
	}

}

/* End of file Binhluan.php */
/* Location: ./application/controllers/Binhluan.php */