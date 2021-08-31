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
$taskID=$_GET['temp'];
$task_detail=new Task($db,$taskID);
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
                            <h4 class="page-title"> <i class="dripicons-duplicate"></i> Edit Task</h4>
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
                ?><div class="responsive">
        <form method="post" action="php/tasks.php" onSubmit="return confirm('Submit?');">

            <table class="table">
                <tr>
                    <td>Name</td>
                    <td><input type="text" class="form-control" name="name" required="" value="<?php echo $task_detail->name; ?>"></td>
                </tr>
                 <tr>
                    <td>Description</td>
                    <td><input type="text" class="form-control" name="description" required="" value="<?php echo $task_detail->description; ?>"></td>
                </tr>
                 <tr>
                    <td>Turn around Time (TAT) (in days)</td>
                    <td><input type="number" class="form-control" name="tat" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $task_detail->tat; ?>"></td>
                </tr>
                <tr>
                    <td>Stage</td>
                    <td><select name="stage" class="form-control">
                        <?php echo TaskStage::getListForSelected($db,$task_detail->stage); ?>
                    </select></td>
                </tr>
                <!-- <tr>
                    <td>Assigned To</td>
                    <td><select name="assign_to" class="form-control">
                        <?php //echo User::getUsersListForSelected($db,$task_detail->id); ?>
                    </select></td>
                </tr> -->
                <tr>
                    <td></td>
                    <td>
                       <input type="hidden" name="taskID" value="<?php echo $task_detail->id;?>">
                        <input type="submit" class="btn btn-success" name="updateTask" value="UPDATE"></td>
                </tr>
            </table>
        </form>
    </div>
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


       <?php include(ROOT.'/theme/js-links.php'); ?>

    </body>
</html>