<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_Model');
		$this->load->model('Project_Model');
	}

	public function list()
	{
		$page = $this->Login_model->isvalid_page();
		if ($page == false) {
			show_404();
		}

		$isMobile = 0;
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect;
		if($detect->isMobile()) {
			$isMobile = 1;
		}
		
		$header = [];
		$username = $this->session->userdata('username');

		$privilege = $this->Main_Model->view_data('tb_privilege', ['id_menu' => $page->id_menu, 'username' => $username], false);

		$body = [
			'content' => 'project/list',
			'title' => lang('menu_project_list'),
			'privilege' => $privilege,
			'mobile' => $isMobile
		];

		$footer = [
			'js' => ['assets/js/apps/project/list.js']
		];

		$this->template($header, $body, $footer);
	}

	public function history()
	{
		$page = $this->Login_model->isvalid_page();
		if ($page == false) {
			show_404();
		}
		
		$header = [];
		$username = $this->session->userdata('username');

		$body = [
			'content' => 'project/history',
			'title' => lang('menu_history')
		];

		$footer = [
			'js' => ['assets/js/apps/project/history.js']
		];

		$this->template($header, $body, $footer);
	}

	public function add()
	{
		$page = $this->Login_model->isvalid_page();
		if ($page == false) {
			show_404();
		}

		$action = $this->input->get('action', TRUE);
		$id = $this->input->get('id', TRUE);

		$data_id = $this->Main_Model->view_data('project_h', ['id' => $id], false);

		$opt_jenis = [
			'LADIES' => 'LADIES',
			'MENS' => 'MENS'
		];

		$opt_item = [
			'JK' => 'JK',
			'PNT' => 'PNT',
			'SK' => 'SK',
			'2P' => '2P',
			'2PP' => '2PP',
			'3P' => '3P',
			'PNT ONLY' => 'PNT ONLY',
			'JK ONLY' => 'JK ONLY'
		];

		$opt_order = [
			'NEW' => 'NEW',
			'REPEAT' => 'REPEAT'
		];

		$header = [];

		$body = [
			'content' => 'project/add',
			'title' => lang('menu_add_project'),
			'data' => $data_id,
			'opt_jenis' => $opt_jenis,
			'opt_item' => $opt_item,
			'opt_order' => $opt_order,
			'id' => ($action == 'edit') ? $id : ''
		];

		$footer = [
			'js' => ['assets/js/apps/project/add.js'],
			'ext' => '
				<script>
					const actionMode = "'.$action.'";
					const idData = "'.$id.'";
				</script>
			'
		];

		$this->template($header, $body, $footer);
	}

	public function detail()
	{
		$id = $this->input->get('id', TRUE);

		$header = [
			'title' => lang('menu_sample_detail')
		];

		$project_h = $this->Project_Model->project_header($id);
		$group_date = $this->Project_Model->grouping_date_header($id);

		$body = [
			'content' => 'project/detail',
			'title' => lang('menu_sample_detail'),
			'header' => $project_h,
			'group_date' => $group_date,
			'id_project' => $id
		];

		$footer = [
			'js' => ['assets/js/apps/project/detail.js']
		];

		$this->template($header, $body, $footer);
	}
}

/* End of file Project.php */
/* Location: ./application/controllers/Project.php */ ?>