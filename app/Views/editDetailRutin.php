<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');

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
                    <?php
                    endif ?>
                    <h5 style="font-weight: 800;">EDIT CHECK RUTIN MINGGUAN</h3> <br>
                        <h6><?= $mobils->merek . ' ' . $mobils->type . '<br>' . $mobils->nopol ?></h6>
                        <p></p>
                        <hr><br>
                        <form action="<?= site_url('/Vehicle/editCheck/' . $ceks->idCek); ?>" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:800" hidden>ID</label>
                                <div class="col-sm-7">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="id_mobil" value="<?= $mobils->id; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:800">KiloMeter</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="<?= $ceks->km; ?>" name="km" value="<?= $ceks->km; ?>">
                                    <input type="text" class="form-control" hidden placeholder="" name="tanggal" value="<?= date('Y-m-d'); ?>">
                                    <input type="text" class="form-control" hidden placeholder="" name="idCeck" value="<?= $ceks->idCek ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Oli Mesin</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->oliMesin == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="oliRadio1" name="oliMesin" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="oliRadio1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->oliMesin == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="oliRadio2" name="oliMesin" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="oliRadio2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Oli Rem</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->oliRem == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="oliRemRadio1" name="oliRem" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="oliRemRadio1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->oliRem == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="oliRemRadio2" name="oliRem" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="oliRemRadio2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Air Radiator</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->airRadiator == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="airRadiator1" name="airRadiator" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="airRadiator1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->airRadiator == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="airRadiator2" name="airRadiator" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="airRadiator2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Air Aki</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->airAki == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="airAki1" name="airAki" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="airAki1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->airAki == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="airAki2" name="airAki" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="airAki2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Air Wiper</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->airWiper == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="airWiper1" name="airWiper" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="airWiper1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->airWiper == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="airWiper2" name="airWiper" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="airWiper2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tali Kipas</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->taliKipas == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="taliKipas1" name="taliKipas" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="taliKipas1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->taliKipas == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="taliKipas2" name="taliKipas" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="taliKipas2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Suara Mesin</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->suaraMesin == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="suaraMesin1" name="suaraMesin" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="suaraMesin1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->suaraMesin == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="suaraMesin2" name="suaraMesin" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="suaraMesin2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kopling</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->kopling == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="kopling1" name="kopling" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="kopling1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->kopling == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="kopling2" name="kopling" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="kopling2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Stir</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->stir == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="stir1" name="stir" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="stir1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->stir == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="stir2" name="stir" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="stir2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ban (Tekanan,Alur)</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->ban == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="TAB1" name="ban" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="TAB1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->ban == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="TAB2" name="ban" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="TAB2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lampu-lampu (Dpn Low-High, Blk, senja, Sein, rem, atret)</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->lampu == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="lampu1" name="lampu" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="lampu1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->lampu == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="lampu2" name="lampu" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="lampu2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Wiper</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->wiper == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="wiper1" name="wiper" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="wiper1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->wiper == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="wiper2" name="wiper" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="wiper2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Toolkit</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->toolkit == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="toolkit1" name="toolkit" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="toolkit1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->toolkit == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="toolkit2" name="toolkit" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="toolkit2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Body</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->body == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="body1" name="body" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="body1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->body == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="body2" name="body" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="body2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Interior</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->interior == 'Y') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="interior1" name="interior" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="interior1">Bersih</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($ceks->interior == 'N') {
                                                                echo 'checked';
                                                            } else {
                                                            }; ?> id="interior2" name="interior" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="interior2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Problem</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem"><?= $ceks->problem; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Action</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action"><?= $ceks->action; ?></textarea>
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
</div>
<?= $this->endSection(); ?>