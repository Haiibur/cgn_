<?php foreach ($peserta as $key => $value) {}?>
<style type="text/css">
	td{padding: 4px;font-size: 14px;color: #000}
	.kotaklevel{width: 100%;height: 30px;background-color: #<?=$value->warna_level;?>}
</style>
<div class="modal-body" >
	<div class="row">
		<div class="col-sm-4">
			<img src="<?=base_url('assets/img/logocss1.jpg');?>" width="100%">
		</div>
		<div class="col-sm-8 ">
			<table class="" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="200">Nomor Peserta </td>
					<td>:</td>
					<td><?=$value->kd_daftar;?></td>
				</tr>
				<tr>
					<td>Tgl Daftar</td>
					<td>:</td>
					<td><?=$value->tgl_daftar;?></td>
				</tr>
				<tr>
					<td>Tgl.Konfirmasi Kehadiran</td>
					<td>:</td>
					<td><?=$value->tgl_konfirmasi_hadir;?></td>
				</tr>
				<tr>
					<td>Wilayah</td>
					<td>:</td>
					<td><?=$value->nama_kab;?> -  <?=$value->nama_provinsi;?></td>
				</tr>
				<tr>
					<td>Nama Lengkap</td>
					<td>:</td>
					<td><?=$value->nama_peserta;?></td>
				</tr>
				<tr>
					<td>No.Telp</td>
					<td>:</td>
					<td><?=$value->tlp_peserta;?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?=$value->email_peserta;?></td>
				</tr>
				<tr>
					<td>Level Peserta</td>
					<td>:</td>
					<td><?=$value->nama_level_peserta;?></td>
				</tr>

			</table>
			<div class="kotaklevel"></div>

		</div>
	</div>
	
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success hadir" id="<?=$value->kd_daftar;?>">
      Data Sudah Sesuai & Hadir
    </button>
    
</div>
<script type="text/javascript">
	$(".hadir").click(function(){  
          var urldata="<?=base_url();?>";   
            //Save the link in a variable called element
            var element = $(this);
            //Find the id of the link that was clicked
            var del_id = element.attr("id");
            //Built a url to send
            var info = 'id=' + del_id;
            //alert(info);
            Swal.fire({
                  title: "PERHATIAN",
                  text: "Pastikan Nametag sudah diterima oleh Peserta",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya,sudah diterima'
              }).then((result) => {
                if (result.value) {
                    $.ajax({
                    type: "POST",
                    url: urldata + "Absen_Kehadiran/simpanRegistrasihadir",
                    data: info,
                    success: function (data) {
                      //alert(data);
                      $('.formnya').val("");
                      $('#modaldetail').modal('hide');
                      $('#table').bootstrapTable('refresh')
                      Swal.fire("BERHASIL!", "Data Peserta berhasil diproses registrasi.", "success");
                      //location.reload();
                      //$table.bootstrapTable('refresh');
                    }
                  });
                    
                }
              })    
            
          });
</script>