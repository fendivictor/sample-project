$(document).ready(function() {
	$("#bulan").val(currentMonth);

	var tbDelivery = $("#tb-delivery").DataTable({
		processing: true,
		ajax: {
			url: baseUrl + 'ajax/Datatable/dt_delivery'
		},
		pageLength: -1,
		paging: false,
		searching: false,
		info: false,
		columnDefs: [
			{targets: 0, data: 'kontrak'},
			{targets: 1, data: 'type'},
			{targets: 2, data: 'delivery'}
		]
	});

	$("#show-monthly").click(function() {
		let bulan = $("#bulan").val();
		let tahun = $("#tahun").val();

		tbDelivery.ajax.url(baseUrl + 'ajax/Datatable/dt_delivery?bulan=' + bulan + '&tahun=' + tahun).load();
	});
});