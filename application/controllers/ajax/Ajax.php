<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (! $this->input->is_ajax_request()) {
			show_404();
		}

		$this->load->model(['Login_model', 'Main_Model', 'Project_Model', 'User_Model']);
		$islogin = $this->Login_model->is_login();
		if ($islogin == FALSE) {
			redirect(base_url());
		}

		$this->load->library('form_validation');
	}

	public function add_project()
	{
		$type = $this->input->post('type', TRUE);
		$brand = $this->input->post('brand', TRUE);
		$kontrak = $this->input->post('kontrak', TRUE);
		$item = $this->input->post('item', TRUE);
		$style = $this->input->post('style', TRUE);
		$no_pattern = $this->input->post('no-pattern', TRUE);
		$order_type = $this->input->post('order-type', TRUE);
		$size = $this->input->post('size', TRUE);
		$qty = $this->input->post('qty', TRUE);
		$price = $this->input->post('price', TRUE);
		// $tec_plan_kirim = $this->input->post('tec-plan-kirim', TRUE);
		// $pattern_plan_kirim = $this->input->post('pattern-plan-kirim', TRUE);
		// $fabric_plan_kirim = $this->input->post('fabric-plan-kirim', TRUE);
		// $aksesories_plan_kirim = $this->input->post('aksesories-plan-kirim', TRUE);
		$due_date = $this->input->post('due-date', TRUE);
		$tujuan_sample = $this->input->post('tujuan-sample', TRUE);
		$username = $this->session->userdata('username');
		$now = $this->Main_Model->get_time('%Y-%m-%d %H:%i:%s');

		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('brand', 'Brand', 'required');
		$this->form_validation->set_rules('kontrak', 'Kontrak', 'required');
		$this->form_validation->set_rules('item', 'Item', 'required');
		$this->form_validation->set_rules('style', 'Style', 'required');
		$this->form_validation->set_rules('no-pattern', 'No Pattern', 'required');
		$this->form_validation->set_rules('order-type', 'Order Type', 'required');
		$this->form_validation->set_rules('size', 'Size', 'required');
		$this->form_validation->set_rules('qty', 'Qty', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		// $this->form_validation->set_rules('tec-plan-kirim', 'Tec Plan Kirim', 'required');
		// $this->form_validation->set_rules('pattern-plan-kirim', 'Pattern Plan Kirim', 'required');
		// $this->form_validation->set_rules('fabric-plan-kirim', 'Fabric Plan Kirim', 'required');
		// $this->form_validation->set_rules('aksesories-plan-kirim', 'Aksesories Plan Kirim', 'required');
		$this->form_validation->set_rules('due-date', 'Due Date', 'required');
		$this->form_validation->set_rules('tujuan-sample', 'Tujuan Sample', 'required');

		if ($this->form_validation->run()) {
			// $tec_plan_kirim = custom_date_format($tec_plan_kirim, 'd/m/Y', 'Y-m-d');
			// $pattern_plan_kirim = custom_date_format($pattern_plan_kirim, 'd/m/Y', 'Y-m-d');
			// $fabric_plan_kirim = custom_date_format($fabric_plan_kirim, 'd/m/Y', 'Y-m-d');
			// $aksesories_plan_kirim = custom_date_format($aksesories_plan_kirim, 'd/m/Y', 'Y-m-d');
			$due_date = custom_date_format($due_date, 'd/m/Y', 'Y-m-d');

			$data = [
				'type' => $type,
				'brand' => $brand,
				'kontrak' => $kontrak,
				'item' => $item,
				'style' => $style,
				'no_pattern' => $no_pattern,
				'order' => $order_type,
				'size' => $size,
				'qty' => $qty,
				'price' => $price,
				// 'tec_sheet_plan' => $tec_plan_kirim,
				// 'pattern_plan' => $pattern_plan_kirim,
				// 'fabric_plan' => $fabric_plan_kirim,
				// 'aksesories_plan' => $aksesories_plan_kirim,
				'due_date' => $due_date,
				'tujuan_sample' => $tujuan_sample,
				'insert_at' => $now,
				'user_insert' => $username
			];

			$simpan = $this->Project_Model->add_project($data);

			$status = 0;
			$message = lang('ajax_msg_save_fail');

			if ($simpan) {
				$status = 1;
				$message = lang('ajax_msg_save_success');
			}
		} else {
			$status = 0;
			$message = validation_errors();
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function get_action_details()
	{
		$action = $this->input->get('action', TRUE);

		$data = $this->Main_Model->view_data('ms_action', ['action_type' => $action, 'status' => 1], false);

		echo json_encode($data);
	}

	public function update_project()
	{
		$id = $this->input->post('id', TRUE);
		$action = $this->input->post('action', TRUE);
		$value = $this->input->post('value', TRUE);
		$note = $this->input->post('note', TRUE);
		$uploaded = $this->input->post('uploaded', TRUE);

		$update = $this->Project_Model->update_project([
			'id' => $id,
			'action' => $action,
			'value' => $value,
			'note' => $note,
			'upload' => $uploaded
		]);

		echo json_encode($update);
	}

	public function upload_attachment()
	{
        $timestamp = date('YmdHis');
        $path = './assets/uploads/attachment/'.$timestamp.'/';
        $token = $this->input->post('token');
        $nama = '';

        if (! file_exists($path)) {
        	mkdir($path, 0777, true);
        }

		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('userfile')){
        	$nama = $this->upload->data('file_name');
        }

        $result = [
        	'token' => $token,
        	'folder' => $timestamp,
        	'file_name' => $nama
        ];

        echo json_encode($result);
	}

	public function delete_attachment()
	{
		$folder = $this->input->get('folder', TRUE);
		$file_name = $this->input->get('file_name', TRUE);

		$status = 0;
		$message = 'File Not Deleted';

		if (file_exists(FCPATH.'/assets/uploads/attachment/'.$folder.'/'.$file_name)) {
			unlink(FCPATH.'/assets/uploads/attachment/'.$folder.'/'.$file_name);

			$status = 1;
			$message = 'File Deleted';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function get_privilege()
	{
		$username = $this->input->get('username', TRUE);
		$response = [];
		$dt_table = [];

		$data = $this->User_Model->menu_privilege($username);

		if ($data) {
			foreach ($data as $row) {
				$checked = ($row->checked == 1) ? '<input type="checkbox" id="checkbox-'.$row->id.'" name="tools-checkbox" data-tools="'.$row->tools.'" checked>' : '<input type="checkbox" id="checkbox-'.$row->id.'" name="tools-checkbox" data-tools="'.$row->tools.'">';

				$dt_table[] = [
					'check' => $checked,
					'menu' => lang($row->label),
					'tools' => lang($row->tools)
				];
			}
		}

		$response['data'] = $dt_table;

		echo json_encode($response);
	}

	public function add_privilege()
	{
		$username = $this->input->post('username', TRUE);
		$privilege = $this->input->post('privilege', TRUE);

		$status = 0;
		$message = 'Username tidak ditemukan';

		if ($username != '') {
			$data_details = [];
			if ($privilege) {
				for ($i = 0; $i < count($privilege); $i++) {
					$check_prv = $this->Main_Model->view_data('tb_menu_setting', ['tools' => $privilege[$i]], false);
					if ($check_prv) {
						$data_details[] = [
							'id_menu' => $check_prv->id_menu,
							'username' => $username,
							'tools' => $privilege[$i],
							'status' => 1,
							'user_insert' => $this->session->userdata('username')
						];
					}
				}
			}

			$simpan = $this->User_Model->add_privilege($data_details, $username);
			$message = 'Terjadi kesalahan saat menyimpan data';

			if ($simpan) {
				$status = 1;
				$message = 'Data berhasil disimpan';
			}
		}	

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function finish()
	{
		$id = $this->input->post('id', TRUE);
		$date = $this->Main_Model->get_time('%Y-%m-%d');
		$now = $this->Main_Model->get_time('%Y-%m-%d %H:%i:%s');
		$username = $this->session->userdata('username');

		$update = $this->Main_Model->store_data('project_h', ['finish' => $date, 'update_at' => $now, 'user_update' => $username], ['id' => $id]);

		$status = 0;
		$message = lang('ajax_msg_save_fail');

		if ($update) {
			$status = 1;
			$message = lang('ajax_msg_save_success');
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function counter_dashboard()
	{
		$type = $this->input->get('type', TRUE);

		$jumlah = $this->Project_Model->dashboard_counter($type);

		echo json_encode(['jumlah' => $jumlah]);
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */ ?>