<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_Model');
	}

	public function index()
	{	
		$header = [];
		$username = $this->session->userdata('username');

		$header = [
			'title' => lang('menu_notification')
		];

		$body = [
			'content' => 'notification/index',
			'title' => lang('menu_notification')
		];

		$footer = [
			'js' => ['assets/js/apps/notification/index.js']
		];

		$this->template($header, $body, $footer);
	}

}

/* End of file Notification.php */
/* Location: ./application/controllers/Notification.php */ ?>