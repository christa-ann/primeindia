<?php include('users/includes/init.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'theme/html-links.php'; ?>

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg" style="background:radial-gradient(at 50% -20%,#eb1429,#0a1832) fixed!important; "></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <!-- <a href="index.html" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="30" alt="logo"></a> -->
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to Prime India.</p>
                        <?php echo $_SESSION['logInMessage']; $_SESSION['logInMessage']=""; ?>
                        <form class="form-horizontal m-t-30" action="users/users/login-check.php" method="post">

                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username" name="logInID" value="<?php if(isset($_COOKIE["uname_cookie"])) { echo $_COOKIE["uname_cookie"]; } ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="userpassword" placeholder="Enter password" name="password" value="<?php if(isset($_COOKIE["password_cookie"])) { echo $_COOKIE["password_cookie"]; } ?>" required>
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline" name="remember" checked="">
                                        <label class="custom-control-label" for="customControlInline" >Remember me</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <!-- <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a> -->
                                  <!--  <a href="new-member.php" class="font-500 font-14 text-primary font-secondary"> <i class="mdi mdi-lock"></i> Create your account. </a>  -->
               <!-- <p>© <?php //echo date("Y"); ?> DyanDni. Developed by <a href="https://rejola.com/">REJOLA IT SERVICES</a></p>  --> 
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            

        </div>

<!-- Footer -->
       <?php include(ROOT.'/theme/footer.php'); ?>
        <!-- End Footer -->


       <?php include(ROOT.'/theme/js-links.php'); ?>

    </body>
</html>