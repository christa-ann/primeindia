<?php include('users/includes/init.php');?>
<?php 
//verifying security key
if($userID = Security::checkSecurityExists($db,$_GET['security'])) {
    //allow to change or add new password   
} else {
    $_SESSION['newMemberMessage'] = "<h3 style=\"color:red;\">Sorry.  Your account is not active.  Please write to thomas@rejola.com</h3>";
    header("Location: ".HOST."/new-member.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
        <?php include 'theme/html-links.php'; ?>

    </head>


    <body>



        <!-- Loader -->
        <!-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> -->

        <!-- Begin page -->
        <div class="accountbg" style="background:radial-gradient(at 50% -20%, #004a43, #0a1832) fixed!important; "></div>
        <div class="wrapper-page">

            <div  class="card">
                <div  class="card-body">

                    <h3 class="text-center m-0">
                        <!-- <img src="<?php echo HOST; ?>/assets/images/logo_dark.png" height="80" alt="logo"> -->
                    </h3>

                    <div class="p-3">
                        <?php echo $_SESSION['logInMessage']; $_SESSION['logInMessage']=""; ?>
                        <?php echo $_SESSION['newMemberPasswordMessage']; $_SESSION['newMemberPasswordMessage'] = ""; ?>
        <h3>New Member Password:</h3>
        <p>Welcome <u><?php echo User::getName($db,$_SESSION['email']); ?></u>!</p>
        <p>Please type your password:</p>
                       <!--  <p class="text-muted text-center">Sign in to continue to <?php echo SITE;   ?>.</p> -->

                        <form method="post" action="users/users/php/users.php">
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" class="form-control" style="width:300px;" name="password" required="">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Re-type Password</label>
                                <input type="password" class="form-control" style="width:300px;" name="password2" required="">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-sm-2">
                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div> -->
                                </div>
                                <div class="col-sm-6 text-right">
                                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                    <button type="submit" class="btn btn-primary w-md waves-effect waves-light" style="width:300px;" name="newMemberPassword" >SAVE</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>

                </div>
            </div>

            <!-- <div class="m-t-40 text-center">
                <p>Don't have an account ? <a href="pages-register.html" class="font-500 font-14 text-primary font-secondary"> Signup Now </a> </p>
                <p>© 2018 Fonik. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
            </div> -->

        </div>

</body>
</html>