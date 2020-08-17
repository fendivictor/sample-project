<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $total_sample ?></h3>
                        <p>Total Sample</p>
                    </div>
                    <a href="javascript:;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('progress_sample') ?></h3>
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
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th><?= lang('field_kontrak'); ?></th>
                                        <th><?= lang('field_jenis'); ?></th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                        if ($progress) {
                                            foreach ($progress as $row) {
                                                echo '
                                                    <tr>
                                                        <td>'.$row->kontrak.'</td>
                                                        <td>'.$row->type.'</td>
                                                        <td><span class="badge badge-success" style="font-size: 13px">'.lang($row->status).'</span></td>
                                                    </tr>
                                                ';
                                            }
                                        }
                                     ?>
                                </tbody>
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
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><?= lang('sample_delivery') ?></h3>
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
                    <div class="card-body row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""><?= lang('bulan') ?></label>
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="01">JAN</option>
                                    <option value="02">FEB</option>
                                    <option value="03">MAR</option>
                                    <option value="04">APR</option>
                                    <option value="05">MAY</option>
                                    <option value="06">JUN</option>
                                    <option value="07">JUL</option>
                                    <option value="08">AUG</option>
                                    <option value="09">SEP</option>
                                    <option value="10">OCT</option>
                                    <option value="11">NOV</option>
                                    <option value="12">DEC</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">    
                                <label for=""><?= lang('tahun') ?></label>
                                <input type="number" name="tahun" id="tahun" class="form-control" value="<?= date('Y') ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="button" class="btn btn-primary" id="show-monthly"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table m-0" id="tb-delivery">
                                <thead>
                                    <tr>
                                        <th><?= lang('field_kontrak'); ?></th>
                                        <th><?= lang('field_jenis'); ?></th>
                                        <th><?= lang('delivery_date') ?></th>
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
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="event-calendar"></div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>