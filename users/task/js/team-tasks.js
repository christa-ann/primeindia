    

 $(document).ready(function(){
     $(document).on('click','.deleteTask',function(){
        var rowID=this.id;
        //alert(rowID);
        swal("Are you Sure?").then(function(res){
            if(res){
                $.ajax({
                    url: "php/tasks.php",
                    type: "post",
                    data:"deleteTask=1&rowID="+rowID,
                    
                    success: function(data){
                        //alert(data);
                         if(data!="error"){
                            
                             itoast.show("Deleted Successfully",5000,'theme_dark');
                        }
                        else
                        {
                            itoast.show("Cannot be Deleted." +data,5000,'theme_dark');
                        }
                        window.location.reload();
                      
                    },
                    error: function(){}             
                });
            }
        })

        
     });
     $(document).on('click','.updateNote',function(e){
        e.preventDefault();
        var taskID=$(this).attr('data-id');
        $("#updateNoteModal").modal('show');
        $("#opentaskID").val(taskID);
        console.log(taskID);


     });
     $(document).on('click','.viewNote',function(e){
        e.preventDefault();
        var taskID=$(this).attr('data-id');
        
        $.ajax({
                    url: "php/tasks.php",
                    type: "post",
                    data:"getTaskUpdates=1&taskID="+taskID,
                    
                    success: function(data){
                        //alert(data);
                         $("#viewUpdateModal .modal-body").html(data);
                         $("#viewUpdateModal").modal('show');
                         $('#datatable').DataTable();
                    },
                    error: function(){}             
                });


     });
     $('.modal .file').on('change', function(evt) {
                    var size=this.files[0].size;
                    if(size>=4194304){
                        swal("The file size is too large. Please upload a file below 4 MB. Or you can update the media link in form.");
                        this.value = null;
                        //$('#btn-section').hide();
                    }
                    else
                    {

                        //$('#btn-section').show();
                    }
                    console.log("File size:"+formatBytes(this.files[0].size));
              });
     $('.modal #taskupdate').on('submit', function(evt) {
                    evt.preventDefault();
                    var data=$(".modal #taskupdate").serialize();
                    var formData = new FormData();
                    formData.append('media', $('input[type=file]')[0].files[0]);
                    formData.append('submitTaskUpdates', 1);
                    formData.append('taskData', data);
                    formData.append('taskID', $('input[name=taskID]').val());
                    formData.append('taskupdates', $('textarea[name=taskupdates]').val());
                    formData.append('mediafilelink', $('input[name=mediafilelink]').val());
                    $.ajax({
                        url: "php/tasks.php",
                        type: "post",
                        enctype: 'multipart/form-data',
                        data:formData,
                        contentType: false,
                        processData: false,
                        success: function(res){
                            //console.log(res);
                            if(res=="success"){
                                swal("Updated Added");
                                $(".modal #taskupdate")[0].reset();
                            }
                            else
                            {
                                swal(res);
                            }
                        },
                        error: function(){}             
                    });
              });
     $(document).on('click','.editTaskUpdate',function(e){
        e.preventDefault();
        var taskUpdateID=$(this).attr('data-id');
        
        $.ajax({
                    url: "php/tasks.php",
                    type: "post",
                    data:"getSingleTaskUpdates=1&taskUpdateID="+taskUpdateID,
                    
                    success: function(data){
                        //alert(data);
                         noteData=JSON.parse(data);
                         //$("#viewUpdateModal .modal-body").html(data);
                         $("#updateEditNoteModal textarea[name=taskupdates]").val(noteData.updates);
                         $("#updateEditNoteModal input[name=mediafilelink]").val(noteData.media_link);
                         if(noteData.media!="" && noteData.media!=undefined){
                            
                            var mediapath="../../mediafiles/"+noteData.media;
                            $("#media").html("<a href=\""+mediapath+"\" target=\"_blank\">"+noteData.media+"</a><button class=\"btn btn-danger btn-sm waves-effect waves-light deleteMediaDoc\" data-id=\""+noteData.id+"\" data-img=\""+noteData.media+"\"data-task=\""+noteData.taskID+"\" ><i class=\"fa fa-trash\"></i></button><input type=\"hidden\" id=\"media_current\" value=\""+noteData.media+"\">");
                         }
                         else
                         {
                            $("#media").html("<input type=\"file\" name=\"mediafile\" class=\"form-control file\">");
                         }
                         $("#updateEditNoteModal #edittaskID").val(noteData.taskID);
                         $("#updateEditNoteModal #rowID").val(noteData.id);
                         $("#viewUpdateModal").modal('hide');
                         $("#updateEditNoteModal").modal('show');
                        // $('#datatable').DataTable();
                    },
                    error: function(){}             
                });


     });
     $('#updateEditNoteModal').on('hidden.bs.modal', function () {
        // do something…
        var thistaskID=$("#updateEditNoteModal #edittaskID").val();
        $.ajax({
                    url: "php/tasks.php",
                    type: "post",
                    data:"getTaskUpdates=1&taskID="+thistaskID,
                    
                    success: function(data){
                        //alert(data);
                         $("#viewUpdateModal .modal-body").html(data);
                         $("#viewUpdateModal").modal('show');
                         $('#datatable').DataTable();
                    },
                    error: function(){}             
                });
    });
     $(document).on('click','.deleteTaskUpdate',function(e){
        e.preventDefault();
        var taskUpdateID=$(this).attr('data-id');
        var taskID=$(this).attr('data-task');
        $.ajax({
                    url: "php/tasks.php",
                    type: "post",
                    data:"deleteTaskUpdate=1&taskUpdateID="+taskUpdateID+"&taskID="+taskID,
                    
                    success: function(data){
                       
                      if(data!="error"){
                        // $("#viewUpdateModal").modal('hide');
                        swal("Task Update Deleted Successfully").then(function(){
                            $("#viewUpdateModal .modal-body").html(data);
                           //$("#viewUpdateModal").modal('show');
                            $('#datatable').DataTable();
                        });
                      } 
                      else
                      {
                        swal("Please contact admin. "+data);
                      }                       
                        
                        
                        
                    },
                    error: function(){}             
                });


     });
     $('.modal #taskupdateedit').on('submit', function(evt) {
                    evt.preventDefault();
                    
                    var formData = new FormData();
                    
                    if($('#taskupdateedit input[name=mediafile]').val()!=="" && $('#taskupdateedit input[name=mediafile]').val()!==undefined)
                    {
                        formData.append('media', $('#taskupdateedit input[name=mediafile]')[0].files[0]);
                    }
                    else
                    {
                        formData.append('media_current', $('#taskupdateedit #media_current').val());
                    }
                    formData.append('editTaskUpdate', 1);                    
                    formData.append('taskID', $('#taskupdateedit input[name=taskID]').val());
                    formData.append('taskupdates', $('#taskupdateedit textarea[name=taskupdates]').val());
                    formData.append('mediafilelink', $('#taskupdateedit input[name=mediafilelink]').val());
                    formData.append('rowID', $('#taskupdateedit #rowID').val());
                    $.ajax({
                        url: "php/tasks.php",
                        type: "post",
                        enctype: 'multipart/form-data',
                        data:formData,
                        contentType: false,
                        processData: false,
                        success: function(res){
                           // console.log(res);
                            if(res!="error"){
                                swal("Task Updated. ").then(function(){
                                    $("#updateEditNoteModal").modal('hide');
                                    $("#viewUpdateModal .modal-body").html(data);
                                    $("#viewUpdateModal").modal('show');
                                     $('#datatable').DataTable();
                                });
                                
                            }
                            else
                            {
                                swal(res);
                            }
                        },
                        error: function(){}             
                    });
              });
        $(document).on("click",".deleteMediaDoc",function(e){
                e.preventDefault();
                var img=$(this).attr('data-img');
                var rowID=$(this).attr('data-id');
                var taskID=$(this).attr('data-task');
                swal("Are you sure?").then(function(res){
                    if(res){
                        $.ajax({
                        url: "php/tasks.php",
                        type: 'POST',
                        data: 'deleteMediaDoc=1&img='+img+'&rowID='+rowID+"&taskID="+taskID,
                        success: function(data) {
                               // alert(data)
                                
                                if(data!="error"){
                                    swal("Deleted Successfully").then(function(){
                                        $("#updateEditNoteModal").modal('hide');
                                        $("#viewUpdateModal .modal-body").html(data);
                                        $("#viewUpdateModal").modal('show');
                                        $('#datatable').DataTable();
                                    });
                                }
                                else
                                {
                                    swal(data);
                                }
                                                   
                            }
                        });
                    }
                });
                

            });
 });

 function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}