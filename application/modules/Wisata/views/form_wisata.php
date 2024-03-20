<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Wisata">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Wisata</label>
                        <div class="col-sm-4">
                            <input type="text" name="nama_wisata" value="<?= $nama_wisata; ?>" class="form-control"
                                required />
                        </div>
                        <label class="col-sm-2 col-form-label">Telphone</label>
                        <div class="col-sm-4">
                            <input type="number" name="no_tlp" value="<?= $no_tlp; ?>" class="form-control" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="ket_wisata" value="<?= $ket_wisata; ?>">
                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Upload</label>
                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="foto_1" onchange="pratinjau1(event)" required>
                            <img id="imgPratinjau1" width="50%" height="50%" src="<?php if($foto_1 != '' && file_exists($img1 = 'assets/upload_hotel/'.$foto_1)) {
                                echo base_url($img1);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="foto_2" onchange="pratinjau2(event)">
                            <img id="imgPratinjau2" width="50%" height="50%" src="<?php if($foto_2 != '' && file_exists($img2 = 'assets/upload_hotel/'.$foto_2)) {
                                echo base_url($img2);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="foto_3" onchange="pratinjau3(event)">
                            <img id="imgPratinjau3" width="50%" height="50%" src="<?php if($foto_3 != '' && file_exists($img3 = 'assets/upload_hotel/'.$foto_3)) {
                                echo base_url($img3);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="foto_4" onchange="pratinjau4(event)">
                            <img id="imgPratinjau4" width="50%" height="50%" src="<?php if($foto_4 != '' && file_exists($img4 = 'assets/upload_hotel/'.$foto_4)) {
                                echo base_url($img4);
                            } else {
                                echo base_url()."assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="foto_5" onchange="pratinjau5(event)">
                            <img id="imgPratinjau5" width="50%" height="50%" src="<?php if($foto_5 != '' && file_exists($img5 = 'assets/upload_hotel/'.$foto_5)) {
                                echo base_url($img5);
                            } else {
                                echo base_url()."assets/img/Upload-pana.png";
                            } ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Wisata" class="btn btn-danger">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    CKEDITOR.replace('ket_wisata', {
        defaultLanguage: 'en',
        language: 'en'
    }).setData('<?php echo str_replace(array("\r", "\n"), '', $ket_wisata); ?>');
});
</script>