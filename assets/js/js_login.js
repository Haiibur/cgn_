$(document).ready(function (e) {
  $("#loginform").on('submit',(function(e) {
    //alert('tes');
    var aksinya =document.getElementById("aksill").value;   
    var kembali =document.getElementById("kembalill").value;   
    var dataModal =document.getElementById("modalnyal").value; 
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
                Swal.fire("GAGAL!", "Username atau Password Anda Salah.", "warning")
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else{              
              window.location=urlnya1+"home";             
              //$table1.bootstrapTable('refresh'); 
            }            
          },
        error: function(e) 
        {
        $("#err").html(e).fadeIn();
        }           
     });
  }));
});
//reset//
$(document).ready(function (e) {
  $("#recoverform").on('submit',(function(e) {
    //alert('tes');
    var aksinya =document.getElementById("aksilr").value;   
    var kembali =document.getElementById("kembalilr").value;   
    var dataModal =document.getElementById("modalnyar").value; 
    var urlnya1=absnya;    
    $('#loadingr').html("<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>");
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
            $('#loadingr').hide();
            if(data==1){
                $('#loadingr').hide();
                Swal.fire("GAGAL!", "Email tidak ditemukan dalam sistem", "warning")
                //swal("GAGAL!", "Masih ada Parameter data yang belum diinput!", "info");            
            }else{              
             Swal.fire("BERHASIL!!", "link reset password telah dikirim ke email Anda", "success")
            }            
          },
        error: function(e) 
        {
        $("#err").html(e).fadeIn();
        }           
     });
  }));
});