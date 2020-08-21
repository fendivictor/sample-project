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
				</div>
			</div>

			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-stripped" id="dt-table">
						<thead>
							<tr>
								<th><?= lang('field_no'); ?></th>
								<th><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
								<th><?= lang('field_brand'); ?></th>
								<th><?= lang('field_kontrak'); ?></th>
								<th><?= lang('field_item'); ?></th>
								<th><?= lang('field_style'); ?></th>
								<th>UPDATE</th>
								<th>VALUE</th>
								<th>UPDATED AT</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>