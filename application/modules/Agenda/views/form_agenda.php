<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Agenda">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Acara</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_agenda" value="<?= $nama_agenda; ?>"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Untuk Hari </label>
                        <div class="col-sm-4">
                            <select name="harike" class="form-control" required>
                                <option disable selected>--- Pilih ---</option>
                                <?php
                                foreach ($harike as $valueh) { 
                                    if($harike1 == $valueh->kdhari){
                                        $slh="selected";
                                    }else{
                                        $slh="";
                                    }
                                    ?>
                                <option value="<?= $valueh->kdhari ?>" <?=$slh;?>><?= $valueh->nama_hari ?>
                                </option>
                                <?php } ?>

                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Jam</label>
                        <div class="col-sm-3">
                            <input type="text" name="jam_agenda" value="<?= $jam_agenda; ?>" class="form-control"
                                required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Lokasi Acara</label>
                        <div class="col-sm-4">
                            <select name="kd_venue" class="form-control" required>
                                <option disable selected>--- Pilih Lokasi Venue ---</option>
                                
                                <?php
                                foreach ($kd_venue as $value) {
                                    if($venue ==$value->kd_venue){
                                        $slhv="selected";
                                    }else{
                                        $slhv="";
                                    } 

                                            ?>
                                <option value="<?= $value->kd_venue ?>" <?=$slhv;?>><?= $value->nama_venue ?>
                                </option>
                                <?php } ?>
                                <option value="0">Lainnya</option>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="jumlah_peserta" maxlength="6"
                                value="<?= $jumlah_peserta; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        
                        <label class="col-sm-2 col-form-label">Wajib Absen Kehadiran?</label>
                        <div class="col-sm-8">
                            <input type="radio" name="absen" value="1" required <?php if($absen =="1"){echo"cheked";}else{echo"";}?>> Ya wajib isi Absen &nbsp;&nbsp;
                            <input type="radio" name="absen" value="0" <?php if($absen =="0"){echo"cheked";}else{echo"";}?>> Tidak
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="keterangan" rows="4"><?= $keterangan; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">

                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Agenda" class="btn btn-danger">
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
    $(document).ready(function() {
        CKEDITOR.replace('keterangan', {
            defaultLanguage: 'en',
            language: 'en'
        }).setData('<?php echo str_replace(array("\r", "\n"), '', $keterangan); ?>');
    });
    $('#dates').datetimepicker({
        locale: 'en',
        format: 'YYYY-MM-DD',
        defaultDate: new Date()
    });
    $('#hours').datetimepicker({
        locale: 'en',
        format: 'HH:mm',
        defaultDate: new Date()
    });
    $('#hours2').datetimepicker({
        locale: 'en',
        format: 'HH:mm',
        defaultDate: new Date()
    });
});
</script>