<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 col-sm-5 mb-2">
                        <h5>Data Order</h5>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <!--<tr>-->
                            <!--    <td >Nomor</td>-->
                            <!--    <td >:</td>-->
                            <!--    <td><?=$kd_order;?></td>-->
                            <!--</tr>-->
                            <tr>
                                <td width="140">Tanggal</td>
                                <td width="5">:</td>
                                <td><?=$tgl_order;?></td>
                            </tr>
                            <tr>
                                <td>Total Item</td>
                                <td>:</td>
                                <td><?=$totitem;?> </td>
                            </tr>
                            <tr>
                                <td>Jml.Bayar</td>
                                <td>:</td>
                                <td><?=$jumlah_bayar;?></td>
                            </tr>
                            <tr>
                                <td>Status Transaksi</td>
                                <td>:</td>
                                <td><?=$ststrans;?></td>
                            </tr>
                            <tr>
                                <td>Status Bayar</td>
                                <td>:</td>
                                <td><?=$stsbayar;?></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td>:</td>
                                <td><?=$catatan;?></td>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="col-md-5 col-sm-5 mb-2">
                        <h5>Data Customer</h5>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="140">Kode Peserta</td>
                                <td width="5">:</td>
                                <td><?=$kd_daftar;?></td>
                            </tr>
                            <tr>
                                <td>Nama Peserta</td>
                                <td>:</td>
                                <td><?= $nama_peserta ?></td>
                            </tr>
                            <tr>
                                <td>No.Telp</td>
                                <td>:</td>
                                <td><?= $tlp_peserta ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?= $email_peserta ?></td>
                            </tr>
                            <tr>
                                <td>Dari Provinsi</td>
                                <td>:</td>
                                <td><?=$namaprov;?></td>
                            </tr>
                            <tr>
                                <td>Dari Kota</td>
                                <td>:</td>
                                <td><?=$namakab;?></td>
                            </tr>
                            
                        </table>
                    </div>
                    <div claas="col-md-2 col-sm-2 mb-2">
                        
                        <button class="btn btn-warning btn-sm btn-lg btn-block">Cetak Invoice</button>
                        <?php if($status_bayar =="1"){?>
                            <button class="btn btn-success btn-sm btn-lg btn-block">Order Selesai</button>
                        <?php }else{?>
                            <button class="btn btn-danger btn-sm btn-lg btn-block">Hapus Order</button>
                        <?php }?>
                        
                        <a class="btn btn-primary btn-sm btn-lg btn-block" href="<?=base_url('Transaksi_order');?>">Kembali</a>
                    </div>
                </div>
                
                
                
                
                
                
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive fs--1">
                            <table class="table table-striped table-sm">
                                <thead class="bg-200">
                                    <tr>
                                        <th style="text-align:center">No</th>
                                        <th>Nama Produk</th>
                                        <th style="text-align:center">Satuan</th>
                                        <th style="text-align:center">Quantity</th>
                                        <th style="text-align:right">Harga</th>
                                        <th style="text-align:right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i="1";
                                    foreach($ordernya as $key =>$val){
                                        $sub=$val->harga_order * $val->qty_order;
                                    ?>
                                        <tr>
                                            <td align="center" width="15">
                                                <?= $i ?>
                                            </td>
                                            <td class="align-middle">
                                                <?= $val->nama_produk_order ?>
                                            </td>
                                            <td align="center" width="80"><?= $val->satuan_order ?></td>
                                            <td align="center"><?= $val->qty_order ?></td>
                                            
                                            <td align="right" width="120"><?= number_format($val->harga_order) ?></td>
                                            
                                            <td align="right" width="120"><?= number_format($sub); ?></td>
                                        </tr>
                                    <?php $i++;}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk mengonversi nilai menjadi format mata uang rupiah
// function formatRupiah(angka) {
//     var reverse = angka.toString().split('').reverse().join(''),
//         ribuan = reverse.match(/\d{1,3}/g);
//     ribuan = ribuan.join('.').split('').reverse().join('');
//     return 'Rp ' + ribuan;
// }

// // Mengambil elemen dengan ID harga dan harga_order
// var hargaElement = document.getElementById("harga");
// var hargaOrderElement = document.getElementById("harga_order");

// // Mengonversi nilai harga menjadi format mata uang rupiah
// var harga = parseInt(hargaElement.textContent);
// hargaElement.textContent = formatRupiah(harga);

// // Mengonversi nilai harga_order menjadi format mata uang rupiah
// var hargaOrder = parseInt(hargaOrderElement.textContent);
// hargaOrderElement.textContent = formatRupiah(hargaOrder);
</script>