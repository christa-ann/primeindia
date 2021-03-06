<?php include('../includes/init.php'); 
//only users check
if($_SESSION['loggedIn'] != 1) {
    header("Location: ".HOST."/users/users/logout.php");
    exit();
}
// if(User::rights($db,$_SESSION['logInID']) >= 20) {
//     header("Location: ".HOST."/users/users/logout.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include ROOT.'/theme/html-links.php'; ?>

    </head>


    <body>

        <!-- Loader -->
       <!--  <div id="preloader"><div id="status"><div class="spinner"></div></div></div> -->

        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav">
                <?php include(ROOT.'/theme/header.php'); ?>
            </header>
            <!-- End Navigation Bar-->

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <!-- <form class="float-right app-search">
                                <input type="text" placeholder="Search..." class="form-control">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form> -->
                            <h4 class="page-title"> <i class="dripicons-duplicate"></i> Manage/Assign Tasks</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

            </div>
        </div>


        <div class="wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php echo $_SESSION['addUserMessage'];
                    $_SESSION['addUserMessage'] = '';
                ?><div class="responsive"><?php echo Task::getList($db,'');?></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
       <?php include(ROOT.'/theme/footer.php'); ?>
        <!-- End Footer -->
<?php include('modal.php'); ?>

       <?php include(ROOT.'/theme/js-links.php'); ?>
<script type="text/javascript">
    

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
     $(document).on('change','.assign',function(){
        var id=this.id;
        var iddata=id.split("_");
        var taskID=iddata[1];
        var userID=this.value;
        swal("Confirm to assign?").then(function(res){
            if(res){
                $.ajax({
                    url: "php/tasks.php",
                    type: "post",
                    data:"assignTask=1&taskID="+taskID+"&userID="+userID,
                    
                    success: function(data){
                        //alert(data);
                         if(data!="error"){
                            
                             itoast.show("Assigned Successfully",5000,'theme_dark');
                        }
                        else
                        {
                            itoast.show("Cannot be Assigned." +data,5000,'theme_dark');
                        }
                       // window.location.reload();
                      
                    },
                    error: function(){}             
                });
            }
        })
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
                    },
                    error: function(){}             
                });


     });

 });
</script>
    </body>
</html>