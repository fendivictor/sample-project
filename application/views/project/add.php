<div class="card card-primary card-outline">
	<div class="card-header">
		<h3 class="card-title"><?= lang('menu_add_project'); ?></h3>
	</div>
	<div class="card-body">
		<form id="form-data" class="row" action="#">
			<div class="col-md-3">
				<div class="form-group">	
					<input type="hidden" name="id" id="id" value="<?= isset($id) ? $id : ''; ?>">
					<label for=""><?= lang('field_jenis'); ?> <span class="text-danger">*</span></label>
					<?= form_dropdown('type', $opt_jenis, isset($data->type) ? $data->type : '', 'id="type" class="form-control" required="required"'); ?>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_brand'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="brand" name="brand" required="required" autocomplete="off" value="<?= isset($data->brand) ? $data->brand : ''; ?>">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_kontrak'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="kontrak" name="kontrak" required="required" autocomplete="off" value="<?= isset($data->kontrak) ? $data->kontrak : ''; ?>">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_item'); ?> <span class="text-danger">*</span></label>
					<?= form_dropdown('item', $opt_item, isset($data->item) ? $data->item : '', 'id="item" class="form-control" required="required"'); ?>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_style'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="style" name="style" required="required" autocomplete="off" value="<?= isset($data->style) ? $data->style : ''; ?>">
				</div>
			</div>

			<div class="col-md-12">
				<label for=""><?= lang('field_pattern'); ?></label>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_nopattern'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="no-pattern" name="no-pattern" required="required" autocomplete="off" value="<?= isset($data->no_pattern) ? $data->no_pattern : ''; ?>">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">	
					<label for=""><?= lang('field_order'); ?> <span class="text-danger">*</span></label>
					<?= form_dropdown('order-type', $opt_order, isset($data->order) ? $data->order : '', 'id="order-type" class="form-control" required="required"'); ?>
				</div>
			</div>

			<div class="col-md-12"></div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_size'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="size" name="size" required="required" autocomplete="off" value="<?= isset($data->size) ? $data->size : ''; ?>">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_qty'); ?> <span class="text-danger">*</span></label>
					<input type="number" class="form-control" id="qty" name="qty" required="required" autocomplete="off" value="<?= isset($data->qty) ? $data->qty : ''; ?>">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_price'); ?> <span class="text-danger">*</span></label>
					<input type="number" class="form-control" id="price" name="price" required="required" autocomplete="off" step="any" value="<?= isset($data->price) ? $data->price : ''; ?>">
				</div>
			</div>

			<div class="col-md-12"></div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_due_date'); ?> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="due-date" name="due-date" required="required" autocomplete="off" value="<?= isset($data->due_date) ? custom_date_format($data->due_date, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for=""><?= lang('field_tujuan_sample'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="tujuan-sample" name="tujuan-sample" required="required" autocomplete="off" value="<?= isset($data->tujuan_sample) ? $data->tujuan_sample : ''; ?>">
				</div>
			</div>


			<div class="col-md-12"></div>

			<?php if ($action == 'duplicate') { ?>
			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_tec_sheet') ?> <small>(<?= lang('field_plan_kirim') ?>)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="tec-plan-kirim" name="tec-plan-kirim" required="required" autocomplete="off" value="<?= isset($data->tec_sheet_plan) ? custom_date_format($data->tec_sheet_plan, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_tec_sheet') ?> <small>(<?= lang('field_actual_kirim') ?>)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="tec-actual-kirim" name="tec-actual-kirim" required="required" autocomplete="off" value="<?= isset($data->tec_sheet_actual) ? custom_date_format($data->tec_sheet_actual, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_pattern') ?> <small>(<?= lang('field_plan_kirim') ?>)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="pattern-plan-kirim" name="pattern-plan-kirim" required="required" autocomplete="off" value="<?= isset($data->pattern_plan) ? custom_date_format($data->pattern_plan, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_pattern') ?> <small>(<?= lang('field_actual_kirim') ?>)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="pattern-actual-kirim" name="pattern-actual-kirim" required="required" autocomplete="off" value="<?= isset($data->pattern_actual) ? custom_date_format($data->pattern_actual, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_material_fabric') ?> <small>(<?= lang('field_kirim_dhl') ?>)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="fabric-plan-kirim" name="fabric-plan-kirim" required="required" autocomplete="off" value="<?= isset($data->fabric_plan) ? custom_date_format($data->fabric_plan, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_material_aksesories') ?> <small>(<?= lang('field_kirim_dhl') ?>)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="aksesories-plan-kirim" name="aksesories-plan-kirim" required="required" autocomplete="off" value="<?= isset($data->aksesories_plan) ? custom_date_format($data->aksesories_plan, 'Y-m-d', 'd/m/Y') : ''; ?>">
                	</div>
				</div>
			</div>
			<?php } ?>

			<div class="col-md-12">
				<button class="btn btn-primary" name="save-btn">
					<i class="fa fa-check"></i> <?= lang('btn_save'); ?>
				</button>
				<button type="button" id="back-btn" class="btn btn-warning">
					<i class="fa fa-arrow-left"></i> <?= lang('btn_back'); ?>
				</button>
			</div>
		</form>
	</div>
</div>