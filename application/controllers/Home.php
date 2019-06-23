<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	private $limit = 8;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Chua_model');
		$this->load->model('Tinh_model');
		$this->load->model('Binhluan_model');
		$this->load->model('Danhmuc_model');
	}

	public function index()
	{	
		$_5chua = $this->selectchuacoluotviewcao();
		
		//id bỏ qua, không select
		$id_not_in_arr = array('0');
		// foreach ($_5chua as $row) {
		// 	$id_not_in_arr[] = $row->id;
		// }


		$input_total['where_not_in'] = array('id', $id_not_in_arr);
		$total_rows = $this->Chua_model->get_total($input_total);
		$this->data['total_rows'] = $total_rows;

		$this->load->library('pagination');
		
		$config['base_url'] = base_url('home/index');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '<i class="fa fa-arrow-right fa-1x" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-arrow-left fa-1x" aria-hidden="true"></i>';
		
		$this->pagination->initialize($config);
		$uri = intval($this->uri->segment(3));

		
		$this->data['chuas'] = $this->select_ds_chua($uri, $id_not_in_arr);
		
		$this->data['chua_tieu_bieu'] = $_5chua[0];
		unset($_5chua[0]);
		$this->data['chua_view_cao'] = $_5chua;
		

		$this->data['message'] = $this->session->flashdata('message');
		
		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/main',$this->data); 
	}
	function error404(){
		redirect(base_url());
	}
	private function selectchuacoluotviewcao(){
		$input['order'] = array('view','DESC');
		$input['limit'] = array(5, 0);
		$input['join'] = array('province','chua.id_tinh' ,'province.provinceid');
		$_5chua = $this->Chua_model->get_list($input);
		foreach ($_5chua as $row) {
			$where_comment['where'] = array('id_chua' => $row->id);
			$count = $this->Binhluan_model->get_total($where_comment);
			$row->tong_binh_luan = $count;
		}

		return $_5chua;
	}
	private function select_ds_chua($uri = 0, $id_not_in =array()){
		$input['where_not_in'] = array('id', $id_not_in);
		// $uri = (!empty($uri)) ? $uri : 0;
		$input['limit'] = array($this->limit, $uri);
		$input['order'] = array('ngay_tao','DESC');
		$input['join'] = array('province','chua.id_tinh' ,'province.provinceid');
		$chuas = $this->Chua_model->get_list($input);
		foreach ($chuas as $row) {
			$where_comment['where'] = array('id_chua' => $row->id);
			$count = $this->Binhluan_model->get_total($where_comment);
			$row->tong_binh_luan = $count;
		}

		return $chuas;
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */