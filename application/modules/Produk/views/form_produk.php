<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Produk" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="gambarlama_1" value="<?= $gambar_1; ?>">
                    <input type="hidden" name="gambarlama_2" value="<?= $gambar_2; ?>">
                    <input type="hidden" name="gambarlama_3" value="<?= $gambar_3; ?>">
                    <input type="hidden" name="gambarlama_4" value="<?= $gambar_4; ?>">
                    <input type="hidden" name="gambarlama_5" value="<?= $gambar_5; ?>">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-4">
                            <select name="katagori_produk" class="form-control">
                                <option disabled selected>--- Pilih Katagori Produk ---</option>
                                <?php
                                    foreach ($katagori_produk as $value) { 
                                        if($katproduk ==$value->kd_kat){
                                            $slk="selected";
                                        }else{
                                            $slk="";
                                        }

                                            ?>
                                <option value="<?= $value->kd_kat ?>" <?=$slk;?>><?= $value->nama_kat ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Nama
                            Produk</label>
                        <div class="col-sm-4">
                            <input type="text" name="nama_produk" value="<?=$nama_produk;?>" class="form-control "
                                required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-4">
                            <input type="number" name="harga" value="<?=$harga;?>" class="form-control " required />
                        </div>
                        <label class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-4">
                            <input type="text" name="satuan_produk" value="<?=$satuan_produk;?>" class="form-control "
                                required />
                        </div>
                        <label class="col-sm-2 col-form-label mt-2">Qty</label>
                        <div class="col-sm-3 mt-2">
                            <input type="text" name="qty" value="<?=$qty;?>" class="form-control "
                                required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="ket_produk" value="<?= $ket_produk; ?>">
                            </textarea>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_produk" value="<?= 1 ?>"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_produk" value="<?= 2 ?>"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Non-Aktif
                                </label>
                            </div>
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Foto Produk <small>Ukuran 600 x 600 Pixel</small></label>
                        <div class="col-sm-2">
                            <?php 
                            if($gambar_1 !=""){
                                $req="";
                            }else{
                                $req="required";
                            }
                            //2//
                            if($gambar_2 !=""){
                                $req2="";
                            }else{
                                $req2="required";
                            }
                            //3//
                            if($gambar_3 !=""){
                                $req3="";
                            }else{
                                $req3="required";
                            }
                            //4//
                            if($gambar_4 !=""){
                                $req4="";
                            }else{
                                $req4="required";
                            }
                            //5///
                            if($gambar_5 !=""){
                                $req5="";
                            }else{
                                $req5="required";
                            }

//
                            ?>
                            <input type="file" class="form-control" name="gambar_1" value="<?=$gambar_1;?>" onchange="pratinjau1(event)" <?=$req;?>
                                >
                            <img id="imgPratinjau1" width="50%" height="50%" src="<?php if($gambar_1 != '' && file_exists($img1 = 'assets/img/produk/'.$gambar_1)) {
                                echo base_url($img1);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="gambar_2" onchange="pratinjau2(event)">
                            <img id="imgPratinjau2" width="50%" height="50%" src="<?php if($gambar_2 != '' && file_exists($img2 = 'assets/img/produk/'.$gambar_2)) {
                                echo base_url($img2);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="gambar_3" onchange="pratinjau3(event)">
                            <img id="imgPratinjau3" width="50%" height="50%" src="<?php if($gambar_3 != '' && file_exists($img3 = 'assets/img/produk/'.$gambar_3)) {
                                echo base_url($img3);
                            } else {
                                echo base_url(). "assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="gambar_4" onchange="pratinjau4(event)">
                            <img id="imgPratinjau4" width="50%" height="50%" src="<?php if($gambar_4 != '' && file_exists($img4 = 'assets/img/produk/'.$gambar_4)) {
                                echo base_url($img4);
                            } else {
                                echo base_url()."assets/img/Upload-pana.png";
                            } ?>">
                        </div>

                        <div class="col-sm-2">
                            <input type="file" class="form-control" name="gambar_5" onchange="pratinjau5(event)">
                            <img id="imgPratinjau5" width="50%" height="50%" src="<?php if($gambar_5 != '' && file_exists($img5 = 'assets/img/produk/'.$gambar_5)) {
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
                                <a href="<?= base_url(); ?>agenda" class="btn btn-danger">
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
    CKEDITOR.replace('ket_produk', {
        defaultLanguage: 'en',
        language: 'en'
    }).setData('<?php echo str_replace(array("\r", "\n"), '', $ket_produk); ?>');
});
</script>