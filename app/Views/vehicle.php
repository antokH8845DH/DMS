<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');
$success = $session->getFlashData('success');

?>

<div class="main-content-inner">
    <div class="row">

        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
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
                                <?= $success; ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <h4 class="header-title"></h4>
                    <div class="single-table">
                        <h5 style="text-align: center;" class="mt-2 mb-4">LIST KENDARAAN</h5>
                        <button type="button" class="btn btn-outline-info btn-sm mb-4" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-truck"></i> Tambah</button>
                        <div class="modal fade" id="exampleModalLong">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Kendaraan</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Masukan Kendaraan seusai dengan STNK</p>
                                        <form action="<?= site_url(); ?>/Vehicle/add" method="POST">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nopol</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" placeholder="Nomor Plat" name="nopol">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Merek</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" placeholder="Merek Kendaraan" name="merek">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Type</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" placeholder="Type Kendaraan" name="type">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Jenis</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" placeholder="Jenis Kendaraan" name="jenis">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tahun</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" placeholder="Tahun Pembuatan" name="th_perakitan">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tanggal STNK</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="date" id="example-date-input" name="tgl_stnk">
                                                </div>
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
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-info">
                                <tr class="text-white">
                                    <th>No</th>
                                    <th>Nopol</th>
                                    <th>Mobil</th>
                                    <th>Tanggal STNK</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vehicles as $index => $mobil) : ?>
                                    <tr>
                                        <td style="text-align: center;"><?= ($index + 1); ?></td>
                                        <td><?= $mobil->nopol ?></td>
                                        <td><?= $mobil->merek . ' ' . $mobil->type . '<br>' . $mobil->jenis . '<br>Tahun : ' . $mobil->th_perakitan; ?></td>
                                        <td><?= $mobil->tgl_stnk ?></td>
                                        <td><a href="" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#modalEdit<?= $mobil->id ?>">EDIT</a>
                                            <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#modalDelete1<?= $mobil->id ?>">Hapus</a>
                                            <div class="modal fade" id="modalDelete1<?= $mobil->id ?>" tabindex="-10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Yakin Data akan dihapus??</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= site_url('/vehicle/delVehicle/' . $mobil->id); ?>" method="POST">
                                                            <div class="modal-body" style="text-align: left;">
                                                                <p>Nopol : <?= $mobil->nopol . '<br>' . $mobil->merek . ' ' . $mobil->type . '<br>' . $mobil->jenis . '<br>Tahun : ' . $mobil->th_perakitan; ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Ya Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modalEdit<?= $mobil->id ?>" tabindex="-10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">EDIT KENDARAAN</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= site_url('/vehicle/editVehicle/' . $mobil->id); ?>" method="POST">
                                                            <div class="modal-body" style="text-align: left;">
                                                                <p>Masukan Kendaraan seusai dengan STNK</p>
                                                                <form action="<?= site_url(); ?>/Vehicle/editVehicle" method="POST">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Nopol</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" class="form-control" placeholder="Nomor Plat" name="nopol" value="<?= $mobil->nopol; ?>">
                                                                            <!-- <input hidden type="text" class="form-control" placeholder="ID" name="id mobil" value="<?= $mobil->id; ?>"> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Merek</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" class="form-control" placeholder="Merek Kendaraan" name="merek" value="<?= $mobil->merek; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Type</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" class="form-control" placeholder="Type Kendaraan" name="type" value="<?= $mobil->type; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Jenis</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" class="form-control" placeholder="Jenis Kendaraan" name="jenis" value="<?= $mobil->jenis; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Tahun</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" class="form-control" placeholder="Tahun Pembuatan" name="th_perakitan" value="<?= $mobil->th_perakitan; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Tanggal STNK</label>
                                                                        <div class="col-sm-7">
                                                                            <input class="form-control" type="date" id="example-date-input" name="tgl_stnk" value="<?= $mobil->tgl_stnk; ?>">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success">Simpan</button>
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
                </div>
            </div>
        </div>
    </div>
</div>


</div>
</div>
<?= $this->endSection(); ?>