<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phanhoi_model extends MY_Model {

	var $table = 'phan_hoi';

	var $order = array('trang_thai', 'desc');

	public function __construct()
	{
		parent::__construct();
		
	}

}

/* End of file Phanhoi_model.php */
/* Location: ./application/models/Phanhoi_model.php */