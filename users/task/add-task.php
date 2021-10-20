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
                            <h4 class="page-title"> <i class="dripicons-duplicate"></i> Create Task</h4>
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
                    <td>Task Name</td>
                    <td><input type="text" class="form-control" name="name" required=""></td>
                </tr>
                 <tr>
                    <td>Task Description</td>
                    <td><input type="text" class="form-control" name="description" required=""></td>
                </tr>
                 <tr>
                    <td>To be completed  by</td>
                    <td><input class="form-control" type="datetime-local" name="tat" id="example-datetime-local-input">
                        <!-- <input type="number" class="form-control" name="tat" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> -->
                    </td>
                </tr>
                <!-- <tr>
                    <td>Assign To</td>
                    <td><select name="assign_to" class="form-control">
                        <?php //echo User::getUsersListForSelect($db); ?>
                    </select></td>
                </tr> -->
                <tr>
                    <td></td>
                    <td><input type="submit" class="btn btn-success" name="addTask" value="ADD"></td>
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