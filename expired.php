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
                         
                         <p class="text-muted text-center" style="color:red!important;font-size: 20px!important;">Subscription has expired.<br><b>Kindly renew your subscription.</b></p>
                        <?php echo $_SESSION['logInMessage']; $_SESSION['logInMessage']=""; ?>
                       
                           
                        
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