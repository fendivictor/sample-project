<div class="card card-primary card-outline">
	<div class="card-header">
		<h3 class="card-title"><?= lang('menu_add_project'); ?></h3>
	</div>
	<div class="card-body">
		<form id="form-data" class="row" action="#">
			<div class="col-md-3">
				<div class="form-group">	
					<label for=""><?= lang('field_jenis'); ?> <span class="text-danger">*</span></label>
					<select name="type" id="type" class="form-control" required="required">
						<option value="LADIES">LADIES</option>
						<option value="MENS">MENS</option>
					</select>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_brand'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="brand" name="brand" required="required" autocomplete="off">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_kontrak'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="kontrak" name="kontrak" required="required" autocomplete="off">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_item'); ?> <span class="text-danger">*</span></label>
					<select name="item" id="item" class="form-control" required="required">
						<option value="JK">JK</option>
						<option value="PNT">PNT</option>
						<option value="SK">SK</option>
						<option value="2P">2P</option>
						<option value="2PP">2PP</option>
						<option value="3P">3P</option>
						<option value="PNT ONLY">PNT ONLY</option>
						<option value="JK ONLY">JK ONLY</option>
					</select>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_style'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="style" name="style" required="required" autocomplete="off">
				</div>
			</div>

			<div class="col-md-12">
				<label for=""><?= lang('field_pattern'); ?></label>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_nopattern'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="no-pattern" name="no-pattern" required="required" autocomplete="off">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">	
					<label for=""><?= lang('field_order'); ?> <span class="text-danger">*</span></label>
					<select name="order-type" id="order-type" class="form-control" required="required">
						<option value="NEW">NEW</option>
						<option value="REPEAT">REPEAT</option>
					</select>
				</div>
			</div>

			<div class="col-md-12"></div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_size'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="size" name="size" required="required" autocomplete="off">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_qty'); ?> <span class="text-danger">*</span></label>
					<input type="number" class="form-control" id="qty" name="qty" required="required" autocomplete="off">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_price'); ?> <span class="text-danger">*</span></label>
					<input type="number" class="form-control" id="price" name="price" required="required" autocomplete="off" step="any">
				</div>
			</div>

			<div class="col-md-12"></div>

			<!-- <div class="col-md-3">
				<div class="form-group">
					<label for="">TEC. SHEET <small>(PLAN KIRIM)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="tec-plan-kirim" name="tec-plan-kirim" required="required" autocomplete="off">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for="">PATTERN <small>(PLAN KIRIM)</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="pattern-plan-kirim" name="pattern-plan-kirim" required="required" autocomplete="off">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for="">MATERIAL (FABRIC) <small>(TGL KIRIM (DHL))</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="fabric-plan-kirim" name="fabric-plan-kirim" required="required" autocomplete="off">
                	</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label for="">MATERIAL (AKSESORIES) <small>(TGL KIRIM (DHL))</small> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="aksesories-plan-kirim" name="aksesories-plan-kirim" required="required" autocomplete="off">
                	</div>
				</div>
			</div> -->

			<div class="col-md-12"></div>

			<div class="col-md-3">
				<div class="form-group">
					<label for=""><?= lang('field_due_date'); ?> <span class="text-danger">*</span></label>
					<div class="input-group date" data-target-input="nearest">
                  		<input type="text" class="form-control" id="due-date" name="due-date" required="required" autocomplete="off">
                	</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for=""><?= lang('field_tujuan_sample'); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="tujuan-sample" name="tujuan-sample" required="required" autocomplete="off">
				</div>
			</div>

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