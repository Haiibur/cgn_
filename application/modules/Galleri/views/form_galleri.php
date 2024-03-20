<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Galleri" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="gambarlama_1" value="<?= $foto_1; ?>">
                    <input type="hidden" name="gambarlama_2" value="<?= $foto_2; ?>">
                    <input type="hidden" name="gambarlama_3" value="<?= $foto_3; ?>">
                    <input type="hidden" name="gambarlama_4" value="<?= $foto_4; ?>">
                    <input type="hidden" name="gambarlama_5" value="<?= $foto_5; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="katagori" value="1"
                                    id="flexRadioDefault1" <?php if($kategori =="1"){echo"checked";}else{echo"";}?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Foto
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="katagori" value="2"
                                    id="flexRadioDefault2" <?php if($kategori =="2"){echo"checked";}else{echo"";}?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                     Video <small class="text-danger">ID Video Youtube Wajib Diisi</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Galleri</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="nama_galleri" value="<?=$nama_galleri;?>" class="form-control"
                                    required />
                            </div>
                        </div>
                       
                    </div>
                    <div class="row mb-3">                        
                        <label class="col-sm-2 col-form-label">
                            ID Video Youtube
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="link_vidio" value="<?=$link_vidio;?>" placeholder="ViG_0Rto9g0" class="form-control" />
                            Contoh :  https://www.youtube.com/watch?v=<b>ViG_0Rto9g0</b><br>
                            <small>Yang di cetak tebal itu yg dimasukan ke form</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="ket_galleri" value="<?= $ket_galleri; ?>">
                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Foto <small>Ukuran foto 600 Pixel</small></label>
                        <div class="col-sm-2">
                            <?php if($foto_1 !=""){?>
                                <input type="file" class="form-control" name="foto_1" onchange="pratinjau1(event)">
                            <?php }else{?>
                                <input type="file" class="form-control" name="foto_1" onchange="pratinjau1(event)" required>
                            <?php }?>
                            
                            <img id="imgPratinjau1" width="50%" height="50%" src="<?php if($foto_1 != '' && file_exists($img1 = 'assets/img/galleri/'.$foto_1)) {
                                echo base_url($img1);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <!-- <div class="col-sm-2">
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
                        </div> -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Galleri" class="btn btn-danger">
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
    CKEDITOR.replace('ket_galleri', {
        defaultLanguage: 'en',
        language: 'en'
    }).setData('<?php echo str_replace(array("\r", "\n"), '', $ket_galleri); ?>');
});
</script>