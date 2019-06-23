<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tinh_model extends MY_Model {

	var $table = 'province';
	var $key = 'provinceid';
	var $order = array('provinceid', 'ASC');

	public function __construct()
	{
		parent::__construct();
		
	}

}

/* End of file Tinh_model.php */
/* Location: ./application/models/Tinh_model.php */