<?php include('../includes/init.php');
//only users check
if($_SESSION['loggedIn'] != 1) {
    header("Location: ".HOST."/users/users/logout.php");
    exit();
}
//only rights check
// if(User::rights($db,$_SESSION['logInID']) < 90) {
//     header("Location: ".HOST."/users/users/logout.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(ROOT."/theme/html-links.php"); error_reporting(1);?>

</head>

<body>

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
                           <!--  <form class="float-right app-search">
                                <input type="text" placeholder="Search..." class="form-control">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form> -->
                            <h4 class="page-title"> <i class="dripicons-duplicate"></i> Manage User Roles</h4>
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
<!--  <h3>Add User Role</h3>
                                <?php echo $_SESSION['addItemMessage'];
            $_SESSION['addItemMessage'] = '';
        ?>
        <div class="responsive">
        <form method="post" action="php/usertype.php" onSubmit="return confirm('Submit?');">
            <table class="table">
                <tr>
                    <td>Role Name</td>
                    <td><input class="form-control" name="name"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="btn btn-success" name="addUserType" value="ADD"></td>
                </tr>
            </table>
        </form>
    </div> -->


                                <h3>Existing User Roles</h3>
                                 <?php echo $_SESSION['editUserMessage'];
            $_SESSION['editUserMessage'] = '';
        ?>
        <?php echo UserType::getList($db,'edit'); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <!-- Footer Section Start -->
        <?php include (ROOT."/theme/footer.php");?>
        <!-- Footer Section End -->



    <!-- JS
============================================ -->

    <?php include (ROOT."/theme/js-links.php"); ?>

</body>
</html>