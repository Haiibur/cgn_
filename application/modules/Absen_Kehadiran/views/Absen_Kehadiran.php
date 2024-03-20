<div class="row">
    <div class="col-12 col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-5 col-sm-12">
                        <form method="POST" id="aksi2peserta">
                            <input type="hidden" id="aksia2" value="<?=base_url('simpan-registrasi');?>">
                            <label><b>Scan atau masukan nomor pendafataran</b></label>
                            <div class="input-group mb-3 input-group-lg">
                              <input type="text" class="form-control formnya" placeholder="XXXXXX" name="kdpeserta" style="letter-spacing: 2;font-weight: bold;font-size: 15px;" autofocus>
                              <button class="btn btn-success" type="submit" id="button-addon2"><i class="fa fa-search"></i> CEK <span id="loading2a"></span></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="toolbar">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="javascript:void(0)" class="btn btn-warning"
                            title="Buat Agenda">
                            <i class="fa fa-print"></i>
                            Cetak Data 
                        </a>
                        
                    </div>
                </div>
                <div class="table-responsive">
                   
                    <table id="table" class="table table-striped" data-toggle="table" data-toolbar="#toolbar"
                        data-pagination="true" data-search="true" data-sort-order="desc" data-id-field="id"
                        data-page-list="[10, 25, 50, 100, all]"
                        data-url="<?=base_url('Absen_Kehadiran/load_absen_peserta');?>">
                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true"  data-valign="top"></th>
                                <th data-field="jam"  data-valign="top">Waktu</th>
                                <th data-field="id"  data-valign="top">Nomor Peserta</th>                                
                                <th data-field="provinsi"  data-valign="top">Provinsi</th>
                                <th data-field="kab"  data-valign="top">Kab/Kota</th>
                                <th data-field="peserta"  data-valign="top">Detail Peserta</th>
                                <th data-field="level"  data-valign="top">Level Peserta</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modaldetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Data Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="hasildetail3"></div>
      
    </div>
  </div>
</div>




<script type="text/javascript">
    $(document).ready(function (e) {
  $("#aksi2peserta").on('submit',(function(e) {
    //alert('tes');
    var aksinya2 =document.getElementById("aksia2").value;   
    //var kembali2 =document.getElementById("kembalia2").value;   
    //var dataModal2 =document.getElementById("modalnya2").value; 
    //var urlnya2=absnya;    
    $('#loading2a').html("<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>");
    //alert(aksinya);
    e.preventDefault();
    $.ajax({
          url:aksinya2,
          type: "POST",
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,          
          success: function(data)
          { 
            //alert(data);
            $('#loading2a').hide();
            if(data==0){
                $('#loading2a').hide();
                Swal.fire("GAGAL!", "Kode Pendaftaran Tidak Ada,mohon dipastikan kembali", "warning")
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else if(data==1){
                $('#loading2a').hide();
                Swal.fire("Informasi!", "Peserta belum KONFIRMASI KEHADIRAN,!", "info");
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else if(data==3){
                $('#loading2a').hide();
                Swal.fire("Informasi!", "Peserta Sudah Registrasi!", "info");            
            }else{
              //$('#'+dataModal2).modal('hide');  
              //$('.formnya').val("");      
              $("#modaldetail").modal("show");
              $("#hasildetail3").html(data);                     
               //Swal.fire("BERHASIL!", "Data berhasil diproses.", "success");
               //$table.bootstrapTable('refresh');
            }             
          },
        error: function(e) 
        {
        $("#err").html(e).fadeIn();
        }           
     });
  }));
});
</script>