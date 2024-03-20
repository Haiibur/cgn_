function belumaktif1(){
  Swal.fire("INFORMASI", "Dimohon untuk mengirimkan data profil Anda.", "info")
}
function belumaktif2(){
  Swal.fire("INFORMASI", "Data Profil Anda masih proses verifikasi", "info")
}
function showPreview(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-1-preview");
      preview.src = src;
      preview.style.display = "block";
    }
}
function showPreview2(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-2-preview");
      preview.src = src;
      preview.style.display = "block";
    }
}
function showPreview3(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-3-preview");
      preview.src = src;
      preview.style.display = "block";
    }
}
//aksi//
$(document).ready(function (e) {
  $("#aksi").on('submit',(function(e) {
    //alert('tes');
    var aksinya =document.getElementById("aksia").value;   
    var kembali =document.getElementById("kembalia").value;   
    var dataModal =document.getElementById("modalnya").value; 
    for ( instance in CKEDITOR.instances ) {
          CKEDITOR.instances[instance].updateElement();
    }
    var urlnya1=absnya;    
    $('#loading').html("<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>");
    //alert(aksinya);
    e.preventDefault();
    $.ajax({
          url:aksinya,
          type: "POST",
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          success: function(data)
          { 
            //alert(data);
            $('#loading').hide();
            if(data==1){
                $('#loading').hide();
                Swal.fire("GAGAL!", "Data sudah pernah diinput.", "warning")
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else if(data==11){
                $('#loading').hide();
                 Swal.fire("GAGAL Sob!", "Keterangan tidak boleh Kosong", "info");
                //swal("PENTING!", "Rekomendasi jumlah dana dan catatan wajib diisi!", "warning");            
            }else if(data==12){
                $('#loading').hide();
                 Swal.fire("GAGAL Sob!", "Nilai Rekomendasi tidak boleh Kosong", "info");
                //swal("PENTING!", "Rekomendasi jumlah dana dan catatan wajib diisi!", "warning");            
            }else if(data==2){              
              Swal.fire({
                  type: 'success',
                  title: 'BERHASIL!',
                  confirmButtonText: 'Oke',
                  text: 'Data berhasil Diproses.',
                  footer: '',
                  showCloseButton: true
              })
              .then(function (result) {
                  if (result.value) {
                      window.location=kembali;
                  }
              })
              //$table1.bootstrapTable('refresh'); 
            }else if(data==3){
              $('#'+dataModal).modal('hide');
              //$('.form-control').val("");                 
              Swal.fire({
                  type: 'success',
                  title: 'BERHASIL!',
                  confirmButtonText: 'Oke',
                  text: 'Data berhasil Diupdate.',
                  footer: '',
                  showCloseButton: true
              })
              .then(function (result) {
                  if (result.value) {
                      window.location=kembali;
                  }
              })        
              //$table1.bootstrapTable('refresh'); 
            }else if(data==22){
              $('#'+dataModal).modal('hide');
              $('.form-control').val("");                
               Swal.fire("BERHASIL!", "Data berhasil diproses.", "success");
               $table.bootstrapTable('refresh');
            }else if(data==23){
              //$('#'+dataModal).modal('hide');
              $('.form-control').val("");
              //$('#viewdata').load(urlnya+"parameter/data");
              Swal("BERHASIL", "Data Berhasil Diupdate.", "success");
              //window.location=kembali; 
              $table.bootstrapTable('refresh'); 
            } 

          }         
    });
  }));
});
//2//
$(document).ready(function (e) {
  $("#aksi2").on('submit',(function(e) {
    //alert('tes');
    var aksinya2 =document.getElementById("aksia2").value;   
    var kembali2 =document.getElementById("kembalia2").value;   
    var dataModal2 =document.getElementById("modalnya2").value; 
    var urlnya2=absnya;    
    $('#loading2').html("<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>");
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
            $('#loading2').hide();
            if(data==1){
                $('#loading2').hide();
                Swal.fire("GAGAL!", "Data sudah pernah diinput.", "warning")
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else if(data==1){
                $('#loading2').hide();
                swal("GAGAL!", "Data Tidak Boleh Sama!", "warning");            
            }else if(data==25){
                $('#loading2').hide();
                Swal.fire("GAGAL!", "Jenis ijin sudah ada!", "warning");            
            }else if(data==2){
              Swal.fire({
                  type: 'success',
                  title: 'BERHASIL!',
                  confirmButtonText: 'Oke',
                  text: 'Data berhasil Diproses.',
                  footer: '',
                  showCloseButton: true
              })
              .then(function (result) {
                  if (result.value) {
                      window.location=kembali2
                  }
              })             
              //$table1.bootstrapTable('refresh'); 
            }else if(data==3){
              $('#'+dataModal2).modal('hide');
              $('.form-control').val("");
              Swal.fire({
                  type: 'success',
                  title: 'BERHASIL!',
                  confirmButtonText: 'Oke',
                  text: 'Data berhasil Diupdate.',
                  footer: '',
                  showCloseButton: true
              })
              .then(function (result) {
                  if (result.value) {
                      window.location=kembali2
                  }
              })             
              //$table1.bootstrapTable('refresh'); 
            }else if(data==21){
              $('#'+dataModal2).modal('hide');    
              $('.format').val("");          
              $('#katkeg').load(urlnya+"kegiatan/kat_kegiatan");
              Swal.fire("BERHASIL!", "Data berhasil diproses.", "success")
              //window.location=kembali; 
              //$table.bootstrapTable('refresh'); 
            } else if(data==22){
              $('#'+dataModal2).modal('hide');
              $('.form-control').val("");                
               Swal.fire("BERHASIL!", "Data berhasil diproses.", "success");
               $table.bootstrapTable('refresh');
            }else if(data==23){
              //$('#'+dataModal).modal('hide');
              $('.form-control').val("");
              //$('#viewdata').load(urlnya+"parameter/data");
              Swal("BERHASIL", "Data Berhasil Diupdate.", "success");
              //window.location=kembali; 
              $table.bootstrapTable('refresh'); 
            }else if(data==24){
              $('#'+dataModal2).modal('hide');  
              $('.formnya').val("");                           
               Swal.fire("BERHASIL!", "Data berhasil diproses.", "success");
               $table.bootstrapTable('refresh');
            }             
          },
        error: function(e) 
        {
        $("#err").html(e).fadeIn();
        }           
     });
  }));
});
//3//
$(document).ready(function (e) {
  $("#aksi3").on('submit',(function(e) {
    //alert('tes');
    var aksinya3 =document.getElementById("aksia3").value;   
    var kembali3 =document.getElementById("kembalia3").value;   
    var dataModal3 =document.getElementById("modalnya3").value; 
    var urlnya3=absnya;    
    $('#loading3').html("<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>");
    //alert(aksinya);
    e.preventDefault();
    $.ajax({
          url:aksinya3,
          type: "POST",
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,          
          success: function(data)
          { 
            //alert(data);
            $('#loading3').hide();
            if(data==1){
                $('#loading2').hide();
                Swal.fire("GAGAL!", "Data sudah pernah diinput.", "warning")
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else if(data==1){
                $('#loading3').hide();
                swal("GAGAL!", "Data Tidak Boleh Sama!", "warning");            
            }else if(data==2){
              Swal.fire({
                  type: 'success',
                  title: 'BERHASIL!',
                  confirmButtonText: 'Oke',
                  text: 'Data berhasil Diproses.',
                  footer: '',
                  showCloseButton: true
              })
              .then(function (result) {
                  if (result.value) {
                      window.location=kembali2
                  }
              })             
              //$table1.bootstrapTable('refresh'); 
            }else if(data==3){
              $('#'+dataModal3).modal('hide');
              $('.form-control').val("");
              Swal.fire({
                  type: 'success',
                  title: 'BERHASIL!',
                  confirmButtonText: 'Oke',
                  text: 'Data berhasil Diupdate.',
                  footer: '',
                  showCloseButton: true
              })
              .then(function (result) {
                  if (result.value) {
                      window.location=kembali2
                  }
              })             
              //$table1.bootstrapTable('refresh'); 
            }else if(data==21){
              $('#'+dataModal3).modal('hide');    
              $('.format').val("");          
              $('#katkeg').load(urlnya+"kegiatan/kat_kegiatan");
              Swal.fire("BERHASIL!", "Data berhasil diproses.", "success")
              //window.location=kembali; 
              //$table.bootstrapTable('refresh'); 
            } else if(data==22){
              $('#'+dataModal3).modal('hide');
              $('.form-control').val("");                
               Swal.fire("BERHASIL!", "Data berhasil diproses.", "success");
               $table.bootstrapTable('refresh');
            }else if(data==23){
              //$('#'+dataModal).modal('hide');
              $('.form-control').val("");
              //$('#viewdata').load(urlnya+"parameter/data");
              Swal("BERHASIL", "Data Berhasil Diupdate.", "success");
              //window.location=kembali; 
              $table.bootstrapTable('refresh'); 
            }else if(data==24){
              $('#'+dataModal3).modal('hide');  
              $('.formnya2').val("");                           
               Swal.fire("BERHASIL!", "Data berhasil diproses.", "success");
               $table2.bootstrapTable('refresh');
            }             
          },
        error: function(e) 
        {
        $("#err").html(e).fadeIn();
        }           
     });
  }));
});

//cetak data//
$(function() {
  $(".print").click(function(){   
    //Save the link in a variable called element
    var element = $(this);
    //Find the id of the link that was clicked
    var del_id = element.attr("id");
    //Built a url to send
    var info = 'id=' + del_id;
  //alert(info);
    var win = window.open(urlnya+"laporan/cetak-proposal-nomor/"+del_id, '_blank','height=650,width=850');
          console.log(win);
          win.focus();
          setTimeout(function(){win.opener;}, 1000);
    


    return false;
    });
});
//cetak pemohon//
$(function() {
  $(".printpemohon").click(function(){   
    //Save the link in a variable called element
    var element = $(this);
    //Find the id of the link that was clicked
    var del_id = element.attr("id");
    //Built a url to send
    var info = 'id=' + del_id;
  //alert(info);
    var win = window.open(urlnya+"lembaga/cetak-lsm/"+del_id, '_blank','height=650,width=850');
          console.log(win);
          win.focus();
          setTimeout(function(){win.opener;}, 1000);
    


    return false;
    });
});
//hapus gambar//
$(function() {
  $(".hapusgambar").click(function(){
  //Save the link in a variable called element
  var element = $(this);

  //Find the id of the link that was clicked
  var del_id = element.attr("id");

  //Built a url to send
  var info = 'id=' + del_id;
  //alert(info);
  Swal.fire({
              title: "Anda Yakin?",
              text: "Akan menghapus data ini!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus!'
          }).then((result) => {
              if (result.value) {
                  $.ajax({
                   type: "POST",
                   url: urlnya+"HapusData/hapusgambar",
                   data: info,
                   success: function(data){
                    //alert(data);
                      //Swal.fire("BERHASIL!", "Data berhasil dihapus.", "success"); 
                        
                    }             
                }); 
                $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                .animate({ opacity: "hide" }, "slow");
              }
          });
   
  return false;
  });
});


