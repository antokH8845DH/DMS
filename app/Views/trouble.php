<?= $this->extend('layout/v_wrapper') ?>

<?= $this->section('home') ?>
<?php
$session = session();
$errors = $session->getFlashData('errors');
$id_user = $session->get('id');

?>
<?php
$eror = '';
if ($errors != null) {
    foreach ($errors as $err) {
        $eror .=   $err . ' | ';
        // foreach ($ARRAY as $item) { $STRING .= $item; }
    }
}
?>
<div class="flash-data" data-flashdata="<?= $session->getFlashData('flash'); ?>"></div>
<div class="flash-error" data-flasherror="<?= $eror; ?>"></div>

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">TROUBLE</h4>
                    <h6><?= $mobils->merek . ' ' . $mobils->type . '<br>' . $mobils->nopol ?></h6>
                    <p></p>
                    <hr>
                    <div id="accordion5" class="according accordion-s2 gradiant-bg">
                        <form action="<?= site_url(); ?>/Vehicle/addMaintenance" enctype="multipart/form-data" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:800" hidden>ID</label>
                                <div class="col-sm-2">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="id_mobil" value="<?= $mobils->id; ?>">
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label class="col-sm-1 mt-1 col-form-label" style="font-weight:800">KiloMeter</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control col-sm-4" placeholder="KM saat ini" name="km">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="id_user" value="<?= $id_user ?>">
                                    <input hidden type="text" class="form-control" placeholder="KM saat ini" name="status" value="2">
                                    <input hidden type="text" class="form-control" placeholder="no form" name="no_form" value="<?= $no_form; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-1 mt-1 col-form-label">Tanggal</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="date" id="example-date-input" name="tanggal">
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#accordion51">MESIN</a>
                                </div>
                                <div id="accordion51" class="collapse show" data-parent="#accordion5">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="problem_mesin"></textarea>
                                                <input hidden type="text" class="form-control" placeholder="detail" name="detailMesin" value="Mesin">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_mesin"></textarea>
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
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem_body"></textarea>
                                                <input hidden type="text" class="form-control" placeholder="detail" name="detailBody" value="Body">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_body"></textarea>
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
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem_kaki"></textarea>
                                                <input hidden type="text" class="form-control" placeholder="detail" name="detailKaki" value="Kaki-Kaki">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_kaki"></textarea>
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
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Problem</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="problem_listrik"></textarea>
                                                <input hidden type="text" class="form-control" placeholder="detail" name="detailListrik" value="Listrik">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-sm-1 col-form-label">Action</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="action_listrik"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <!-- <div class="input-group"> -->
                                <label for="exampleInputFile" class="col-4 ml-1">Tambah Foto</label>
                                <div class="custom-file col-8 ml-3">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name='uploads[]' multiple="multiple">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                </div>
                                <!-- <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div> -->
                                <!-- </div> -->
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