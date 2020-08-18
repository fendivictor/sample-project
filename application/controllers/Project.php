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
		
		$header = [];
		$username = $this->session->userdata('username');

		$privilege = $this->Main_Model->view_data('tb_privilege', ['id_menu' => $page->id_menu, 'username' => $username], false);

		$body = [
			'content' => 'project/list',
			'title' => lang('menu_project_list'),
			'privilege' => $privilege
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

		$header = [];

		$body = [
			'content' => 'project/add',
			'title' => lang('menu_add_project')
		];

		$footer = [
			'js' => ['assets/js/apps/project/add.js']
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