<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');
?>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h3 style="text-align: center;" class="mt-2 mb-4">Pilih Mobil</h3>
                    <?php foreach ($mobils as $index => $mobil) : ?>
                        <a href="<?= site_url('vehicle/detail/' . $mobil->id); ?>" type="button" class="btn btn-outline-success btn-lg btn-block"><i class="fa fa-car"></i> <?= $mobil->nopol . '<br>' . $mobil->merek . ' ' . $mobil->type . ' ' . $mobil->jenis; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>