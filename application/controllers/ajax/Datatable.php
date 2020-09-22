<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Project_Model', 'Notification_Model']);
	}

	public function dt_project()
	{
		$keyword = $this->input->get('keyword', TRUE);
		$draw = $this->input->post('draw', TRUE);
		$order = $this->input->post('order', TRUE);
		$order_columns = isset($order[0]['column']) ? $order[0]['column'] : '';
		$order_mode = isset($order[0]['dir']) ? $order[0]['dir'] : '';
		$start = $this->input->post('start', TRUE);
		$length = $this->input->post('length', TRUE);
		$search = $this->input->post('search', TRUE);
		$search_value = isset($search['value']) ? $search['value'] : '';

		$data = $this->Project_Model->dt_project([
			'draw' => $draw,
			'order_column' => $order_columns,
			'order_mode' => $order_mode,
			'start' => $start,
			'length' => $length,
			'search' => $keyword
		]);

		echo json_encode($data);
	}

	public function dt_project_non_serverside()
	{
		$keyword = $this->input->get('keyword', TRUE);

		$data = $this->Project_Model->dt_project_non_serverside($keyword);

		echo json_encode($data);
	}

	public function dt_delivery()
	{
		$bulan = $this->input->get('bulan', TRUE);
		$tahun = $this->input->get('tahun', TRUE);

		$data = $this->Project_Model->dt_delivery($bulan, $tahun);

		echo json_encode($data);
	}

	public function dt_history()
	{
		$keyword = $this->input->get('keyword', TRUE);
		$draw = $this->input->post('draw', TRUE);
		$order = $this->input->post('order', TRUE);
		$order_columns = isset($order[0]['column']) ? $order[0]['column'] : '';
		$order_mode = isset($order[0]['dir']) ? $order[0]['dir'] : '';
		$start = $this->input->post('start', TRUE);
		$length = $this->input->post('length', TRUE);
		$search = $this->input->post('search', TRUE);
		$search_value = isset($search['value']) ? $search['value'] : '';

		$data = $this->Project_Model->dt_history([
			'draw' => $draw,
			'order_column' => $order_columns,
			'order_mode' => $order_mode,
			'start' => $start,
			'length' => $length,
			'search' => $keyword
		]);

		echo json_encode($data);
	}

	public function dashboard_list()
	{
		$draw = $this->input->post('draw', TRUE);
		$order = $this->input->post('order', TRUE);
		$order_columns = isset($order[0]['column']) ? $order[0]['column'] : '';
		$order_mode = isset($order[0]['dir']) ? $order[0]['dir'] : '';
		$start = $this->input->post('start', TRUE);
		$length = $this->input->post('length', TRUE);
		$search = $this->input->post('search', TRUE);
		$search_value = isset($search['value']) ? $search['value'] : '';
		$type = $this->input->get('type', TRUE);


		$data = $this->Project_Model->dashboard_list($type, [
			'draw' => $draw,
			'order_column' => $order_columns,
			'order_mode' => $order_mode,
			'start' => $start,
			'length' => $length,
			'search' => $search_value
		]);

		echo json_encode($data);
	}

	public function dt_notification()
	{
		$keyword = $this->input->get('keyword', TRUE);
		$draw = $this->input->post('draw', TRUE);
		$order = $this->input->post('order', TRUE);
		$order_columns = isset($order[0]['column']) ? $order[0]['column'] : '';
		$order_mode = isset($order[0]['dir']) ? $order[0]['dir'] : '';
		$start = $this->input->post('start', TRUE);
		$length = $this->input->post('length', TRUE);
		$search = $this->input->post('search', TRUE);
		$search_value = isset($search['value']) ? $search['value'] : '';
		$username = $this->session->userdata('username');

		$data = $this->Notification_Model->dt_notification([
			'draw' => $draw,
			'order_column' => $order_columns,
			'order_mode' => $order_mode,
			'start' => $start,
			'length' => $length,
			'search' => $keyword,
			'username' => $username
		]);

		echo json_encode($data);
	}

	public function dt_summary()
	{
		$bulan = $this->input->get('bulan', TRUE);
		$tahun = $this->input->get('tahun', TRUE);
		$line = $this->input->get('line', TRUE);

		if (strlen($bulan) == 1) {
			$bulan = '0'.$bulan;
		}

		$data = $this->Project_Model->dt_summary($bulan, $tahun, $line);

		$dt_table = [];
		$response = [];

		if ($data) {
			foreach ($data as $row) {
				$dt_table[] = [
					'no' => $row->id,
					'type' => $row->type,
					'brand' => $row->brand,
					'kontrak' => $row->kontrak,
					'item' => $row->item,
					'style' => $row->style, 
					'line' => $row->line,
					'qty' => $row->qty,
					'due_date' => custom_date_format($row->due_date, 'Y-m-d', 'd/m/Y'),
					'actual_finish' => custom_date_format($row->kirim_actual, 'Y-m-d', 'd/m/Y'),
					'finish' => custom_date_format($row->finish, 'Y-m-d', 'd/m/Y')
				];
			}
		}

		$response['data'] = $dt_table;

		echo json_encode($response);
 	}
}

/* End of file Datatable.php */
/* Location: ./application/controllers/Datatable.php */ ?>