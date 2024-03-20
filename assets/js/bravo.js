$(document).ready(function(){         
        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Kirim')
                                        .attr('id','btn-finish')
                                         .addClass('btn btn-info')
                                         .on('click', function(){
                                             
                                            });
        var btnCancel = $('<button></button>').text('Ulangi')
                                         .attr('id','btn-reset')  
                                         .addClass('btn btn-dark')
                                         .on('click', function(){
                                          $('#smartwizard').smartWizard("reset");
                                        });
        // Smart Wizard
        $('#smartwizard').smartWizard({

                selected: 0,
                theme: 'arrows',
                transitionEffect:'fade',
                toolbarSettings: {toolbarPosition: 'bottom',                                  
                                  toolbarExtraButtons: [btnFinish, btnCancel]
                                },
                anchorSettings: {
                            markDoneStep: true, // add done css
                            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                        }
             });
     
         $("#btn-finish").addClass('hide');
         $("#btn-reset").addClass('hide');
         $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
                   $("#btn-finish").addClass('hide');
               }else if(stepPosition === 'final'){
                   $("#next-btn").hide();
                   $("#btn-finish").addClass('show');
               }
            }); 
    }); 

$(function (e) {
  "use strict";  
    $(".nik").inputmask("9999999999999999"),
    $(".npwp").inputmask("99.999.999.9-999.9999"),   
    $(".email").inputmask({
      mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
      greedy: !1,
      onBeforePaste: function (n, a) {
        return (e = e.toLowerCase()).replace("mailto:", "");
      },
      definitions: {
        "*": {
          validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
          cardinality: 1,
          casing: "lower",
        },
      },
    });    
});
//
$(function () {
    $(".textarea_editor").wysihtml5();
    $(".textarea_editor2").wysihtml5();
    $(".textarea_editor3").wysihtml5();
    $(".textarea_editor4").wysihtml5(); 
    $(".textarea_editor5").wysihtml5();    
  });
//dropzone//
//dropzone//
/*Dropzone.autoDiscover = false;
  var foto_upload= new Dropzone(".dropzone",{
  url: urlnya+"upload/dokumen/"+kdpeserta+"/"+untuk,  
  maxFilesize: 2,
  method:"post",
  acceptedFiles:"image/*,application/pdf,application/vnd.ms-excel,application/msword",
  paramName:"userfile",
  dictInvalidFileType:"Type file ini tidak dizinkan",
  addRemoveLinks:true,
  });


  //Event ketika Memulai mengupload
  foto_upload.on("sending",function(a,b,c){
    a.token=Math.random();
    c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
  });


  //Event ketika foto dihapus
  foto_upload.on("removedfile",function(a){
    var token=a.token;
    $.ajax({
      type:"post",
      data:{token:token},
      url:urlnya+"upload/hapusdok",
      cache:false,
      dataType: 'json',
      success: function(){
        console.log("Foto terhapus");
      },
      error: function(){
        console.log("Error");

      }
    });
  });
  */