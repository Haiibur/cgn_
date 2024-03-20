<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" enctype="multipart/form-data"
                    role="<?= base_url(); ?>Lokasi_Tujuan">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="fotolama" value="<?= $gambar_lokasi; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Lokasi Kunjungan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_lokasi" value="<?= $nama_lokasi; ?>"
                                required>
                        </div>
                    </div>                    
                    <div class="row mb-3">
                        <label class="col-sm-2">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="ket_lokasi" value="<?= $ket_lokasi; ?>">
                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">ID Video Youtube</label>
                        <div class="col-sm-3">
                            <input type="text" name="link_vidio" value="<?= $link_vidio; ?>" class="form-control"
                                required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Foto <small>Ukuran 800 x 700 Pixel</small></label>
                        <div class="col-sm-3">
                            <?php if($gambar_lokasi !=""){?>
                                <input type="file" class="form-control" name="gambar_lokasi" onchange="pratinjau(event)">
                                <?php }else{?>
                                    <input type="file" class="form-control" name="gambar_lokasi" onchange="pratinjau(event)"
                                required>
                                <?php }?>
                            
                            <img id="imgPratinjau" width="50%" height="50%" src="<?php if($gambar_lokasi != '' && file_exists($img = 'assets/img/lokasikunjungan/'.$gambar_lokasi)) {
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
                                <a href="<?= base_url(); ?>Lokasi_Tujuan" class="btn btn-danger">
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
    CKEDITOR.replace('ket_lokasi', {
        defaultLanguage: 'en',
        language: 'en'
    }).setData('<?php echo str_replace(array("\r", "\n"), '', $ket_lokasi); ?>');
});
</script>