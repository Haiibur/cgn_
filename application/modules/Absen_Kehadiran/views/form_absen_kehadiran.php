<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Absen_Kehadiran">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Agenda</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="agenda_kd" class="form-control" style="text-align: center;">
                                    <option disable selected>--- Pilih Agenda ---</option>
                                    <?php
                                        foreach ($agenda_kd as $value) { ?>
                                    <option value=<?= $value->kd_agenda ?>><?= $value->nama_agenda ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Level Peserta</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="peserta_kd" class="form-control" style="text-align: center;">
                                    <option disable selected>--- Pilih Level Peserta ---</option>
                                    <?php
                                        foreach ($peserta_kd as $value) { ?>
                                    <option value=<?= $value->kd_level_peserta ?>><?= $value->nama_level_peserta ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="kd_provinsi" id="kd_provinsi" class="form-control"
                                    style="text-align: center;">
                                    <option disable selected>--- Pilih Provinsi ---</option>
                                    <?php
                                        foreach ($provinsi as $value) { ?>
                                    <option value=<?= $value->kd_provinsi ?>><?= $value->nama_provinsi ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kabupaten</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="kd_kabupaten" id="kd_kabupaten" class="form-control">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Undangan" class="btn btn-danger">
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
    $('#kd_provinsi').change(function() {
        var kd_provinsi = $(this).val();
        $.ajax({
            url: "<?php echo site_url('Absen_Kehadiran/getkabupaten') ?>",
            method: "POST",
            data: {
                kd_provinsi: kd_provinsi,
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var selec =
                    "<option disabled selected class='text-center'> --- Pilih Kabupaten ---</option>";
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option class=text-center value=' + data[i].kd_kabupaten +
                        '>' + data[i].nama_kabupaten + '</option>';
                }
                $('#kd_kabupaten').html(selec + html);
            }
        });
        return false;
    });
});
</script>