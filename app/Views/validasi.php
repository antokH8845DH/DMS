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
        <div class="col-12 mt-2">
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
            <?php if ($success != null) : ?>
                <div class="alert alert-success mt-2" role="success">
                    <h4 class="alert-heading">SUKSES</h4>
                    <hr>
                    <p class="mb-0">
                        Data Telah Tervalidasi
                    </p>
                </div>
            <?php endif ?>

        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight: 1000;">LIST AKTIFITAS YANG BELUM TERVALIDASI</h6><br>
                    <h6 class="mb-1" style="text-align:center;font-weight:900">Cek Mingguan</h6>
                    <?php if ($ceks) : ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead class="text-uppercase bg-info">
                                    <tr class="text-white">
                                        <th>No</th>
                                        <th>Mobil</th>
                                        <th>Tanggal</th>
                                        <th>KM</th>
                                        <th>Cek oleh</th>
                                        <th>Oli Mesin</th>
                                        <th>Oli Rem</th>
                                        <th>air Rad</th>
                                        <th>air Aki</th>
                                        <th>air Wip</th>
                                        <th>tali Kip</th>
                                        <th>suara Mesn</th>
                                        <th>kop-ling</th>
                                        <th>stir</th>
                                        <th>ban</th>
                                        <th>lamp</th>
                                        <th>wiper</th>
                                        <th>tool-kit</th>
                                        <th>Body</th>
                                        <th>inte-rior</th>
                                        <th>problem</th>
                                        <th>action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ceks as $index => $cek) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= ($index + 1); ?></td>
                                            <td><?= $cek->merek . ' ' . $cek->type ?></td>
                                            <td><?= date('d-m-Y', strtotime($cek->maint_created_date)) ?></td>
                                            <td><?= $cek->km ?></td>
                                            <td><?= $cek->username ?></td>
                                            <td><?= $cek->oliMesin ?></td>
                                            <td><?= $cek->oliRem ?></td>
                                            <td><?= $cek->airRadiator ?></td>
                                            <td><?= $cek->airAki ?></td>
                                            <td><?= $cek->airWiper ?></td>
                                            <td><?= $cek->taliKipas ?></td>
                                            <td><?= $cek->suaraMesin ?></td>
                                            <td><?= $cek->kopling ?></td>
                                            <td><?= $cek->stir ?></td>
                                            <td><?= $cek->ban ?></td>
                                            <td><?= $cek->lampu ?></td>
                                            <td><?= $cek->wiper ?></td>
                                            <td><?= $cek->toolkit ?></td>
                                            <td><?= $cek->body ?></td>
                                            <td><?= $cek->interior ?></td>
                                            <td><?= $cek->problem ?></td>
                                            <td><?= $cek->action ?></td>
                                            <td><a href="" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalValidasi3<?= $cek->idCek ?>">Validasi</a>
                                                <div class="modal fade" id="modalValidasi3<?= $cek->idCek ?>" tabindex="-10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Aktifitas divalidasi??</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="<?= site_url('/validasi/valCek/' . $cek->idCek); ?>" method="POST">
                                                                <div class="modal-body" style="text-align: left;">
                                                                    <p>Cek Mingguan <?= $cek->merek . ' ' . $cek->type ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-success">Validasi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <h6 style="text-align: center;font-weight:600">semua aktivitas CEK MINGGUAN sudah tervalidasi</h6>
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
                                            <th>Mobil</th>
                                            <th>Tanggal</th>
                                            <th>KM</th>
                                            <th>Driver</th>
                                            <th>Detail</th>
                                            <th>Problem</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($maintenances as $index => $maintenance) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= ($index + 1); ?></td>
                                                <td><?= $maintenance->merek . ' ' . $maintenance->type; ?></td>
                                                <td><?= date('d-m-Y', strtotime($maintenance->tanggal)); ?></td>
                                                <td><?= $maintenance->km; ?></td>
                                                <td><?= $maintenance->username; ?></td>
                                                <td><?= $maintenance->detail; ?></td>
                                                <td><?= $maintenance->problem; ?></td>
                                                <td><?= $maintenance->action; ?></td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalValidasi<?= $maintenance->id_maint ?>">Validasi</a>
                                                    <div class="modal fade" id="modalValidasi<?= $maintenance->id_maint ?>" tabindex="-10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Aktifitas divalidasi??</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="<?= site_url('/validasi/valMaint/' . $maintenance->id_maint); ?>" method="POST">
                                                                    <div class="modal-body" style="text-align: left;">
                                                                        <p><?= $maintenance->merek . ' ' . $maintenance->type;; ?></p>
                                                                        <p>Problem : <?= $maintenance->problem; ?></p>
                                                                        <p>Action : <?= $maintenance->action; ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-success">Validasi</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h6 style="text-align: center;font-weight:600">semua aktivitas MAINTENANCE sudah tervalidasi</h6>
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
                                            <th>Mobil</th>
                                            <th>Tanggal</th>
                                            <th>KM</th>
                                            <th>Driver</th>
                                            <th>Detail</th>
                                            <th>Problem</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($troubles as $index => $trouble) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= ($index + 1); ?></td>
                                                <td><?= $trouble->merek . ' ' . $trouble->type; ?></td>
                                                <td><?= date('d-m-Y', strtotime($trouble->tanggal)); ?></td>
                                                <td><?= $trouble->km; ?></td>
                                                <td><?= $trouble->username; ?></td>
                                                <td><?= $trouble->detail; ?></td>
                                                <td><?= $trouble->problem; ?></td>
                                                <td><?= $trouble->action; ?></td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalValidasi1<?= $trouble->id_maint ?>">validasi</a>
                                                    <div class="modal fade" id="modalValidasi1<?= $trouble->id_maint ?>" tabindex="-10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Aktifitas divalidasi??</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="<?= site_url('/validasi/valMaint/' . $trouble->id_maint); ?>" method="POST">
                                                                    <div class="modal-body" style="text-align: left;">
                                                                        <p><?= $trouble->merek . ' ' . $trouble->type; ?></p>
                                                                        <p>Problem : <?= $trouble->problem; ?></p>
                                                                        <p>Action : <?= $trouble->action; ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-success">Validasi</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h6 style="text-align: center;font-weight:600">semua aktivitas TROUBLE sudah tervalidasi</h6>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>