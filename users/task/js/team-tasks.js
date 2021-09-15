    

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
                            console.log(res);
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

 });

 function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}