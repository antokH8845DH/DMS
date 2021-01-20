<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');
$id_user = $session->get('id');

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
<?php endif;
// print_r($maintMesin) . '<br>' .
// print_r($maintBody) . '<br>' .
//     print_r($maintKaki) . '<br>' .
//     exit;
?>
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">EDIT MAINTENANCE</h4>
                    <h6><?= $mobils->merek . ' ' . $mobils->type . '<br>' . $mobils->nopol ?></h6>
                    <p></p>
                    <hr>
                    <div id="accordion5" class="according accordion-s2 gradiant-bg">
                        <form action="<?= site_url(); ?>/Vehicle/editMaintenance/<?= $maint->no_form; ?>" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:800">ID</label>
                                <div class="col-sm-2">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="id_mobil" value="<?= $mobils->id; ?>">
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label class="col-sm-1 mt-1 col-form-label" style="font-weight:800">KiloMeter</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control col-sm-4" placeholder="" name="km" value="<?= $maint->km; ?>">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="id_user" value="<?= $id_user ?>">
                                    <input hidden type="text" class="form-control" placeholder="status 1=> Maintenance" name="status" value="1">
                                    <input hidden type="text" class="form-control" placeholder="no form" name="no_form" value="<?= $maint->no_form; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-1 mt-1 col-form-label">Tanggal</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="date" id="example-date-input" name="tanggal" value="<?= $maint->tanggal; ?>">
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#accordion51">MESIN</a>
                                </div>
                                <div id="accordion51" class="collapse show" data-parent="#accordion5">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <input type="text" class="form-control" placeholder="cek created date" name="cekMesin" value="<?php if ($maintMesin) {
                                                                                                                                                echo '1';
                                                                                                                                            } else {
                                                                                                                                                echo '0';
                                                                                                                                            } ?>">
                                            <input type="text" class="form-control" placeholder="id maintenance" name="id_maint_mesin" value="<?php if ($maintMesin) {
                                                                                                                                                    echo $maintMesin->id_maint;
                                                                                                                                                } else {
                                                                                                                                                }  ?>">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="problem_mesin"><?php if ($maintMesin) {
                                                                                                                                                    echo $maintMesin->problem;
                                                                                                                                                } else {
                                                                                                                                                }  ?></textarea>
                                                <input type="text" class="form-control" placeholder="detail" name="detailMesin" value="Mesin">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_mesin"><?php if ($maintMesin) {
                                                                                                                                                    echo $maintMesin->action;
                                                                                                                                                } else {
                                                                                                                                                }  ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#accordion52">BODY</a>
                                </div>
                                <div id="accordion52" class="collapse" data-parent="#accordion5">
                                    <div class="card-body">
                                        <div class="form-group row">

                                            <input type="text" class="form-control" placeholder="cek created date" name="cekBody" value="<?php if ($maintBody) {
                                                                                                                                                echo '1';
                                                                                                                                            } else {
                                                                                                                                                echo '0';
                                                                                                                                            } ?>">
                                            <input type="text" class="form-control" placeholder="id maintenance body" name="id_maint_body" value="<?php if ($maintBody) {
                                                                                                                                                        echo $maintBody->id_maint;
                                                                                                                                                    } else {
                                                                                                                                                    }  ?>">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem_body"><?php if ($maintBody) {
                                                                                                                                                    echo $maintBody->problem;
                                                                                                                                                } else {
                                                                                                                                                }  ?></textarea>
                                                <input type="text" class="form-control" placeholder="detail" name="detailBody" value="Body">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_body"><?php if ($maintBody) {
                                                                                                                                                echo $maintBody->action;
                                                                                                                                            } else {
                                                                                                                                            }  ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link " data-toggle="collapse" href="#accordion53">KAKI-KAKI</a>
                                </div>
                                <div id="accordion53" class="collapse" data-parent="#accordion5">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <input type="text" class="form-control" placeholder="cek created date" name="cekKaki" value="<?php if ($maintKaki) {
                                                                                                                                                echo '1';
                                                                                                                                            } else {
                                                                                                                                                echo '0';
                                                                                                                                            } ?>">
                                            <input type="text" class="form-control" placeholder="id maintenance kaki" name="id_maint_kaki" value="<?php if ($maintKaki) {
                                                                                                                                                        echo $maintKaki->id_maint;
                                                                                                                                                    } else {
                                                                                                                                                    }  ?>">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem_kaki"><?php if ($maintKaki) {
                                                                                                                                                    echo $maintKaki->problem;
                                                                                                                                                } else {
                                                                                                                                                }  ?></textarea>
                                                <input type="text" class="form-control" placeholder="detail" name="detailKaki" value="Kaki-Kaki">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_kaki"><?php if ($maintKaki) {
                                                                                                                                                echo $maintKaki->action;
                                                                                                                                            } else {
                                                                                                                                            }  ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#accordion54">KELISTRIKAN</a>
                                </div>
                                <div id="accordion54" class="collapse" data-parent="#accordion5">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <input type="text" class="form-control" placeholder="cek created date" name="cekListrik" value="<?php if ($maintListrik) {
                                                                                                                                                echo '1';
                                                                                                                                            } else {
                                                                                                                                                echo '0';
                                                                                                                                            } ?>">
                                            <input type="text" class="form-control" placeholder="id maintenance" name="id_maint_listrik" value="<?php if ($maintListrik) {
                                                                                                                                                    echo $maintListrik->id_maint;
                                                                                                                                                } else {
                                                                                                                                                }  ?>">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem_listrik"><?php if ($maintListrik) {
                                                                                                                                                    echo $maintListrik->problem;
                                                                                                                                                } else {
                                                                                                                                                }  ?></textarea>
                                                <input type="text" class="form-control" placeholder="detail" name="detailListrik" value="Listrik">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_listrik"><?php if ($maintListrik) {
                                                                                                                                                    echo $maintListrik->action;
                                                                                                                                                } else {
                                                                                                                                                }  ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- accordion style 5 end -->
    </div>
</div>
<?= $this->endSection(); ?>