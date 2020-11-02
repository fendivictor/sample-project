$(document).ready(function() {
	$("#bulan").val(currentMonth);
	const type = ['delivery', 'process', 'shipment', 'finish'];
	const config = {
		datatable: {
			delivery: baseUrl + 'ajax/Datatable/dashboard_list?type=sample-on-delivery',
			process: baseUrl + 'ajax/Datatable/dashboard_list?type=sample-on-process',
			shipment: baseUrl + 'ajax/Datatable/dashboard_list?type=sample-on-shipment',
			finish: baseUrl + 'ajax/Datatable/dashboard_list?type=sample-finish',
			summary: baseUrl + 'ajax/Datatable/dt_summary'
		},
		counter: { 
			url : {
				delivery: baseUrl + 'ajax/Ajax/counter_dashboard?type=sample-on-delivery',
				process: baseUrl + 'ajax/Ajax/counter_dashboard?type=sample-on-process',
				shipment: baseUrl + 'ajax/Ajax/counter_dashboard?type=sample-on-shipment',
				finish: baseUrl + 'ajax/Ajax/counter_dashboard?type=sample-finish'
			},
			el: {
				delivery: 'counter-sample-on-delivery',
				process: 'counter-sample-on-process',
				shipment: 'counter-sample-on-shipment',
				finish: 'counter-sample-finish'
			}
		}
	}

	for (i in type) {
		let getCounter = $.get(config.counter.url[type[i]]);
		let elTarget = config.counter.el[type[i]];

		$.when(getCounter)
			.done(function(data) {
				let response = JSON.parse(data);

				$(`#${elTarget}`).html(response.jumlah);
			});
	}

	const columnDefinition = {
		process: [
			{targets: 0, data: 'no'},
			{targets: 1, data: 'type'},
			{targets: 2, data: 'brand'},
			{targets: 3, data: 'kontrak'},
			{targets: 4, data: 'item'},
			{targets: 5, data: 'style'},
			{targets: 6, data: 'status'},
			{targets: 7, data: 'kirim_plan'}
		],
		default: [
			{targets: 0, data: 'no'},
			{targets: 1, data: 'type'},
			{targets: 2, data: 'brand'},
			{targets: 3, data: 'kontrak'},
			{targets: 4, data: 'item'},
			{targets: 5, data: 'style'}
		],
		summary: [
			{targets: 0, data: 'no'},
			{targets: 1, data: 'type'},
			{targets: 2, data: 'brand'},
			{targets: 3, data: 'kontrak'},
			{targets: 4, data: 'item'},
			{targets: 5, data: 'style'},
			{targets: 6, data: 'qty', className: 'text-right'},
			{targets: 7, data: 'line'},
			{targets: 8, data: 'due_date'},
			{targets: 9, data: 'actual_finish'},
			{targets: 10, data: 'finish'}
		]
	}	

	const dtDelivery = $("#tb-sample-on-delivery").DataTable({
		processing: true,
		serverSide: true,
		order: [[0, 'desc']],
		ajax: {
			url: config.datatable.delivery,
			type: 'post'
		},
		columnDefs: columnDefinition.default,
		buttons: [{
	        extend: "excel",
	        className: "btn yellow btn-outline ",
	        title: excelTitle.delivery,
	        text: '<i class="fa fa-file-excel"></i> Export to Excel'
	    }],
	    dom: "<'row'<'col-md-12 mb-4'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
	});

	const dtProcess = $("#tb-sample-on-process").DataTable({
		processing: true,
		serverSide: true,
		order: [[0, 'desc']],
		ajax: {
			url: config.datatable.process,
			type: 'post'
		},
		columnDefs: columnDefinition.process,
		buttons: [{
	        extend: "excel",
	        className: "btn yellow btn-outline ",
	        title: excelTitle.process,
	        text: '<i class="fa fa-file-excel"></i> Export to Excel'
	    }],
	    dom: "<'row'<'col-md-12 mb-4'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
	});

	const dtShipment = $("#tb-sample-on-shipment").DataTable({
		processing: true,
		serverSide: true,
		order: [[0, 'desc']],
		ajax: {
			url: config.datatable.shipment,
			type: 'post'
		},
		columnDefs: columnDefinition.default,
		buttons: [{
	        extend: "excel",
	        className: "btn yellow btn-outline ",
	        title: excelTitle.shipment,
	        text: '<i class="fa fa-file-excel"></i> Export to Excel'
	    }],
	    dom: "<'row'<'col-md-12 mb-4'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
	});

	const dtFinish = $("#tb-sample-finish").DataTable({
		processing: true,
		serverSide: true,
		order: [[0, 'desc']],
		ajax: {
			url: config.datatable.finish,
			type: 'post'
		},
		columnDefs: columnDefinition.default,
		buttons: [{
	        extend: "excel",
	        className: "btn yellow btn-outline ",
	        title: excelTitle.finish,
	        text: '<i class="fa fa-file-excel"></i> Export to Excel'
	    }],
	    dom: "<'row'<'col-md-12 mb-4'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
	});

	const dtSummary = $("#tb-summary").DataTable({
		processing: true,
		serverSide: false,
		order: [[0, 'asc']],
		lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
		pageLength: -1,
		ajax: {
			url: config.datatable.summary + '?bulan=' + $("#bulan").val() + '&tahun=' + $("#tahun").val() + '&line=' + $("#line").val()
		},
		columnDefs: columnDefinition.summary,
		footerCallback: function(row, data, start, end, display) {
            var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // computing column Total of the complete result 
            var Total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0 );
            
            var Total = Total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 6 ).footer() ).html(Total);
        },
        buttons: [{
	        extend: "excel",
	        className: "btn yellow btn-outline ",
	        title: excelTitle.summary,
	        text: '<i class="fa fa-file-excel"></i> Export to Excel'
	    }],
	    dom: "<'row'<'col-md-12 mb-4'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
	});

	$("#btn-summary").click(function() {
		var bulan = $("#bulan").val();
		var tahun = $("#tahun").val();
		var line = $("#line").val();

		dtSummary.ajax.url(config.datatable.summary + '?bulan=' + bulan + '&tahun=' + tahun + '&line=' + line).load();
	});

	$("#tahun, #line").keypress(function(e) {
		var key = e.which;

		if (key == 13) {
			$("#btn-summary").click();

			return false;
		}
	});
});