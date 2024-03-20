<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Informasi">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                     <input type="hidden" name="gambarlama" value="<?= $gambar_informasi; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Judul Informasi</label>
                        <div class="col-sm-4">
                            <input type="text" name="judul_informasi" value="<?=$judul_informasi;?>"
                                class="form-control " required />
                        </div>
                        <label class="col-sm-2 col-form-label">
                            Link Youtube
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="link_youtube" value="<?=$link_youtube;?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="ket_informasi"
                                value="<?= $ket_informasi; ?>">
                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_informasi" value="1"
                                    id="flexRadioDefault1" <?php if($status_informasi =="1"){echo"checked";}else{echo"";}?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Publish
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_informasi" value="2"
                                    id="flexRadioDefault2" <?php if($status_informasi =="2"){echo"checked";}else{echo"";}?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                     Unpublish
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Upload</label>
                        <div class="col-sm-4">
                            <?php if($gambar_informasi !=""){?>
                                <input type="file" class="form-control" name="gambar_informasi" onchange="pratinjau1(event)">
                                <?php }else{?>
                                    <input type="file" class="form-control" name="gambar_informasi" onchange="pratinjau1(event)"
                                required>
                                <?php }?>
                            
                            <img id="imgPratinjau1" width="50%" height="50%" src="<?php if($gambar_informasi != '' && file_exists($img2 = 'assets/img/informasi/'.$gambar_informasi)) {
                                echo base_url($img2);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Informasi" class="btn btn-danger">
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
    CKEDITOR.replace('ket_informasi', {
        defaultLanguage: 'en',
        language: 'en'
    }).setData('<?php echo str_replace(array("\r", "\n"), '', $ket_informasi); ?>');
});
</script>