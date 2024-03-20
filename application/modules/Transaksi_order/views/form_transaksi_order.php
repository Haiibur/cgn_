<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <form id="formData" action="<?= $url; ?>" method="POST" role="<?= base_url(); ?>Transaksi_order">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Customer</label>
                        <div class="col-sm-4">
                            <select name="peserta" class="form-control" style="text-align: center;">
                                <option disabled selected>--- Pilih Customer ---</option>
                                <?php
                                        foreach ($Peserta as $value) { ?>
                                <option value=<?= $value->kd_daftar ?>><?= $value->nama_peserta ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Jumlah Pembelian</label>
                        <div class="col-sm-4">
                            <input type="number" name="qty_order" id="qty_order" value="<?= $qty_order; ?>"
                                class="form-control" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Produk</label>
                        <div class="col-sm-4">
                            <select name="produk" class="form-control" style="text-align: center;" id="produk">
                                <option disabled selected>--- Pilih Produk ---</option>
                                <?php
                                        foreach ($Produk as $value) { ?>
                                <option value=<?= $value->kd_produk ?>>
                                    <?= $value->nama_produk . ' || ' .  $value->harga ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-4">
                            <input type="number" name="harga_order" id="harga_order" value="<?= $harga_order; ?>"
                                class="form-control" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Alamat Kirim</label>
                        <div class="col-sm-10">
                            <input type="text" name="alamat_kirim" value="<?= $alamat_kirim; ?>" class="form-control "
                                required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm text-right">
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-primary" type="submit">
                                    Simpan <span id="loading2"></span>
                                </button>
                                <a href="<?= base_url(); ?>Transaksi_order" class="btn btn-danger">
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
    $('#produk , #qty_order').change(function() {
        var kd_produk = $('#produk').val();
        var qty_order = $('#qty_order').val();
        $.ajax({
            url: "<?php echo site_url('Produk/Get_harga/'); ?>",
            method: "POST",
            data: {
                kd_produk: kd_produk,
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var i;
                for (i = 0; i < data.length; i++) {
                    var harga = data[i].harga;
                };

                var hitung = qty_order * harga;
                $('#harga_order').val(hitung);
                document.getElementById("harga_order").readOnly = true;
            }
        });
        return false;
    });
});
</script>