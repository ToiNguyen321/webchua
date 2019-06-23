<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quan_model extends MY_Model {

	var $table = 'district';
	var $key = 'districtid';
	var $order = array('districtid', 'ASC');

	public function __construct()
	{
		parent::__construct();
		
	}

}

/* End of file Quan_model.php */
/* Location: ./application/models/Quan_model.php */