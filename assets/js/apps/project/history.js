$(document).ready(function() {
	var table = $("#dt-table").DataTable({
		serverSide: true,
		processing: true,
		scrollY: "50vh",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
		ajax: {
			url: baseUrl + 'ajax/Datatable/dt_history',
			type: 'post'
		},
		searching: false,
		order: [[0, 'asc']],
		columnDefs: [
			{targets: 0, data: 'no'},
			{targets: 1, data: 'style', width: 120, 'className': 'text-center'},
			{targets: 2, data: 'type', width: 100, 'className': 'text-center'},
			{targets: 3, data: 'brand', width: 100, 'className': 'text-center'},
			{targets: 4, data: 'kontrak', width: 100, 'className': 'text-center'},
			{targets: 5, data: 'item', width: 100, 'className': 'text-center'},
			{targets: 6, data: 'no_pattern', width: 150, 'className': 'text-center'},
			{targets: 7, data: 'order', width: 100, 'className': 'text-center'},
			{targets: 8, data: 'size', width: 200, 'className': 'text-center'},
			{targets: 9, data: 'qty', width: 80, 'className': 'text-center'},
			{targets: 10, data: 'price', width: 80, 'className': 'text-center'},
			{targets: 11, data: 'tec_sheet_plan', width: 80, 'className': 'text-center'},
			{targets: 12, data: 'tec_sheet_actual', width: 80, 'className': 'text-center'},
			{targets: 13, data: 'pattern_plan', width: 80, 'className': 'text-center'},
			{targets: 14, data: 'pattern_actual', width: 80, 'className': 'text-center'},
			{targets: 15, data: 'fabric_plan', width: 80, 'className': 'text-center'},
			{targets: 16, data: 'fabric_actual', width: 80, 'className': 'text-center'},
			{targets: 17, data: 'aksesories_plan', width: 80, 'className': 'text-center'},
			{targets: 18, data: 'aksesories_actual', width: 80, 'className': 'text-center'},
			{targets: 19, data: 'tujuan_sample', width: 280, 'className': 'text-center'},
			{targets: 20, data: 'due_date', width: 80, 'className': 'text-center'},
			{targets: 21, data: 'kirim_plan', width: 80, 'className': 'text-center'},
			{targets: 22, data: 'kirim_actual', width: 80, 'className': 'text-center'},
			{targets: 23, data: 'master_code', width: 80, 'className': 'text-center'},
			{targets: 24, data: 'line', width: 80, 'className': 'text-center'},
			{targets: 25, data: 'persiapan_plan', width: 80, 'className': 'text-center'},
			{targets: 26, data: 'persiapan_actual', width: 80, 'className': 'text-center'},
			{targets: 27, data: 'cad_plan', width: 80, 'className': 'text-center'},
			{targets: 28, data: 'cad_actual', width: 80, 'className': 'text-center'},
			{targets: 29, data: 'cutting_plan', width: 80, 'className': 'text-center'},
			{targets: 30, data: 'cutting_actual', width: 80, 'className': 'text-center'},
			{targets: 31, data: 'sewing_plan', width: 80, 'className': 'text-center'},
			{targets: 32, data: 'sewing_actual', width: 80, 'className': 'text-center'},
			{targets: 33, data: 'fg_plan', width: 80, 'className': 'text-center'},
			{targets: 34, data: 'fg_actual', width: 80, 'className': 'text-center'},
			{targets: 35, data: 'keterangan', width: 280, 'className': 'text-center'},
			{targets: 36, data: 'tools', orderable: false, width: 120, 'className': 'text-center'}
		]
	});

	$("#btn-tampil").click(function() {
		let keyword	= $('#keyword').val();
		table.ajax.url(baseUrl + 'ajax/Datatable/dt_history?keyword=' + keyword).load();
	});

	$("#keyword").keypress(function(e) {
		var key = e.which;

		if (key == 13) {
			$("#btn-tampil").click();

			return false;
		}	
	});

	$(document).on('click', '.btn-history', function() {
		let id = $(this).data('id');

		window.open(baseUrl + 'Project/detail?id=' + id, '_blank');
	});

	$('#btn-download').click(function() {
		let keyword	= $('#keyword').val();
		window.open(baseUrl + 'Excel/sample?keyword=' + keyword + '&type=finish', '_blank');
	});
});