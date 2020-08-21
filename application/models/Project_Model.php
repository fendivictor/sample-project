<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function total_sample()
	{
		$sql = $this->db->query("
			SELECT COUNT(*) AS jumlah 
			FROM project_h ")->row();

		return isset($sql->jumlah) ? $sql->jumlah : 0;
	}

	public function view_project($keyword = '')
	{
		return $this->db->query("
			SELECT a.*, b.description AS last_update, 
			b.insert_at AS time_updated, d.profile_name
			FROM project_h a 
			LEFT JOIN (
				SELECT c.*
				FROM (
					SELECT MAX(a.`id`) AS id, a.`id_project`
					FROM project_d a
					GROUP BY a.`id_project`
				) AS b 
				INNER JOIN project_d c ON c.`id` = b.id AND c.`id_project` = b.id_project
			) AS b ON a.id = b.id_project
			INNER JOIN tb_user d ON d.username = b.user_insert
			ORDER BY a.insert_at DESC ")->result();
	}

	public function project_header($id)
	{
		return $this->db->query("
			SELECT a.*
			FROM project_h a 
			INNER JOIN tb_user b ON a.user_insert = b.username
			WHERE a.id = '$id' ")->row();
	}

	public function grouping_date_header($id)
	{
		return $this->db->query("
			SELECT DATE(a.`insert_at`) AS tgl
			FROM log_activity a
			WHERE a.`id_project` = '$id'
			GROUP BY DATE(a.`insert_at`)
			ORDER BY a.insert_at DESC ")->result();
	}

	public function project_date($id, $tgl)
	{
		return $this->db->query("
			SELECT a.`id`, a.`id_project`, a.`activity_type`, a.`value`,
			a.`note`, c.`field`, d.`profile_name`, a.`note` AS description,
			a.`insert_at`, a.id_project_d
			FROM log_activity a
			LEFT JOIN project_h b ON a.`id_project` = b.`id`
			LEFT JOIN ms_action c ON c.`action_type` = a.`activity_type`
			LEFT JOIN tb_user d ON d.`username` = a.`user_insert` 
			WHERE a.`id_project` = '$id'
			AND DATE(a.`insert_at`) = '$tgl'
			ORDER BY a.insert_at DESC ")->result();	
	}

	public function project_attachment($id_project_d)
	{
		return $this->db->where(['id_project_d' => $id_project_d])
					->get('project_attachment')->result();
	}

	public function add_project($data)
	{
		$this->db->trans_begin();

		$this->db->insert('project_h', $data);

		$id = $this->db->insert_id();

		$this->db->insert('log_activity', [
			'id_project' => $id,
			'activity_type' => 'create_project',
			'user_insert' => $data['user_insert'],
			'insert_at' => $data['insert_at']
		]);

		if ($this->db->trans_status()) {
			$this->db->trans_commit();

			return true;
		} else {
			$this->db->trans_rollback();

			return false;
		}
	}

	public function dt_project($params)
	{
		$draw = $this->db->escape_str($params['draw']);
		$order_column = $this->db->escape_str($params['order_column']);
		$order_mode = $this->db->escape_str($params['order_mode']);
		$start = $this->db->escape_str($params['start']);
		$length = $this->db->escape_str($params['length']);
		$search = $this->db->escape_str($params['search']);
		$username = $this->session->userdata('username');
		$id_menu = 3;

		$arrPrivilege = [];
		$privilege = $this->db->where([
			'id_menu' => $id_menu,
			'username' => $username
		])->get('tb_privilege')->result_array();

		if ($privilege) {
			foreach ($privilege as $row) {
				$arrPrivilege[] = $row['tools'];
			}
		}

		$condition = '';
		$order = '';
		$limit = '';
		$data = [];

		$kolom_search = ['type', 'brand', 'kontrak', 'item', 'style', 'no_pattern', '`order`', 'size', 'qty', 'price', 'format_tec_sheet_plan', 'format_tec_sheet_actual', 'format_pattern_plan', 'format_pattern_actual', 'format_fabric_plan', 'format_fabric_actual', 'format_aksesories_plan', 'format_aksesories_actual', 'due_date', 'tujuan_sample', 'master_code', 'line', 'persiapan_plan', 'persiapan_actual', 'cutting_plan', 'cutting_actual', 'cad_plan', 'cad_actual', 'sewing_plan', 'sewing_actual', 'fg_plan', 'fg_actual', 'kirim_plan', 'kirim_actual', 'keterangan'];
		$kolom_order = ['type', 'type', 'brand', 'kontrak', 'item', 'style', 'no_pattern', '`order`', 'size', 'qty', 'price', 'tec_sheet_plan', 'tec_sheet_actual', 'pattern_plan', 'pattern_actual', 'fabric_plan', 'fabric_actual', 'aksesories_plan', 'aksesories_actual', 'due_date', 'tujuan_sample', 'master_code', 'line', 'persiapan_plan', 'persiapan_actual', 'cutting_plan', 'cutting_actual', 'cad_plan', 'cad_actual', 'sewing_plan', 'sewing_actual', 'fg_plan', 'fg_actual', 'kirim_plan', 'kirim_actual', 'keterangan'];

		$condition .= dt_searching($kolom_search, $search);
		$order = dt_order($kolom_order, $order_column, $order_mode);

		if ($length > 0) {
			$limit = " LIMIT $start, $length ";
		}

		$sql = "
			SELECT *, DATE_FORMAT(a.tec_sheet_plan, '%d/%m/%Y') AS format_tec_sheet_plan,
			DATE_FORMAT(a.tec_sheet_actual, '%d/%m/%Y') AS format_tec_sheet_actual,
			DATE_FORMAT(a.pattern_plan, '%d/%m/%Y') AS format_pattern_plan,
			DATE_FORMAT(a.pattern_actual, '%d/%m/%Y') AS format_pattern_actual,
			DATE_FORMAT(a.fabric_plan, '%d/%m/%Y') AS format_fabric_plan,
			DATE_FORMAT(a.fabric_actual, '%d/%m/%Y') AS format_fabric_actual,
			DATE_FORMAT(a.aksesories_plan, '%d/%m/%Y') AS format_aksesories_plan,
			DATE_FORMAT(a.aksesories_actual, '%d/%m/%Y') AS format_aksesories_actual,
			DATE_FORMAT(a.due_date, '%d/%m/%Y') AS format_due_date,
			DATE_FORMAT(a.persiapan_plan, '%d/%m/%Y') AS format_persiapan_plan,
			DATE_FORMAT(a.persiapan_actual, '%d/%m/%Y') AS format_persiapan_actual,
			DATE_FORMAT(a.cutting_plan, '%d/%m/%Y') AS format_cutting_plan,
			DATE_FORMAT(a.cutting_actual, '%d/%m/%Y') AS format_cutting_actual,
			DATE_FORMAT(a.cad_plan, '%d/%m/%Y') AS format_cad_plan,
			DATE_FORMAT(a.cad_actual, '%d/%m/%Y') AS format_cad_actual,
			DATE_FORMAT(a.sewing_plan, '%d/%m/%Y') AS format_sewing_plan,
			DATE_FORMAT(a.sewing_actual, '%d/%m/%Y') AS format_sewing_actual,
			DATE_FORMAT(a.fg_plan, '%d/%m/%Y') AS format_fg_plan,
			DATE_FORMAT(a.fg_actual, '%d/%m/%Y') AS format_fg_actual,
			DATE_FORMAT(a.kirim_plan, '%d/%m/%Y') AS format_kirim_plan,
			DATE_FORMAT(a.kirim_actual, '%d/%m/%Y') AS format_kirim_actual
			FROM project_h a 
			WHERE a.finish IS NULL";

		$view = $this->db->query(" SELECT * FROM ( $sql ) AS tb WHERE 1 = 1 $condition $order $limit ")->result();
		$count = $this->db->query(" SELECT COUNT(*) AS jumlah FROM ( $sql ) AS tb WHERE 1 = 1 $condition ")->row();
		$jumlah = isset($count->jumlah) ? $count->jumlah : 0;

		if ($view) {
			$no = 1;
			foreach ($view as $row) {
				$btn_history = '<a href="javascript:;" class="btn btn-success btn-xs btn-history" data-id="'.$row->id.'"><i class="fa fa-history"></i></a>';

				$btn_finish = '';
				if (in_array('finish-btn', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '' && $row->format_persiapan_actual != '' && $row->format_cad_actual != '' && $row->format_cutting_actual != '' && $row->format_sewing_actual != '' && $row->format_fg_actual != '' && $row->format_kirim_actual != '') {
					$btn_finish = '<a href="javascript:;" class="btn btn-primary btn-xs btn-finish" data-id="'.$row->id.'"><i class="fa fa-check"></i></a>';
				}

				$btn_tec_sheet_plan = $row->format_tec_sheet_plan;
				if (in_array('tec-sheet-plan-kirim', $arrPrivilege)) {
					$btn_tec_sheet_plan = ($row->format_tec_sheet_plan != '') ? '<a href="javascript:;" data-action="input-tec-sheet-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_tec_sheet_plan.'</a>' : '<a href="javascript:;" data-action="input-tec-sheet-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_tec_sheet_actual = $row->format_tec_sheet_actual;
				if (in_array('tec-sheet-actual-kirim', $arrPrivilege)) {
					$btn_tec_sheet_actual = ($row->format_tec_sheet_actual != '') ? '<a href="javascript:;" data-action="input-tec-sheet-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_tec_sheet_actual.'</a>' : '<a href="javascript:;" data-action="input-tec-sheet-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_pattern_plan = $row->format_pattern_plan;
				if (in_array('pattern-plan-kirim', $arrPrivilege)) {
					$btn_pattern_plan = ($row->format_pattern_plan != '') ? '<a href="javascript:;" data-action="input-pattern-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_pattern_plan.'</a>' : '<a href="javascript:;" data-action="input-pattern-plan" data-id="'.$row->id.'" class="click-to-update">'.lang('btn_input').'</a>';
				}

				$btn_pattern_actual = $row->format_pattern_actual;
				if (in_array('pattern-actual-kirim', $arrPrivilege)) {
					$btn_pattern_actual = ($row->format_pattern_actual != '') ? '<a href="javascript:;" data-action="input-pattern-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_pattern_actual.'</a>' : '<a href="javascript:;" data-action="input-pattern-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_fabric_plan = $row->format_fabric_plan;
				if (in_array('fabric-kirim', $arrPrivilege)) {
					$btn_fabric_plan = ($row->format_fabric_plan != '') ? '<a href="javascript:;" data-action="input-fabric-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_fabric_plan.'</a>' : '<a href="javascript:;" data-action="input-fabric-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_fabric_actual = $row->format_fabric_actual;
				if (in_array('fabric-kedatangan', $arrPrivilege) && $row->format_fabric_plan != '') {
					$btn_fabric_actual = ($row->format_fabric_actual != '') ? '<a href="javascript:;" data-action="input-fabric-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_fabric_actual.'</a>' : '<a href="javascript:;" data-action="input-fabric-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_aksesories_plan = $row->format_aksesories_plan;
				if (in_array('aksesories-kirim', $arrPrivilege)) {
					$btn_aksesories_plan = ($row->format_aksesories_plan != '') ? '<a href="javascript:;" data-action="input-aksesories-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_aksesories_plan.'</a>' : '<a href="javascript:;" data-action="input-aksesories-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_aksesories_actual = $row->format_aksesories_actual;
				if (in_array('aksesories-kedatangan', $arrPrivilege) && $row->format_aksesories_plan != '') {
					$btn_aksesories_actual = ($row->format_aksesories_actual != '') ? '<a href="javascript:;" data-action="input-aksesories-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_aksesories_actual.'</a>' : '<a href="javascript:;" data-action="input-aksesories-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_mastercode = $row->master_code;
				if (in_array('master-code', $arrPrivilege)) {
					$btn_mastercode = ($row->master_code != '') ? '<a href="javascript:;" data-action="input-mastercode" data-id="'.$row->id.'" class="click-to-update">'.$row->master_code.'</a>' : '<a href="javascript:;" data-action="input-mastercode" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_line = $row->line;
				if (in_array('line', $arrPrivilege)) {
					$btn_line = ($row->line != '') ? '<a href="javascript:;" data-action="input-line" data-id="'.$row->id.'" class="click-to-update">'.$row->line.'</a>' : '<a href="javascript:;" data-action="input-line" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_persiapan_plan = $row->format_persiapan_plan;
				if (in_array('persiapan-finish-plan', $arrPrivilege)) {
					$btn_persiapan_plan = ($row->format_persiapan_plan != '') ? '<a href="javascript:;" data-action="input-persiapan-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_persiapan_plan.'</a>' : '<a href="javascript:;" data-action="input-persiapan-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_persiapan_actual = $row->format_persiapan_actual;
				if (in_array('persiapan-finish-actual', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '') {
					$btn_persiapan_actual = ($row->format_persiapan_actual != '') ? '<a href="javascript:;" data-action="input-persiapan-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_persiapan_actual.'</a>' : '<a href="javascript:;" data-action="input-persiapan-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_cutting_plan = $row->format_cutting_plan;
				if (in_array('cutting-finish-plan', $arrPrivilege)) {
					$btn_cutting_plan = ($row->format_cutting_plan != '') ? '<a href="javascript:;" data-action="input-cutting-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_cutting_plan.'</a>' : '<a href="javascript:;" data-action="input-cutting-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_cutting_actual = $row->format_cutting_actual;
				if (in_array('cutting-finish-actual', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '' && $row->format_persiapan_actual != '' && $row->format_cad_actual != '') {
					$btn_cutting_actual = ($row->format_cutting_actual != '') ? '<a href="javascript:;" data-action="input-cutting-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_cutting_actual.'</a>' : '<a href="javascript:;" data-action="input-cutting-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_cad_plan = $row->format_cad_plan;
				if (in_array('cad-finish-plan', $arrPrivilege)) {
					$btn_cad_plan = ($row->format_cad_plan != '') ? '<a href="javascript:;" data-action="input-cad-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_cad_plan.'</a>' : '<a href="javascript:;" data-action="input-cad-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_cad_actual = $row->format_cad_actual;
				if (in_array('cad-finish-actual', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '' && $row->format_persiapan_actual != '') {
					$btn_cad_actual = ($row->format_cad_actual != '') ? '<a href="javascript:;" data-action="input-cad-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_cad_actual.'</a>' : '<a href="javascript:;" data-action="input-cad-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_sewing_plan = $row->format_sewing_plan;
				if (in_array('sewing-finish-plan', $arrPrivilege)) {
					$btn_sewing_plan = ($row->format_sewing_plan != '') ? '<a href="javascript:;" data-action="input-sewing-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_sewing_plan.'</a>' : '<a href="javascript:;" data-action="input-sewing-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_sewing_actual = $row->format_sewing_actual;
				if (in_array('sewing-finish-actual', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '' && $row->format_persiapan_actual != '' && $row->format_cad_actual != '' && $row->format_cutting_actual != '') {
					$btn_sewing_actual = ($row->format_sewing_actual != '') ? '<a href="javascript:;" data-action="input-sewing-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_sewing_actual.'</a>' : '<a href="javascript:;" data-action="input-sewing-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_fg_plan = $row->format_fg_plan;
				if (in_array('finish-goods-plan', $arrPrivilege)) {
					$btn_fg_plan = ($row->format_fg_plan != '') ? '<a href="javascript:;" data-action="input-fg-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_fg_plan.'</a>' : '<a href="javascript:;" data-action="input-fg-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_fg_actual = $row->format_fg_actual;
				if (in_array('finish-goods-actual', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '' && $row->format_persiapan_actual != '' && $row->format_cad_actual != '' && $row->format_cutting_actual != '' && $row->format_sewing_actual != '') {
					$btn_fg_actual = ($row->format_fg_actual != '') ? '<a href="javascript:;" data-action="input-fg-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_fg_actual.'</a>' : '<a href="javascript:;" data-action="input-fg-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_kirim_plan = $row->format_kirim_plan;
				if (in_array('kirim-plan', $arrPrivilege)) {
					$btn_kirim_plan = ($row->format_kirim_plan != '') ? '<a href="javascript:;" data-action="input-kirim-plan" data-id="'.$row->id.'" class="click-to-update">'.$row->format_kirim_plan.'</a>' : '<a href="javascript:;" data-action="input-kirim-plan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_kirim_actual = $row->format_kirim_actual;
				if (in_array('kirim-actual', $arrPrivilege) && $row->format_fabric_plan != '' && $row->format_aksesories_plan != '' && $row->format_persiapan_actual != '' && $row->format_cad_actual != '' && $row->format_cutting_actual != '' && $row->format_sewing_actual != '' && $row->format_fg_actual != '') {
					$btn_kirim_actual = ($row->format_kirim_actual != '') ? '<a href="javascript:;" data-action="input-kirim-actual" data-id="'.$row->id.'" class="click-to-update">'.$row->format_kirim_actual.'</a>' : '<a href="javascript:;" data-action="input-kirim-actual" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$btn_keterangan = $row->keterangan;
				if (in_array('keterangan', $arrPrivilege)) {
					$btn_keterangan = ($row->keterangan != '') ? '<a href="javascript:;" data-action="input-keterangan" data-id="'.$row->id.'" class="click-to-update">'.$row->keterangan.'</a>' : '<a href="javascript:;" data-action="input-keterangan" data-id="'.$row->id.'" class="click-to-update"><i>'.lang('btn_input').'</i></a>';
				}

				$data[] = [
					'no' => $row->id,
					'type' => $row->type,
					'brand' => $row->brand,
					'kontrak' => $row->kontrak,
					'item' => $row->item,
					'style' => $row->style,
					'no_pattern' => $row->no_pattern,
					'order' => $row->order,
					'size' => $row->size,
					'qty' => $row->qty,
					'price' => $row->price,
					'tec_sheet_plan' => $btn_tec_sheet_plan,
					'tec_sheet_actual' => $btn_tec_sheet_actual,
					'pattern_plan' => $btn_pattern_plan,
					'pattern_actual' => $btn_pattern_actual,
					'fabric_plan' => $btn_fabric_plan,
					'fabric_actual' => $btn_fabric_actual,
					'aksesories_plan' => $btn_aksesories_plan,
					'aksesories_actual' => $btn_aksesories_actual,
					'due_date' => $row->format_due_date,
					'tujuan_sample' => $row->tujuan_sample,
					'master_code' => $btn_mastercode,
					'line' => $btn_line,
					'persiapan_plan' => $btn_persiapan_plan,
					'persiapan_actual' => $btn_persiapan_actual,
					'cutting_plan' => $btn_cutting_plan,
					'cutting_actual' => $btn_cutting_actual,
					'cad_plan' => $btn_cad_plan,
					'cad_actual' => $btn_cad_actual,
					'sewing_plan' => $btn_sewing_plan,
					'sewing_actual' => $btn_sewing_actual,
					'fg_plan' => $btn_fg_plan,
					'fg_actual' => $btn_fg_actual,
					'kirim_plan' => $btn_kirim_plan,
					'kirim_actual' => $btn_kirim_actual,
					'keterangan' => $btn_keterangan,
					'tools' => $btn_history.'&nbsp;&nbsp;'.$btn_finish
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

	public function update_project($params)
	{
		$id = $params['id'];
		$action = $params['action'];
		$value = $params['value'];
		$note = $params['note'];
		$username = $this->session->userdata('username');
		$now = $this->Main_Model->get_time('%Y-%m-%d %H:%i:%s');
		$value_asli = $params['value'];
		$uploaded = $params['upload'];

		$ms_action = $this->db->where('action_type', $action)->get('ms_action')->row();

		$status = 0;
		$message = 'Metode tidak ditemukan';

		if ($ms_action) {
			$field = $ms_action->field;
			$type = $ms_action->data_type;

			if ($value_asli == '') {
				return [
					'status' => 0,
					'message' => lang($field).' is required'
				];
			}

			$this->db->trans_begin();

			if ($type == 'date') {
				$value = custom_date_format($value, 'd/m/Y', 'Y-m-d');
			}

			$this->db->where('id', $id)->update('project_h', [$field => $value]);
			$this->db->insert('project_d', ['id_project' => $id, 'description' => $note, 'user_insert' => $username]);

			$id_project_d = $this->db->insert_id();

			$this->db->insert('log_activity', [
				'id_project' => $id, 
				'id_project_d' => $id_project_d, 
				'activity_type' => $action, 
				'user_insert' => $username,
				'value' => $value_asli,
				'note' => $note
			]);

			if ($uploaded) {
				$attachment = [];
				foreach ($uploaded as $row) {
					$attachment[] = [
						'id_project_d' => $id_project_d,
						'lampiran' => $row['folder'].'/'.$row['file_name']
					];
				}

				if ($attachment) {
					$this->db->insert_batch('project_attachment', $attachment);
				}
			}
		}

		if ($this->db->trans_status()) {
			$this->db->trans_commit();

			$status = 1;
			$message = lang('ajax_msg_save_success');
		} else {
			$this->db->trans_rollback();

			$status = 0;
			$message = lang('ajax_msg_save_fail');
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		return $result;
	}

	public function dashboard_progress()
	{
		return $this->db->query("
			SELECT a.`kontrak`, a.`type`,
			CASE WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual IS NULL AND a.cad_actual IS NULL AND a.cutting_actual IS NULL AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
				THEN 'field_persiapan_produksi'
			WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual IS NULL AND a.cutting_actual IS NULL AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
				THEN 'field_cad'
			WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual IS NULL AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
				THEN 'field_cutting'
			WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
				THEN 'field_sewing_inspect'
			WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual <> '' AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
				THEN 'field_masuk_finish_good'
			WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual <> '' AND a.fg_actual <> '' AND a.kirim_actual IS NULL
				THEN 'field_plan_kirim_sample'
			WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual <> '' AND a.fg_actual <> '' AND a.kirim_actual <> ''
				THEN 'selesai'
			ELSE 'proses_pengiriman'
			END AS `status`
			FROM project_h a ")->result();	
	}

	public function dt_delivery($bulan, $tahun)
	{
		if ($bulan == '') $bulan = date('m');
		if ($tahun == '') $tahun = date('Y');

		$sql = $this->db->query("
			SELECT *
			FROM project_h a
			WHERE MONTH(a.`kirim_actual`) = '$bulan'
			AND YEAR(a.kirim_actual) = '$tahun' ")->result();

		$response = [];
		if ($sql) {
			foreach ($sql as $row) {
				$response[] = [
					'kontrak' => $row->kontrak,
					'type' => $row->type,
					'delivery' => format_tgl($row->kirim_actual, 'Y-m-d', 'd/m/Y')
				];
			}
		}

		return ['data' => $response];
	}

	public function dt_history($params)
	{
		$draw = $this->db->escape_str($params['draw']);
		$order_column = $this->db->escape_str($params['order_column']);
		$order_mode = $this->db->escape_str($params['order_mode']);
		$start = $this->db->escape_str($params['start']);
		$length = $this->db->escape_str($params['length']);
		$search = $this->db->escape_str($params['search']);

		$condition = '';
		$order = '';
		$limit = '';
		$data = [];

		$kolom_search = ['type', 'brand', 'kontrak', 'item', 'style', 'no_pattern', '`order`', 'size', 'qty', 'price', 'format_tec_sheet_plan', 'format_tec_sheet_actual', 'format_pattern_plan', 'format_pattern_actual', 'format_fabric_plan', 'format_fabric_actual', 'format_aksesories_plan', 'format_aksesories_actual', 'due_date', 'tujuan_sample', 'master_code', 'line', 'persiapan_plan', 'persiapan_actual', 'cutting_plan', 'cutting_actual', 'cad_plan', 'cad_actual', 'sewing_plan', 'sewing_actual', 'fg_plan', 'fg_actual', 'kirim_plan', 'kirim_actual', 'keterangan', 'format_finish'];
		$kolom_order = ['type', 'type', 'brand', 'kontrak', 'item', 'style', 'no_pattern', '`order`', 'size', 'qty', 'price', 'tec_sheet_plan', 'tec_sheet_actual', 'pattern_plan', 'pattern_actual', 'fabric_plan', 'fabric_actual', 'aksesories_plan', 'aksesories_actual', 'due_date', 'tujuan_sample', 'master_code', 'line', 'persiapan_plan', 'persiapan_actual', 'cutting_plan', 'cutting_actual', 'cad_plan', 'cad_actual', 'sewing_plan', 'sewing_actual', 'fg_plan', 'fg_actual', 'kirim_plan', 'kirim_actual', 'finish', 'keterangan'];

		$condition .= dt_searching($kolom_search, $search);
		$order = dt_order($kolom_order, $order_column, $order_mode);

		if ($length > 0) {
			$limit = " LIMIT $start, $length ";
		}

		$sql = "
			SELECT *, DATE_FORMAT(a.tec_sheet_plan, '%d/%m/%Y') AS format_tec_sheet_plan,
			DATE_FORMAT(a.tec_sheet_actual, '%d/%m/%Y') AS format_tec_sheet_actual,
			DATE_FORMAT(a.pattern_plan, '%d/%m/%Y') AS format_pattern_plan,
			DATE_FORMAT(a.pattern_actual, '%d/%m/%Y') AS format_pattern_actual,
			DATE_FORMAT(a.fabric_plan, '%d/%m/%Y') AS format_fabric_plan,
			DATE_FORMAT(a.fabric_actual, '%d/%m/%Y') AS format_fabric_actual,
			DATE_FORMAT(a.aksesories_plan, '%d/%m/%Y') AS format_aksesories_plan,
			DATE_FORMAT(a.aksesories_actual, '%d/%m/%Y') AS format_aksesories_actual,
			DATE_FORMAT(a.due_date, '%d/%m/%Y') AS format_due_date,
			DATE_FORMAT(a.persiapan_plan, '%d/%m/%Y') AS format_persiapan_plan,
			DATE_FORMAT(a.persiapan_actual, '%d/%m/%Y') AS format_persiapan_actual,
			DATE_FORMAT(a.cutting_plan, '%d/%m/%Y') AS format_cutting_plan,
			DATE_FORMAT(a.cutting_actual, '%d/%m/%Y') AS format_cutting_actual,
			DATE_FORMAT(a.cad_plan, '%d/%m/%Y') AS format_cad_plan,
			DATE_FORMAT(a.cad_actual, '%d/%m/%Y') AS format_cad_actual,
			DATE_FORMAT(a.sewing_plan, '%d/%m/%Y') AS format_sewing_plan,
			DATE_FORMAT(a.sewing_actual, '%d/%m/%Y') AS format_sewing_actual,
			DATE_FORMAT(a.fg_plan, '%d/%m/%Y') AS format_fg_plan,
			DATE_FORMAT(a.fg_actual, '%d/%m/%Y') AS format_fg_actual,
			DATE_FORMAT(a.kirim_plan, '%d/%m/%Y') AS format_kirim_plan,
			DATE_FORMAT(a.kirim_actual, '%d/%m/%Y') AS format_kirim_actual,
			DATE_FORMAT(a.finish, '%d/%m/%Y') AS format_finish
			FROM project_h a 
			WHERE a.finish <> '' ";

		$view = $this->db->query(" SELECT * FROM ( $sql ) AS tb WHERE 1 = 1 $condition $order $limit ")->result();
		$count = $this->db->query(" SELECT COUNT(*) AS jumlah FROM ( $sql ) AS tb WHERE 1 = 1 $condition ")->row();
		$jumlah = isset($count->jumlah) ? $count->jumlah : 0;

		if ($view) {
			$no = 1;
			foreach ($view as $row) {
				$data[] = [
					'no' => $row->id,
					'type' => $row->type,
					'brand' => $row->brand,
					'kontrak' => $row->kontrak,
					'item' => $row->item,
					'style' => $row->style,
					'no_pattern' => $row->no_pattern,
					'order' => $row->order,
					'size' => $row->size,
					'qty' => $row->qty,
					'price' => $row->price,
					'tec_sheet_plan' => $row->format_tec_sheet_plan,
					'tec_sheet_actual' => $row->format_tec_sheet_actual,
					'pattern_plan' => $row->format_pattern_plan,
					'pattern_actual' => $row->format_pattern_actual,
					'fabric_plan' => $row->format_fabric_plan,
					'fabric_actual' => $row->format_fabric_actual,
					'aksesories_plan' => $row->format_aksesories_plan,
					'aksesories_actual' => $row->format_aksesories_actual,
					'due_date' => $row->format_due_date,
					'tujuan_sample' => $row->tujuan_sample,
					'master_code' => $row->master_code,
					'line' => $row->line,
					'persiapan_plan' => $row->format_persiapan_plan,
					'persiapan_actual' => $row->format_persiapan_actual,
					'cutting_plan' => $row->format_cutting_plan,
					'cutting_actual' => $row->format_cutting_actual,
					'cad_plan' => $row->format_cad_plan,
					'cad_actual' => $row->format_cad_actual,
					'sewing_plan' => $row->format_sewing_plan,
					'sewing_actual' => $row->format_sewing_actual,
					'fg_plan' => $row->format_fg_plan,
					'fg_actual' => $row->format_fg_actual,
					'kirim_plan' => $row->format_kirim_plan,
					'kirim_actual' => $row->format_kirim_actual,
					'finish' => $row->format_finish,
					'keterangan' => $row->keterangan
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

	public function dashboard_list($type, $params = [])
	{
		$draw = $this->db->escape_str($params['draw']);
		$order_column = $this->db->escape_str($params['order_column']);
		$order_mode = $this->db->escape_str($params['order_mode']);
		$start = $this->db->escape_str($params['start']);
		$length = $this->db->escape_str($params['length']);
		$search = $this->db->escape_str($params['search']);

		$condition = '';
		$order = '';
		$limit = '';
		$data = [];

		if ($type == 'sample-on-delivery') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` IS NULL
						AND a.`aksesories_actual` IS NULL
						AND a.`finish` IS NULL ";

			$kolom_search = ['id', 'type', 'brand', 'kontrak', 'item', 'style'];
			$kolom_order = ['id', 'type', 'brand', 'kontrak', 'item', 'style'];

		} else if ($type == 'sample-on-process') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style,
						CASE WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual IS NULL AND a.cad_actual IS NULL AND a.cutting_actual IS NULL AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
							THEN 'field_persiapan_produksi'
						WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual IS NULL AND a.cutting_actual IS NULL AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
							THEN 'field_cad'
						WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual IS NULL AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
							THEN 'field_cutting'
						WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual IS NULL AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
							THEN 'field_sewing_inspect'
						WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual <> '' AND a.fg_actual IS NULL AND a.kirim_actual IS NULL
							THEN 'field_masuk_finish_good'
						WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual <> '' AND a.fg_actual <> '' AND a.kirim_actual IS NULL
							THEN 'field_plan_kirim_sample'
						WHEN a.fabric_actual <> '' AND a.aksesories_actual <> '' AND a.persiapan_actual <> '' AND a.cad_actual <> '' AND a.cutting_actual <> '' AND a.sewing_actual <> '' AND a.fg_actual <> '' AND a.kirim_actual <> ''
							THEN 'selesai'
						ELSE 'proses_pengiriman'
						END AS `status`
						FROM project_h a
						WHERE a.`fabric_actual` != ''
						AND a.`aksesories_actual` != ''
						AND a.`kirim_actual` IS NULL
						AND a.`finish` IS NULL ";

			$kolom_search = ['id', 'type', 'brand', 'kontrak', 'item', 'style', 'status'];
			$kolom_order = ['id', 'type', 'brand', 'kontrak', 'item', 'style', 'status'];

		} else if ($type == 'sample-on-shipment') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` != ''
						AND a.`aksesories_actual` != ''
						AND a.`kirim_actual` != ''
						AND a.`finish` IS NULL ";

			$kolom_search = ['id', 'type', 'brand', 'kontrak', 'item', 'style'];
			$kolom_order = ['id', 'type', 'brand', 'kontrak', 'item', 'style'];

		} else if ($type == 'sample-finish') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` != ''
						AND a.`aksesories_actual` != ''
						AND a.`kirim_actual` != ''
						AND a.`finish` != '' ";

			$kolom_search = ['id', 'type', 'brand', 'kontrak', 'item', 'style'];
			$kolom_order = ['id', 'type', 'brand', 'kontrak', 'item', 'style'];

		} else {
			return [];
		}

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
					'no' => $val->id,
					'type' => $val->type,
					'brand' => $val->brand,
					'kontrak' => $val->kontrak,
					'item' => $val->item,
					'style' => $val->style
				];

				if ($type == 'sample-on-process') {
					$data[$row]['status'] = '<label>'.lang($val->status).'</label>';
				}
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

	public function dashboard_counter($type)
	{
		if ($type == 'sample-on-delivery') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` IS NULL
						AND a.`aksesories_actual` IS NULL
						AND a.`finish` IS NULL ";

		} else if ($type == 'sample-on-process') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` != ''
						AND a.`aksesories_actual` != ''
						AND a.`kirim_actual` IS NULL
						AND a.`finish` IS NULL ";

		} else if ($type == 'sample-on-shipment') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` != ''
						AND a.`aksesories_actual` != ''
						AND a.`kirim_actual` != ''
						AND a.`finish` IS NULL ";

		} else if ($type == 'sample-finish') {

			$sql = " 	SELECT a.id, a.type, a.brand, a.kontrak, a.item, a.style 
						FROM project_h a
						WHERE a.`fabric_actual` != ''
						AND a.`aksesories_actual` != ''
						AND a.`kirim_actual` != ''
						AND a.`finish` != '' ";

		} else {
			return [];
		}

		$count = $this->db->query(" SELECT COUNT(*) AS jumlah FROM ( $sql ) AS tb ")->row();
		$jumlah = isset($count->jumlah) ? $count->jumlah : 0;

		return $jumlah;
	}
}

/* End of file Project_Model.php */
/* Location: ./application/models/Project_Model.php */ ?>