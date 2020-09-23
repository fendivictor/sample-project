<style>
	.table-header-style {
		text-align: center !important; 
		vertical-align: middle !important;
	}

	.japan {
		background-color: #edab85;
	}

	.indonesia {
		background-color: #aee8b1;
	}
</style>

<div class="card card-primary card-outline">
	<div class="card-header">
		<h3 class="card-title"><?= lang('menu_project_list'); ?></h3>
	</div> <!-- /.card-body -->
	<div class="card-body">
		<div class="row" style="margin-top: 20px;">
			<div class="col-md-3">
				<div class="form-group">
	                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="<?= lang('field_keyword') ?>..." />
	            </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<button class="btn btn-primary" id="btn-tampil"><i class="fas fa-search"></i> <?= lang('btn_show'); ?></button>
					<button class="btn btn-success" id="btn-download"><i class="fas fa-download"></i> <?= lang('btn_download'); ?></button>
				</div>
			</div>

			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-stripped" id="dt-table">
						<thead>
							<tr>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_no'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_style'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_brand'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_kontrak'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_item'); ?></th>
								<th colspan="2" class="table-header-style japan"><?= lang('field_pattern'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_size'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_qty'); ?> (<?= lang('field_pce'); ?>)</th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_price'); ?></th>
								<th colspan="2" class="table-header-style japan"><?= lang('field_tec_sheet'); ?></th>
								<th colspan="2" class="table-header-style japan"><?= lang('field_pattern') ?></th>
								<th colspan="2" class="table-header-style japan"><?= lang('field_material_fabric') ?></th>
								<th colspan="2" class="table-header-style japan"><?= lang('field_material_aksesories') ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_tujuan_sample'); ?></th>
								<th rowspan="2" class="table-header-style japan"><?= lang('field_due_date'); ?></th>
								<th colspan="2" class="table-header-style indonesia"><?= lang('field_plan_kirim_sample'); ?></th>
								<th rowspan="2" class="table-header-style indonesia"><?= lang('master_code') ?></th>
								<th rowspan="2" class="table-header-style indonesia"><?= lang('line'); ?></th>
								<th colspan="2" class="table-header-style indonesia"><?= lang('field_persiapan_produksi'); ?></th>
								<th colspan="2" class="table-header-style indonesia"><?= lang('field_cad'); ?></th>
								<th colspan="2" class="table-header-style indonesia"><?= lang('field_cutting'); ?></th>
								
								<th colspan="2" class="table-header-style indonesia"><?= lang('field_sewing_inspect'); ?></th>
								<th colspan="2" class="table-header-style indonesia"><?= lang('field_masuk_finish_good'); ?></th>
								<th rowspan="2" class="table-header-style indonesia"><?= lang('keterangan'); ?></th>
								<th rowspan="2" class="table-header-style indonesia"><i class="fa fa-bars"></i></th>
							</tr>
							<tr>
								<th class="table-header-style japan"><?= lang('field_nopattern'); ?></th>
								<th class="table-header-style japan"><?= lang('field_order'); ?></th>
								<th class="table-header-style japan"><?= lang('field_plan_kirim'); ?></th>
								<th class="table-header-style japan"><?= lang('field_actual_kirim'); ?></th>
								<th class="table-header-style japan"><?= lang('field_plan_kirim'); ?></th>
								<th class="table-header-style japan"><?= lang('field_actual_kirim'); ?></th>
								<th class="table-header-style japan"><?= lang('field_kirim_dhl'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_tgl_kedatangan'); ?></th>
								<th class="table-header-style japan"><?= lang('field_kirim_dhl'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_tgl_kedatangan'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_plan_kirim_v2'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_actual'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_finish_plan') ?></th>
								<th class="table-header-style indonesia"><?= lang('field_actual_finish'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_finish_plan') ?></th>
								<th class="table-header-style indonesia"><?= lang('field_actual_finish'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_finish_plan') ?></th>
								<th class="table-header-style indonesia"><?= lang('field_actual_finish'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_finish_plan') ?></th>
								<th class="table-header-style indonesia"><?= lang('field_actual_finish'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_plan'); ?></th>
								<th class="table-header-style indonesia"><?= lang('field_actual'); ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-update">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title"><?= lang('form_update'); ?></h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body">
              	<div class="row">
              		<div class="col-md-12">
              			<input type="hidden" name="action-type" id="action-type">
              			<input type="hidden" name="id-project" id="id-project">
              			<div class="form-group">
              				<div id="form"></div>
              			</div>
              		</div>
              		<div class="col-md-12">
              			<div class="form-group">
              				<label for=""><?= lang('form_attachment'); ?></label>
              				<div class="attachment dropzone">
							  	<div class="dz-message">
							   		<h5><?= lang('form_drop'); ?></h5>
							  	</div>
							</div>
              			</div>
              		</div>
              		<div class="col-md-12">
              			<div class="form-group">
              				<label for=""><?= lang('form_note'); ?></label>
              				<textarea name="note" id="note" cols="5" rows="5" class="form-control"></textarea>
              			</div>
              		</div>
              		<div class="col-md-12">
              			<button type="button" id="btn-save" class="btn btn-info">
              				<i class="fa fa-check"></i> <?= lang('btn_save') ?>
              			</button>
              		</div>
              	</div>
            </div>
        </div>
    </div>
</div>

<div id="is-mobile" data-value="<?= $mobile; ?>"></div>