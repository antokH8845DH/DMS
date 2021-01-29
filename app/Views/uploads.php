<?= $this->extend('layout/v_wrapper'); ?>
<?= $this->section('home'); ?>
<?php
$session = session();
$success = $session->getFlashData('success');
$errors = $session->getFlashData('errors');
// print_r($maintenances);
// dd($maintenances);
?>

<H2>MULTIPLE UPLOAD</H2>
<div class="card">
    <div class="card-body">
        <form class="" method="POST" enctype="multipart/form-data" action="<?= site_url('/Home/image'); ?>">
            <div class="form-group mb-3 row">
                <!-- <div class="input-group"> -->
                <label for="exampleInputFile" class="col-4 ml-1">Tambah Foto</label>
                <div class="custom-file col-8 ml-3">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name='upload[]' multiple="multiple">
                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                </div>
                <!-- <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div> -->
                <!-- </div> -->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<!-- bs-custom-file-input -->
<script src="<?= base_url(''); ?>/assets/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
<?= $this->endSection(); ?>