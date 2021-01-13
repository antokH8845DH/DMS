<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');
?>
<div class="main-content-inner">
    <div class="row">
        <div class="card my-3 col-md-8" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('/assets/images/author/avatar.png'); ?>" class="card-img mt-4 ml-2" alt="image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="card-title mt-3">
                            <h3>PROFILE</h3>
                        </div>
                        <h5 class="card-title"><?= $session->get('username'); ?></h5>
                        <p class="card-text"><b>username : <?= $session->get('username'); ?> </p>
                        <p class="card-text"><small class="text-muted"><b>Penerbit : </b> </small></p>
                        <a href="" class="btn btn-warning">Edit</a>
                        <a href="" class="btn btn-danger">Ganti Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>