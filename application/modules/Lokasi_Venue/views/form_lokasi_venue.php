<style>
.form-check-label {
    margin-bottom: 0;
}
</style>
<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" enctype="multipart/form-data"
                    role="<?= base_url(); ?>Lokasi_Venue">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="fotolama" value="<?= $foto_venue; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Venue</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nama_venue" value="<?= $nama_venue; ?>"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Latitude</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="lat" value="<?= $lat; ?>" id="latitude">
                        </div>
                        <label class="col-sm-2 col-form-label">Longitude</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="longg" value="<?= $longg; ?>" id="longitude">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2">Keterangan Venue</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="ket_venue" id="ket_venue">
                                <?= $ket_venue; ?>    
                            </textarea>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="<?= 1 ?>"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="<?= 2 ?>"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Non-Aktif
                                </label>
                            </div>
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Foto Lokasi <small>Ukuran 800 x 700 Pixel</small></label>
                        <div class="col-sm-3">
                            <?php if($foto_venue!=""){?>
                                 <input type="file" class="form-control" name="foto_venue" onchange="pratinjau1(event)">
                            <?php }else{?>
                                 <input type="file" class="form-control" name="foto_venue" onchange="pratinjau1(event)"
                                required>
                            <?php }?>
                           
                            <img id="imgPratinjau1" width="50%" height="50%" src="<?php if($foto_venue != '' && file_exists($img = 'assets/img/lokasi/'.$foto_venue)) {
                                echo base_url($img);
                            } else {
                                echo "assets/img/Upload-pana.png";
                            } ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Lokasi_Venue" class="btn btn-danger">
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
    CKEDITOR.replace('ket_venue', {
        defaultLanguage: 'en',
        language: 'en'
    }).setData('<?php echo str_replace(array("\r", "\n"), '', $ket_venue); ?>');
});
</script>