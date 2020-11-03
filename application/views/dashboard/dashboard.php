<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="counter-sample-on-delivery">0</h3>
                        <p><?= lang('sample-on-delivery'); ?></p>
                    </div>
                    <a href="#card-sample-on-delivery" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="counter-sample-on-process">0</h3>
                        <p><?= lang('sample-on-process'); ?></p>
                    </div>
                    <a href="#card-sample-on-process" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="counter-sample-on-shipment">0</h3>
                        <p><?= lang('sample-on-shipment'); ?></p>
                    </div>
                    <a href="#card-sample-on-shipment" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3 id="counter-sample-finish">0</h3>
                        <p><?= lang('sample-finish'); ?></p>
                    </div>
                    <a href="#card-sample-finish" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                <div class="card bg-info" id="card-sample-on-delivery">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('sample-on-delivery') ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table m-0" id="tb-sample-on-delivery">
                                <thead>
                                    <tr>
                                        <th align="center"><?= lang('field_no'); ?></th>
                                        <th align="center"><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
                                        <th align="center"><?= lang('field_brand'); ?></th>
                                        <th align="center"><?= lang('field_kontrak'); ?></th>
                                        <th align="center"><?= lang('field_item'); ?></th>
                                        <th align="center"><?= lang('field_style'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card bg-warning" id="card-sample-on-shipment">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('sample-on-shipment') ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table m-0" id="tb-sample-on-shipment">
                                <thead>
                                    <tr>
                                        <th align="center"><?= lang('field_no'); ?></th>
                                        <th align="center"><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
                                        <th align="center"><?= lang('field_brand'); ?></th>
                                        <th align="center"><?= lang('field_kontrak'); ?></th>
                                        <th align="center"><?= lang('field_item'); ?></th>
                                        <th align="center"><?= lang('field_style'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">
                <div class="card bg-success" id="card-sample-on-process">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('sample-on-process') ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table m-0" id="tb-sample-on-process">
                                <thead>
                                    <tr>
                                        <th align="center"><?= lang('field_no'); ?></th>
                                        <th align="center"><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
                                        <th align="center"><?= lang('field_brand'); ?></th>
                                        <th align="center"><?= lang('field_kontrak'); ?></th>
                                        <th align="center"><?= lang('field_item'); ?></th>
                                        <th align="center"><?= lang('field_style'); ?></th>
                                        <th align="center"><?= lang('field_status'); ?></th>
                                        <th align="center"><?= lang('field_plan_kirim_sample'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card bg-purple" id="card-sample-finish">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('sample-finish') ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table m-0" id="tb-sample-finish">
                                <thead>
                                    <tr>
                                        <th align="center"><?= lang('field_no'); ?></th>
                                        <th align="center"><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
                                        <th align="center"><?= lang('field_brand'); ?></th>
                                        <th align="center"><?= lang('field_kontrak'); ?></th>
                                        <th align="center"><?= lang('field_item'); ?></th>
                                        <th align="center"><?= lang('field_style'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
            <!-- right col -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('title_summary') ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="row">
                             <div class="col-md-3 col-6">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">ALL</option>
                                    <option value="01">JAN</option>
                                    <option value="02">FEB</option>
                                    <option value="03">MAR</option>
                                    <option value="04">APR</option>
                                    <option value="05">MEI</option>
                                    <option value="06">JUN</option>
                                    <option value="07">JUL</option>
                                    <option value="08">AUG</option>
                                    <option value="09">SEP</option>
                                    <option value="10">OCT</option>
                                    <option value="11">NOV</option>
                                    <option value="12">DEC</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-6">
                                <input type="number" class="form-control" id="tahun" name="tahun" value="<?= date('Y'); ?>">
                            </div>

                            <div class="col-md-3 col-6">
                                <input list="lines" name="line" id="line" class="form-control" placeholder="<?= lang('line') ?>" autocomplete="off">
                                <datalist id="lines">
                                    <option value="LINE A">
                                    <option value="LINE B">
                                    <option value="LINE C">
                                    <option value="LADIES JK">
                                    <option value="LADIES PNT">
                                    <option value="LADIES SK">
                                </datalist>
                            </div>  

                            <div class="col-md-3 col-6">
                                <button type="button" class="btn btn-primary" id="btn-summary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive" style="margin-top: 30px;">
                                    <table class="table m-0" id="tb-summary">
                                        <thead>
                                            <tr>
                                                <th align="center"><?= lang('field_no'); ?></th>
                                                <th align="center"><?= lang('field_type'); ?> <br /> (<?= lang('field_jenis') ?>)</th>
                                                <th align="center"><?= lang('field_brand'); ?></th>
                                                <th align="center"><?= lang('field_kontrak'); ?></th>
                                                <th align="center"><?= lang('field_item'); ?></th>
                                                <th align="center"><?= lang('field_style'); ?></th>
                                                <th align="center"><?= lang('field_size'); ?></th>
                                                <th align="center"><?= lang('field_qty'); ?></th>
                                                <th align="center"><?= lang('line'); ?></th>
                                                <th align="center"><?= lang('field_due_date'); ?></th>
                                                <th align="center"><?= lang('field_actual_finish'); ?></th>
                                                <th align="center"><?= lang('finish'); ?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="background-color: yellow;"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>

<script>
    const excelTitle = {
        delivery: "<?= lang('sample-on-delivery'); ?>",
        process: "<?= lang('sample-on-process'); ?>",
        shipment: "<?= lang('sample-on-shipment'); ?>",
        finish: "<?= lang('sample-finish'); ?>",
        summary: "<?= lang('title_summary'); ?>"
    }
</script>