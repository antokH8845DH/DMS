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
<?php

endif
?>
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><?= $mobils->merek . ' ' . $mobils->type . '<br>' . $mobils->nopol ?></h6>

                        <a href="<?= site_url('vehicle/detailRutin/' . $mobils->id); ?>" type="button" class="btn btn-info btn-lg btn-block"><i class="fa fa-check"></i> RUTIN MINGGUAN</a>
                        <a href="<?= site_url('vehicle/detailMaintenance/' . $mobils->id); ?>" type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-dashboard"></i> MAINTENANCE</a>
                        <a href="<?= site_url('vehicle/detailTrouble/' . $mobils->id); ?>" type="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-wrench"></i> TROUBLE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight: 1000;">Aktifitas 1 bulan yang lalu :</h6><br>
                    <h6 class="mb-1" style="text-align:center;font-weight:900">Cek Mingguan</h6>
                    <?php if ($activities) : ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead class="text-uppercase bg-info">
                                    <tr class="text-white">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>KM</th>
                                        <th>Cek oleh</th>
                                        <th style="">Oli Mesin</th>
                                        <th>Oli Rem</th>
                                        <th>air Rad</th>
                                        <th>air Aki</th>
                                        <th>air Wip</th>
                                        <th>tali Kip</th>
                                        <th>suara Mesn</th>
                                        <th>kop-ling</th>
                                        <th>stir</th>
                                        <th>tek ban</th>
                                        <th>alur ban</th>
                                        <th>lamp</th>
                                        <th>wiper</th>
                                        <th>problem</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($activities as $index => $activity) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= ($index + 1); ?></td>
                                            <td><?= date('d-m-Y', strtotime($activity->maint_created_date)) ?></td>
                                            <td><?= $activity->km ?></td>
                                            <td><?= $activity->username ?></td>
                                            <td><?= $activity->oliMesin ?></td>
                                            <td><?= $activity->oliRem ?></td>
                                            <td><?= $activity->airRadiator ?></td>
                                            <td><?= $activity->airAki ?></td>
                                            <td><?= $activity->airWiper ?></td>
                                            <td><?= $activity->taliKipas ?></td>
                                            <td><?= $activity->suaraMesin ?></td>
                                            <td><?= $activity->kopling ?></td>
                                            <td><?= $activity->stir ?></td>
                                            <td><?= $activity->tekananBan ?></td>
                                            <td><?= $activity->alurBan ?></td>
                                            <td><?= $activity->lampu ?></td>
                                            <td><?= $activity->wiper ?></td>
                                            <td><?= $activity->problem ?></td>
                                            <td><?= $activity->action ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <h6 style="text-align: center;font-weight:600">Satu bulan terkahir Belum ada aktivitas </h6>
                    <?php endif ?>
                    <div class="clear-fix">
                        <br>
                        <h6 class="mt-2 mb-1" style="text-align: center;font-weight:900">Maintenance</h6>
                        <?php if ($maintenances) : ?>
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead class="text-uppercase bg-warning">
                                        <tr class="text-white">
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>KM</th>
                                            <th>Driver</th>
                                            <th>Detail</th>
                                            <th>Problem</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($maintenances as $index => $maintenance) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= ($index + 1); ?></td>
                                                <td><?= date('d-m-Y', strtotime($maintenance->maintenance_created_date)); ?></td>
                                                <td><?= $maintenance->km; ?></td>
                                                <td><?= $maintenance->username; ?></td>
                                                <td><?= $maintenance->detail; ?></td>
                                                <td><?= $maintenance->problem; ?></td>
                                                <td><?= $maintenance->action; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h6 style="text-align: center;font-weight:600">Satu bulan terkahir Belum ada aktivitas </h6>
                        <?php endif ?>
                    </div>
                    <div class="clear-fix">
                        <br>
                        <h6 class="mt-2 mb-1" style="text-align: center;font-weight:900">Trouble</h6>
                        <?php if ($troubles) : ?>

                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead class="text-uppercase bg-danger">
                                        <tr class="text-white">
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>KM</th>
                                            <th>Driver</th>
                                            <th>Detail</th>
                                            <th>Problem</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($troubles as $index => $trouble) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= ($index + 1); ?></td>
                                                <td><?= date('d-m-Y', strtotime($trouble->maintenance_created_date)); ?></td>
                                                <td><?= $trouble->km; ?></td>
                                                <td><?= $trouble->username; ?></td>
                                                <td><?= $trouble->detail; ?></td>
                                                <td><?= $trouble->problem; ?></td>
                                                <td><?= $trouble->action; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h6 style="text-align: center;font-weight:600">Satu bulan terkahir Belum ada aktivitas </h6>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>