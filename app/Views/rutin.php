<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');

?>
<?php if ($errors != null) : ?>
    <div class="alert alert-danger" role="alert">
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
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h3>RUTIN PAGE</h3>
                    <h3 style="text-align: center;" class="mt-2 mb-4">Pilih Mobil</h3>
                    <?php foreach ($mobils as $index => $mobil) : ?>
                        <a href="<?= site_url('vehicle/detailRutin/' . $mobil->id); ?>" type="button" class="btn btn-info btn-lg btn-block"><i class="fa fa-check"></i> <?= $mobil->nopol . '<br>' . $mobil->merek . ' ' . $mobil->type . ' ' . $mobil->jenis; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>