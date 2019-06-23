<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phuong_model extends MY_Model {

	var $table = 'ward';
	var $key = 'wardid';
	var $order = array('wardid', 'ASC');

	public function __construct()
	{
		parent::__construct();
		
	}

}

/* End of file Phuong_model.php */
/* Location: ./application/models/Phuong_model.php */