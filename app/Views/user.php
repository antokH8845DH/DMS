<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');
$success = $session->getFlashData('success');
// print_r($users);
// exit;
?>
<div class="main-content-inner">
    <div class="row">
        <div class="card my-3 col-md-8" style="max-width: 540px;">
            <?php if ($success != null) : ?>
                <div class="alert alert-success mt-2" role="success">
                    <h4 class="alert-heading">SUKSES</h4>
                    <hr>
                    <p class="mb-0">
                        Data Telah Tersimpan
                    </p>
                </div>
            <?php endif ?>
            <?php if ($errors != null) : ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <h4 class="alert-heading">Terjadi Kesalahan</h4>
                    <hr>
                    <p class="mb-0">
                        <?php
                        foreach ($errors as $err) {
                            echo $err . '<br>';
                        }
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('/image/profile/' . $session->get('avatar')) ?>" class="card-img mt-4 ml-2" alt="image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">

                        <div class="card-title mt-3">
                            <h3>PROFILE</h3>
                        </div>
                        <h5 class="card-title"><?= $session->get('username'); ?></h5>
                        <p class="card-text"><b>username : <?= $session->get('username'); ?> </p>
                        <p class="card-text"><small class="text-muted"><b>Penerbit : </b> </small></p>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit">Edit</a>
                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modalPassword">Ganti Password</a>
                        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Ganti Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('Auth/gantiProfile/' . $session->get('id')); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group mb-3 row">
                                                <label for="exampleInputPassword1" class="col-3 ml-1">Username</label>
                                                <input type="text" class="form-control col-4 ml-3" name="username" placeholder="Username" value="<?= $session->get('username'); ?>">
                                                <div class="text-danger"></div>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <!-- <div class="input-group"> -->
                                                <label for="exampleInputFile" class="col-4 ml-1">File Photo Profile</label>
                                                <div class="custom-file col-8 ml-3">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name='profile'>
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                                </div>
                                                <!-- <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div> -->
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalPassword" tabindex="-10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Ganti Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= site_url(); ?>/auth/gantiPassword" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="col-4 ml-3">Password Lama</label>
                                                <input type="password" class="col-4 ml-3" name="oldPassword">
                                                <div class="text-danger"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1 " class="col-4 ml-3">Password Baru</label>
                                                <input type="password" class="col-4 ml-3" name="newPassword">
                                                <div class="text-danger"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2" class="col-4 ml-3">Ulangi Password Baru</label>
                                                <input type="password" class="col-4 ml-3" name="repeatNewPassword">
                                                <div class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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