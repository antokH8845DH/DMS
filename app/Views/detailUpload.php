<?= $this->extend('layout/v_wrapper'); ?>
<?= $this->section('home'); ?>
<?php
$session = session();
$success = $session->getFlashData('success');
$errors = $session->getFlashData('errors');
// print_r($maintenances);
// dd($maintenances);
?>
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-1">
            <div class="card col-12">
                <?php foreach ($uploads as $upload) : ?>
                    <div class="card col-4 mt-2 mb-2">
                        <a href="" class="" data-toggle="modal" data-target="#modalView<?= $upload->id_upload ?>">
                            <img src="<?= base_url('/image/upload/' . $upload->image) ?>" class="img-thumbnail" width="200px">
                        </a>
                        <div class="modal fade" id="modalView<?= $upload->id_upload ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalCenterTitle"><?= $upload->original; ?></h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="col-12">
                                                <img src="<?= base_url('/image/upload/' . $upload->image) ?>" class="card-img mt-2 mb-2 mx-1" size="200px" alt="image">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>