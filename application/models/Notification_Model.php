<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function total_unread($username)
	{
		$sql = $this->db->query("
			SELECT COUNT(a.id) AS total
			FROM log_activity a
			LEFT JOIN (
				SELECT *
				FROM tb_activity_read b
				WHERE b.`username` = '$username'
			) AS b ON a.`id` = b.id_activity
			WHERE b.id IS NULL
			ORDER BY a.`insert_at` DESC ")->row();

		return isset($sql->total) ? $sql->total : 0;
	}

	public function unread_notification($username)
	{
		return $this->db->query("
			SELECT a.*, b.insert_at AS read_at,
			IF(b.insert_at IS NULL, 0, 1) AS is_read,
			c.field, d.style, d.brand
			FROM log_activity a
			INNER JOIN ms_action c ON a.activity_type = c.action_type
			LEFT JOIN (
				SELECT *
				FROM tb_activity_read b
				WHERE b.`username` = '$username'
			) AS b ON a.`id` = b.id_activity
			INNER JOIN project_h d ON d.id = a.id_project
			WHERE b.id IS NULL
			ORDER BY a.`insert_at` DESC
			LIMIT 8 ")->result();
	}

	public function dt_notification($params)
	{
		$draw = $this->db->escape_str($params['draw']);
		$order_column = $this->db->escape_str($params['order_column']);
		$order_mode = $this->db->escape_str($params['order_mode']);
		$start = $this->db->escape_str($params['start']);
		$length = $this->db->escape_str($params['length']);
		$search = $this->db->escape_str($params['search']);
		$username = $this->db->escape_str($params['username']);

		$condition = '';
		$order = '';
		$limit = '';
		$data = [];

		$kolom_search = ['id_project', 'type', 'brand', 'kontrak', 'item', 'style', 'field', 'value', 'timestamp'];
		$kolom_order = ['id_project', 'type', 'brand', 'kontrak', 'item', 'style', 'field', 'value', 'insert_at'];

		$sql = "SELECT a.id_project, d.type, d.brand, d.kontrak, d.item, 
			d.style, a.insert_at, DATE_FORMAT(a.insert_at, '%d/%m/%Y %H:%i') AS `timestamp`,
			c.field, a.value
			FROM log_activity a
			INNER JOIN ms_action c ON a.activity_type = c.action_type
			LEFT JOIN (
				SELECT *
				FROM tb_activity_read b
				WHERE b.`username` = '$username'
			) AS b ON a.`id` = b.id_activity
			INNER JOIN project_h d ON d.id = a.id_project
			ORDER BY a.`insert_at` DESC ";

		$condition .= dt_searching($kolom_search, $search);
		$order = dt_order($kolom_order, $order_column, $order_mode);

		if ($length > 0) {
			$limit = " LIMIT $start, $length ";
		}

		$view = $this->db->query(" SELECT * FROM ( $sql ) AS tb WHERE 1 = 1 $condition $order $limit ")->result();
		$count = $this->db->query(" SELECT COUNT(*) AS jumlah FROM ( $sql ) AS tb WHERE 1 = 1 $condition ")->row();
		$jumlah = isset($count->jumlah) ? $count->jumlah : 0;

		if ($view) {
			$no = 1;
			foreach ($view as $row => $val) {
				$data[$row] = [
					'no' => $val->id_project,
					'type' => $val->type,
					'brand' => $val->brand,
					'kontrak' => $val->kontrak,
					'item' => $val->item,
					'style' => $val->style,
					'field' => lang($val->field),
					'value' => $val->value,
					'update' => $val->timestamp
				];
			}
		}

		$response = [
			'draw' => $draw,
			'recordsTotal' => $jumlah,
			'recordsFiltered' => $jumlah,
			'data' => $data
		];

		return $response;
	}

	public function read_all_notif($username)
	{
		$this->db->query("
			INSERT INTO tb_activity_read (id_activity, username) 
			(SELECT a.`id`, '$username'
			FROM log_activity a
			INNER JOIN ms_action c ON a.activity_type = c.action_type
			LEFT JOIN (
				SELECT *
				FROM tb_activity_read b
				WHERE b.`username` = '$username'
			) AS b ON a.`id` = b.id_activity
			INNER JOIN project_h d ON d.id = a.id_project
			WHERE b.id IS NULL
			ORDER BY a.`insert_at` DESC)");

		if ($this->db->affected_rows() > 0) {
			return true;
		} 

		return false;
	}
}

/* End of file Notification_Model.php */
/* Location: ./application/models/Notification_Model.php */ ?>