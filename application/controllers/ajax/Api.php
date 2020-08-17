<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_Model');
	}

	public function index()
	{
		show_404();
	}

	public function view_data()
	{	
		$criteria = '';

		$condition = $this->input->post('condition', TRUE);
		$collection = $this->input->post('collection', TRUE);
		$multiple = $this->input->post('multiple', TRUE);

		if ($condition) {
			for ($i = 0; $i < count($condition); $i++) {
				$criteria .= $condition[$i];
			}
		}

		$result = $this->Main_Model->view_data($collection, $criteria, $multiple);

		echo json_encode($result);
	}
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */ ?>