<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sukien extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function view()
	{
		$id = $this->uri->segment(3);
		echo $id;
		if(!is_numeric($id)){
			redirect(base_url(),'refresh');
		}
	}

}

/* End of file Sukien.php */
/* Location: ./application/controllers/Sukien.php */