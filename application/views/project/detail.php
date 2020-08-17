<?php  
    if ($header) {
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= lang('menu_sample_detail'); ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row">
                    <div class="col-12">
                        <h4><?= lang('recent_activity'); ?></h4>
                        
                            <?php  
                                if ($group_date) {
                                    echo '<div class="timeline timeline-inverse">';
                                    foreach ($group_date as $dt) {
                                        echo '  <div class="time-label">
                                                    <span class="bg-success">
                                                    '.custom_date_format($dt->tgl, 'Y-m-d', 'd M. Y').'
                                                    </span>
                                                </div>';

                                        $data = $this->Project_Model->project_date($id_project, $dt->tgl);

                                        if ($data) {
                                            foreach ($data as $row) {
                                                echo '  <div>
                                                            <i class="fas fa-plus bg-success"></i>

                                                            <div class="timeline-item">
                                                                <span class="time"><i class="far fa-clock"></i> '.custom_date_format($row->insert_at, 'Y-m-d H:i:s', 'd/m/Y H:i').'</span>

                                                                <h3 class="timeline-header">'.$row->profile_name.'</h3>

                                                                <div class="timeline-body">
                                                                    <p>
                                                                        '.lang($row->field).' <br />
                                                                        <b>'.$row->value.'</b>
                                                                    </p>';

                                                $attachment = $this->Project_Model->project_attachment($row->id_project_d);
                                                if ($attachment) {
                                                    foreach ($attachment as $attch) {
                                                        $lampiran = explode('/', $attch->lampiran);
                                                        $filename = end($lampiran);

                                                        echo '<a href="'.base_url('assets/uploads/attachment/'.$attch->lampiran).'" target="_blank"><i class="fa fa-link"></i> '.$filename.' </a> <br />';
                                                    }
                                                }

                                                if ($row->description != '') {
                                                    echo 'Note: <br /> '.$row->description;
                                                }

                                                echo '
                                                                </div>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                    }

                                    echo '      <div>
                                                    <i class="far fa-clock bg-gray"></i>
                                                </div>
                                            </div>';
                                } else {
                                    echo '<h5>Belum ada data</h5>';
                                }
                            ?>
                            
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> <?= $header->type.' '.$header->brand ?></h3>
                <p class="text-muted"><?= $header->style.' ('.$header->item.') '; ?></p>
                <div class="text-muted">
                    <p class="text-sm"><?= $header->no_pattern ?> <sup>(<?= $header->order ?>)</sup>
                        <b class="d-block"><?= isset($header->insert_at) ? custom_date_format($header->insert_at, 'Y-m-d H:i:s', 'd/m/Y H:i') : ''; ?></b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<?php 
    }
?>