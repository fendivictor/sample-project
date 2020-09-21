<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Load library phpspreadsheet
require('./phpspreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Excel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Project_Model']);
	}

	public function replace_invalid_character($string)
	{
		$invalidCharacters = array('*', ':', '/', '\\', '?', '[', ']');

		for ($i = 0; $i < count($invalidCharacters); $i++) {
			if (strpos($string, $invalidCharacters[$i])) {
				$string = str_replace($invalidCharacters[$i], ' ', $string);
			}
		}

		return $string;
	}

	public function sample()
	{
		$keyword = $this->input->get('keyword', TRUE);
		$type = $this->input->get('type', TRUE);

		$sheet_title = ($type == 'ongoing') ? lang('menu_project_list') : lang('menu_finish');

		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		$table_border = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
		        ],
		    ],
		];

		$text_middle = [
			'alignment' => [
			    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
			]
		];

		$bg_green = [
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startColor' => [
					'argb' => 'aee8b1'
				]
			]
		];

		$bg_orange = [
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startColor' => [
					'argb' => 'edab85'
				]
			]
		];

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Fukuryo Sample Control System')
			->setLastModifiedBy('Fukuryo Sample Control System')
			->setTitle('Fukuryo Sample Control System')
			->setSubject('Fukuryo Sample Control System')
			->setDescription('Fukuryo Sample Control System')
			->setKeywords('sample control system')
			->setCategory('sample control system');

		// Add some data
		$sheet = $spreadsheet->setActiveSheetIndex(0);

		$sheet_header = [
			['col' => 'A3', 'val' => lang('field_no'), 'style' => $bg_orange], 
			['col' => 'B3', 'val' => lang('field_style'), 'style' => $bg_orange], 
			['col' => 'C3', 'val' => lang('field_type'), 'style' => $bg_orange], 
			['col' => 'D3', 'val' => lang('field_brand'), 'style' => $bg_orange], 
			['col' => 'E3', 'val' => lang('field_kontrak'), 'style' => $bg_orange], 
			['col' => 'F3', 'val' => lang('field_item'), 'style' => $bg_orange], 
			['col' => 'G3', 'val' => lang('field_pattern'), 'style' => $bg_orange], 
			['col' => 'I3', 'val' => lang('field_size'), 'style' => $bg_orange], 
			['col' => 'J3', 'val' => lang('field_qty').' ('.lang('field_pce').')', 'style' => $bg_orange], 
			['col' => 'K3', 'val' => lang('field_price'), 'style' => $bg_orange], 
			['col' => 'L3', 'val' => lang('field_tec_sheet'), 'style' => $bg_orange], 
			['col' => 'N3', 'val' => lang('field_pattern'), 'style' => $bg_orange], 
			['col' => 'P3', 'val' => lang('field_material_fabric'), 'style' => $bg_orange], 
			['col' => 'R3', 'val' => lang('field_material_aksesories'), 'style' => $bg_orange], 
			['col' => 'T3', 'val' => lang('field_tujuan_sample'), 'style' => $bg_orange], 
			['col' => 'U3', 'val' => lang('field_due_date'), 'style' => $bg_orange], 
			['col' => 'V3', 'val' => lang('field_plan_kirim_sample'), 'style' => $bg_green], 
			['col' => 'X3', 'val' => lang('master_code'), 'style' => $bg_green], 
			['col' => 'Y3', 'val' => lang('line'), 'style' => $bg_green], 
			['col' => 'Z3', 'val' => lang('field_persiapan_produksi'), 'style' => $bg_green], 
			['col' => 'AB3', 'val' => lang('field_cad'), 'style' => $bg_green], 
			['col' => 'AD3', 'val' => lang('field_cutting'), 'style' => $bg_green], 
			['col' => 'AF3', 'val' => lang('field_sewing_inspect'), 'style' => $bg_green], 
			['col' => 'AH3', 'val' => lang('field_masuk_finish_good'), 'style' => $bg_green], 
			['col' => 'AJ3', 'val' => lang('keterangan'), 'style' => $bg_green], 
			['col' => 'C4', 'val' => '('.lang('field_jenis').')', 'style' => $bg_orange], 
			['col' => 'G4', 'val' => lang('field_nopattern'), 'style' => $bg_orange], 
			['col' => 'H4', 'val' => lang('field_order'), 'style' => $bg_orange], 
			['col' => 'L4', 'val' => lang('field_plan_kirim'), 'style' => $bg_orange], 
			['col' => 'M4', 'val' => lang('field_actual_kirim'), 'style' => $bg_orange], 
			['col' => 'N4', 'val' => lang('field_plan_kirim'), 'style' => $bg_orange], 
			['col' => 'O4', 'val' => lang('field_actual_kirim'), 'style' => $bg_orange], 
			['col' => 'P4', 'val' => lang('field_kirim_dhl'), 'style' => $bg_orange], 
			['col' => 'Q4', 'val' => lang('field_tgl_kedatangan'), 'style' => $bg_green], 
			['col' => 'R4', 'val' => lang('field_kirim_dhl'), 'style' => $bg_orange], 
			['col' => 'S4', 'val' => lang('field_tgl_kedatangan'), 'style' => $bg_green], 
			['col' => 'AH4', 'val' => lang('field_plan_kirim'), 'style' => $bg_green], 
			['col' => 'AI4', 'val' => lang('field_actual_kirim'), 'style' => $bg_green],
			['col' => 'V4', 'val' => lang('field_plan_kirim'), 'style' => $bg_green], 
			['col' => 'W4', 'val' => lang('field_actual_kirim'), 'style' => $bg_green], 
			['col' => 'Z4', 'val' => lang('field_plan_kirim'), 'style' => $bg_green], 
			['col' => 'AA4', 'val' => lang('field_actual_kirim'), 'style' => $bg_green],
			['col' => 'AB4', 'val' => lang('field_plan_kirim'), 'style' => $bg_green], 
			['col' => 'AC4', 'val' => lang('field_actual_kirim'), 'style' => $bg_green], 
			['col' => 'AD4', 'val' => lang('field_plan_kirim'), 'style' => $bg_green], 
			['col' => 'AE4', 'val' => lang('field_actual_kirim'), 'style' => $bg_green], 
			['col' => 'AF4', 'val' => lang('field_plan_kirim'), 'style' => $bg_green], 
			['col' => 'AG4', 'val' => lang('field_actual_kirim'), 'style' => $bg_green] 
		];

		$merge = ['A3:A4', 'B3:B4', 'D3:D4', 'E3:E4', 'F3:F4', 'G3:H3', 'I3:I4', 'J3:J4', 'K3:K4', 'L3:M3', 'N3:O3', 'P3:Q3', 'R3:S3', 'T3:T4', 'U3:U4', 'V3:W3', 'X3:X4', 'Y3:Y4', 'Z3:AA3', 'AB3:AC3', 'AD3:AE3', 'AF3:AG3', 'AH3:AI3', 'AJ3:AJ4', 'A1:AJ1'];

		$styling = [
			['col' => 'A3:AJ4', 'style' => $text_middle, 'col' => 'A1:AJ1', 'style' => $text_middle, 'col' => 'A3:AJ4', 'style' => $text_middle]
		];


		foreach ($sheet_header as $row) {
			$colStyle = isset($row['style']) ? $row['style'] : '';

			$sheet->setCellValue($row['col'], $row['val']);

			if ($colStyle != '') {
				$sheet->getStyle($row['col'])->applyFromArray($colStyle);
			}
		}

		foreach ($merge as $row) {
			$spreadsheet->getActiveSheet()->mergeCells($row);
		}

		foreach ($styling as $row) {
			$sheet->getStyle($row['col'])->applyFromArray($row['style']);
		}

		$data = $this->Project_Model->excel_project($keyword, $type);

		$sheet->setCellValue('A1', $sheet_title);

		$baris = 5;
		if ($data) {
			foreach ($data as $row) {
				$sheet->setCellValue('A'.$baris, $row->id);
				$sheet->setCellValue('B'.$baris, $row->style);
				$sheet->setCellValue('C'.$baris, $row->type);
				$sheet->setCellValue('D'.$baris, $row->brand);
				$sheet->setCellValue('E'.$baris, $row->kontrak);
				$sheet->setCellValue('F'.$baris, $row->item);
				$sheet->setCellValue('G'.$baris, $row->no_pattern);
				$sheet->setCellValue('H'.$baris, $row->order);
				$sheet->setCellValue('I'.$baris, $row->size);
				$sheet->setCellValue('J'.$baris, $row->qty);
				$sheet->setCellValue('K'.$baris, $row->price);
				$sheet->setCellValue('L'.$baris, $row->format_tec_sheet_plan);
				$sheet->setCellValue('M'.$baris, $row->format_tec_sheet_actual);
				$sheet->setCellValue('N'.$baris, $row->format_pattern_plan);
				$sheet->setCellValue('O'.$baris, $row->format_pattern_actual);
				$sheet->setCellValue('P'.$baris, $row->format_fabric_plan);
				$sheet->setCellValue('Q'.$baris, $row->format_fabric_actual);
				$sheet->setCellValue('R'.$baris, $row->format_aksesories_plan);
				$sheet->setCellValue('S'.$baris, $row->format_aksesories_actual);
				$sheet->setCellValue('T'.$baris, $row->tujuan_sample);
				$sheet->setCellValue('u'.$baris, $row->format_due_date);
				$sheet->setCellValue('V'.$baris, $row->format_kirim_plan);
				$sheet->setCellValue('W'.$baris, $row->format_kirim_actual);
				$sheet->setCellValue('X'.$baris, $row->master_code);
				$sheet->setCellValue('Y'.$baris, $row->line);
				$sheet->setCellValue('Z'.$baris, $row->format_persiapan_plan);
				$sheet->setCellValue('AA'.$baris, $row->format_persiapan_actual);
				$sheet->setCellValue('AB'.$baris, $row->format_cutting_plan);
				$sheet->setCellValue('AC'.$baris, $row->format_cutting_actual);
				$sheet->setCellValue('AD'.$baris, $row->format_cad_plan);
				$sheet->setCellValue('AE'.$baris, $row->format_cad_actual);
				$sheet->setCellValue('AF'.$baris, $row->format_sewing_plan);
				$sheet->setCellValue('AG'.$baris, $row->format_sewing_actual);
				$sheet->setCellValue('AH'.$baris, $row->format_fg_plan);
				$sheet->setCellValue('AI'.$baris, $row->format_fg_actual);
				$sheet->setCellValue('AJ'.$baris, $row->keterangan);

				$baris++;
			}
		}

		$sheet->getStyle('A3:AJ'.($baris - 1))->applyFromArray($table_border);

		foreach (range(1, 36) AS $colID) {
			$spreadsheet->getActiveSheet()->getColumnDimension(excel_number_to_column_name($colID))->setAutoSize(true);
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle($sheet_title);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		$filename = ($type == 'ongoing') ? strtolower(lang('menu_project_list')).' '.date('d-m-Y') : strtolower(lang('menu_finish')).' '.date('d-m-Y');

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}
}

/* End of file Excel.php */
/* Location: ./application/controllers/Excel.php */ ?>