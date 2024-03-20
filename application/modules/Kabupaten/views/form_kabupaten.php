<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Kabupaten">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select name="kd_provinsi" class="form-control">
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
                        <label class="col-sm-3 col-form-label">Nama Kabupaten</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" name="nama_kabupaten" value="<?=$nama_kabupaten;?>"
                                    class="form-control " required />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Kabupaten" class="btn btn-danger">
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