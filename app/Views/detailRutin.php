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

                    <h5 style="font-weight: 800;">CHECK RUTIN MINGGUAN</h3> <br>
                        <h6><?= $mobils->merek . ' ' . $mobils->type . '<br>' . $mobils->nopol ?></h6>
                        <p></p>
                        <hr><br>
                        <form action="<?= site_url(); ?>/Vehicle/addCheck" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:800" hidden>ID</label>
                                <div class="col-sm-7">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="id_mobil" value="<?= $mobils->id; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:800">KiloMeter</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="KM saat ini" name="km">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Oli Mesin</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="oliRadio1" name="oliMesin" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="oliRadio1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="oliRadio2" name="oliMesin" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="oliRadio2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Oli Rem</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="oliRemRadio1" name="oliRem" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="oliRemRadio1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="oliRemRadio2" name="oliRem" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="oliRemRadio2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Air Radiator</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="airRadiator1" name="airRadiator" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="airRadiator1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="airRadiator2" name="airRadiator" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="airRadiator2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Air Aki</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="airAki1" name="airAki" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="airAki1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="airAki2" name="airAki" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="airAki2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Air Wiper</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="airWiper1" name="airWiper" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="airWiper1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="airWiper2" name="airWiper" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="airWiper2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tali Kipas</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="taliKipas1" name="taliKipas" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="taliKipas1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="taliKipas2" name="taliKipas" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="taliKipas2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Suara Mesin</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="suaraMesin1" name="suaraMesin" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="suaraMesin1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="suaraMesin2" name="suaraMesin" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="suaraMesin2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kopling</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="kopling1" name="kopling" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="kopling1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="kopling2" name="kopling" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="kopling2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Stir</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="stir1" name="stir" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="stir">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="stir2" name="stir" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="stir2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tekanan Angin Ban (Dpn,Blk,Ka,Ki)</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="TAB1" name="tekananBan" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="TAB1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="TAB2" name="tekananBan" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="TAB2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kondisi Alur Ban (Dpn,Blk,Ka,Ki)</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="alurBan1" name="alurBan" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="alurBan1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="alurBan2" name="alurBan" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="alurBan2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lampu-lampu (Dpn Low-High, Blk, senja, Sein, rem, atret)</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="lampu1" name="lampu" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="lampu1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="lampu2" name="lampu" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="lampu2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Wiper</label>
                                <div class="col-sm-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="wiper1" name="wiper" class="custom-control-input" value="Y">
                                        <label class="custom-control-label" for="wiper1">Normal</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="wiper2" name="wiper" class="custom-control-input" value="N">
                                        <label class="custom-control-label" for="wiper2">Kurang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Problem</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Action</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action"></textarea>
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