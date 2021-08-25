<?php include('users/includes/init.php');?>
<!DOCTYPE html>
<html>
<head>
        <?php include 'theme/html-links.php'; ?>

    </head>


    <body>

        <!-- Loader -->
        <!-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> -->

        <!-- Begin page -->
        <div class="accountbg" style="background:radial-gradient(at 50% -20%,#eb1429,#0a1832) fixed!important; "></div>
        <div class="wrapper-page">

            <div  class="card">
                <div  class="card-body">

                    <h3 class="text-center m-0">
                        <!-- <img src="<?php echo HOST; ?>/assets/images/logo_dark.png" height="80" alt="logo"> -->
                    </h3>

                    <div class="p-3">
                        
                        <?php echo $_SESSION['newMemberMessage']; $_SESSION['newMemberMessage'] = ""; ?>
        <h3>New Member:</h3>
        <p>Please provide your Email ID available with us.</p>
        <form method="post" action="users/users/php/users.php">
            <div class="form-group">
                                
                                 <input class="form-control" style="width:300px;" name="email" placeholder="Email ID" required="">
                            </div>
           
            
        

                            <div class="form-group row m-t-20">
                                <div class="col-sm-2">
                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div> -->
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="submit" class="btn btn-primary w-md waves-effect waves-light" name="newMemberSubmit" style="margin-top:20px;">SEND</button>
                                </div>
                            </div>
<div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <!-- <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a> -->
                                   <a href="index.php" class="font-500 font-14 text-primary font-secondary"> <i class="mdi mdi-home"></i> Back to home. </a> 
               <!-- <p>© <?php //echo date("Y"); ?> DyanDni. Developed by <a href="https://rejola.com/">REJOLA IT SERVICES</a></p>  --> 
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
<!-- Footer -->
       <?php include(ROOT.'/theme/footer.php'); ?>
        <!-- End Footer -->


       <?php include(ROOT.'/theme/js-links.php'); ?>
</body>
</html>