Dropzone.autoDiscover = false;
$(document).ready(function() {
	const isMobile = $('#is-mobile').data('value');
	let configFixColumn = {
        leftColumns: 6,
        rightColumns: 1
    }

    if (lang == 'japan') {
    	configFixColumn = {
	        leftColumns: 2,
	        rightColumns: 1
	    }
    }

    if (isMobile == 1) {
    	configFixColumn = {};
    }

	var uploaded = [];
	var table = $("#dt-table").DataTable({
		processing: true,
		scrollY: "50vh",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        stateSave: true,
        deferRender: true,
		ajax: {
			url: baseUrl + 'ajax/Datatable/dt_project_non_serverside',
			type: 'post'
		},
		fixedColumns: configFixColumn,
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
		table.ajax.url(baseUrl + 'ajax/Datatable/dt_project_non_serverside?keyword=' + keyword).load();
	});

	$("#keyword").keypress(function(e) {
		var key = e.which;

		if (key == 13) {
			$("#btn-tampil").click();

			return false;
		}	
	});

	async function loadForm(action, id) {
		await $.get(baseUrl + 'ajax/Ajax/get_action_details?action=' + action, function(data) {
			let response = JSON.parse(data);

			$("#form").html(response.form_update);

			$("#action-type").val(action);
			$("#id-project").val(id);

			$('.datepicker').datepicker({
				format: 'dd/mm/yyyy',
				uiLibrary: 'bootstrap4'
			});
		});
	}

	async function loadHistory(action, id) {
		let result = await $.get(baseUrl + 'ajax/Ajax/get_history_field?action=' + action + '&id_project=' + id, function(data) {
			let response = JSON.parse(data);
			$("#note").summernote('code', '');
			if (response) {
				$(`#${response.activity_type}`).val(response.value);
				$("#note").summernote('code', response.note);
			}
		});

		return result;
	}

	$(document).on('click', '.click-to-update', function() {
		let action = $(this).data('action');
		let id = $(this).data('id');

		$("#modal-update").modal('show');

		$(".datepicker").datepicker("destroy");

		$("#filenya").html('');

		blockModal();
		loadForm(action, id)
			.then(function(data) {
				unBlockModal();
				loadHistory(action, id)
					.then(function(data) {
						let response = JSON.parse(data);
						$.get(`${baseUrl}ajax/Ajax/get_attachment?id_project_d=${response.id_project_d}`, function(data) {
							let response = JSON.parse(data);
							let element = '';

							if (response) {
								for (i in response) {
									let lampiran = response[i].lampiran;
									let file = lampiran.split('/');
									file = file[1];

									element += `<a href="${baseUrl}assets/uploads/attachment/${lampiran}" target="_blank"><i class="fa fa-link"></i> ${file} </a>`;
								}
							}

							$("#filenya").html(element);
						});
					})
					.catch(function(err) {
						console.error('Terjadi kesalahan saat memuat data');
						unBlockModal();
					});
			})
			.catch(function(err) {
				console.error('Terjadi kesalahan saat memuat data');
				unBlockModal();
			});
	});

	$(document).on('click', '#btn-save', function() {
		let actionType = $("#action-type").val();
		let idProject = $("#id-project").val();
		let value = $(`#${actionType}`).val();
		let note = $('#note').summernote('code');

		let config = {
			url: baseUrl + 'ajax/Ajax/update_project',
			type: 'post',
			dataType: 'json',
			data: {
				'id': idProject,
				'action': actionType,
				'value': value,
				'note': note,
				'uploaded': uploaded
			}
		}

		blockModal();

		$.ajax(config)
			.done(function(data) {
				unBlockModal();

				if (data.status == 1) {
					toastr.success(data.message);
					$("#note").summernote('code', '');
					$("#modal-update").modal('hide');

					table.ajax.reload(null, false);

					uploaded = [];

					$('.dropzone')[0].dropzone.files.forEach(function(file) { 
						file.previewElement.remove(); 
					});
					  
					$('.dropzone').removeClass('dz-started');
				} else {
					toastr.error(data.message);
				}
			})
			.fail(function(e) {
				toastr.error('Terjadi kesalahan saat menyimpan data');
				unBlockModal();
			});
	});

	$('#note').summernote({
		height: "150px",
		toolbar: [
		  	['style', ['style']],
		  	['font', ['bold', 'underline', 'clear']],
		  	['fontname', ['fontname']],
		  	['color', ['color']],
		  	['para', ['ul', 'ol', 'paragraph']]
		]
	});

	$(document).on('click', '.btn-history', function() {
		let id = $(this).data('id');

		window.open(baseUrl + 'Project/detail?id=' + id, '_blank');
	});

	function removeUploadedItem(remove) {
		var temp = [];
		if (uploaded.length > 0) {
			for (i in uploaded) {
				if (uploaded[i].token != remove) {
					temp.push(uploaded[i]);
				}
			}

			uploaded = [];
			uploaded = temp;
		}
	}

	async function uploadedItemData(token) {
		if (uploaded.length > 0) {
			for (i in uploaded) {
				if (uploaded[i].token == token) {
					return {
						folder: uploaded[i].folder,
						file_name: uploaded[i].file_name
					}
				}
			}
		}

		return false;
	}

	var uploadFile = new Dropzone('.dropzone', {
		url: baseUrl + 'ajax/Ajax/upload_attachment',
		maxFilesize: 20,
		method: "post",
		paramName: "userfile",
		addRemoveLinks: true,
		success: function(file, response) {
			var data = JSON.parse(response);
			uploaded.push(data);

			console.log(uploaded);
		}
	});

	//Event ketika Memulai mengupload
	uploadFile.on('sending', function(a,b,c){
		a.token = Math.random();
		c.append('token', a.token); //Menmpersiapkan token untuk masing masing foto
	});

	//Event ketika foto dihapus
	uploadFile.on('removedfile', function(a){
		var token = a.token;
		$.when(uploadedItemData(token))
			.done(function(data) {
				var file_name = data.file_name;
				var folder = data.folder;

				$.get(baseUrl + 'ajax/Ajax/delete_attachment?folder=' + folder + '&file_name=' + file_name, function(data) {
					var response = JSON.parse(data);

					console.log(response.message);
					removeUploadedItem(token);
					console.log(uploaded);
				});
			})
			.fail(function(e) {
				console.log('Terjadi kesalahan saat memuat data');
			});
	});

	$(document).on('click', '.btn-finish', function() {
		let id = $(this).data('id');

		Swal.fire({
            title: msg.confirmation,
            text: msg.confirm.update,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg.btn.yes,
            cancelButtonText: msg.btn.no
        }).then((result) => {
            if (result.value) {
                $.post(baseUrl + 'ajax/Ajax/finish', {'id': id})
                	.done(function(response) {
                		let data = JSON.parse(response);
                		unBlockUI();

                		if (data.status == 1) {
                			table.ajax.reload(null, false);
                			toastr.success(data.message);
                		} else {
                			toastr.error(data.message);
                		}
                	})
                	.fail(function(error) {
                		toastr.error(msg.fail.update);
                		unBlockUI();
                	});
            }
        });
	});

	$(document).on('click', '.btn-edit', function(e) {
		let id = $(this).data('id');

		window.open(baseUrl + 'Project/add?action=edit&id=' + id, '_blank');
	});

	$(document).on('click', '.btn-duplicate', function(e) {
		let id = $(this).data('id');

		window.open(baseUrl + 'Project/add?action=duplicate&id=' + id, '_blank');
	});

	$('#btn-download').click(function() {
		let keyword	= $('#keyword').val();
		window.open(baseUrl + 'Excel/sample?keyword=' + keyword + '&type=ongoing', '_blank');
	});
});