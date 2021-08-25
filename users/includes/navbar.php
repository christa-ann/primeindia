<?php 
$sourceMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$sourceMenu .= "
							<li class=\"dropdown\">
							  	<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Source <span class=\"caret\"></span></a>
							  	<ul class=\"dropdown-menu\">
									<li><a href=\"".HOST."/users/source/manage-source.php\">Manage Source</a></li>
								</ul>
							</li>"
							;
}


$customerMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$customerMenu .= "
						<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Training <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
								<li><a href=\"".HOST."/users/customers/add-customer.php\">Add Training</a></li>
								<li><a href=\"".HOST."/users/customers/manage-customers.php\">Manage Training</a></li>
							</ul>
						</li>
					";
}

$categoryMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$categoryMenu .= "
							<li class=\"dropdown\">
							  	<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Category <span class=\"caret\"></span></a>
							  	<ul class=\"dropdown-menu\">
									<li><a href=\"".HOST."/users/category/manage-category.php\">Manage Category</a></li>
								</ul>
							</li>"
							;
}

$salesMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$salesMenu .= "
						<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Contacts <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
					";
	$salesMenu .= "<li><a href=\"".HOST."/users/sales/new-enquiry.php\">New Contacts</a></li>";
	//$salesMenu .= "<li><a href=\"".HOST."/users/sales/follow-up.php\">Follow Up</a></li>";
	$salesMenu .= "
						</ul>
					</li>
					";
}
$paymentsMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$paymentsMenu .= "
						<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Payments <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
					";
	$paymentsMenu .= "<li><a href=\"".HOST."/users/sales/new-enquiry.php\">Add Payment details</a></li>";
	$paymentsMenu .= "<li><a href=\"".HOST."/users/sales/follow-up.php\">Follow Up</a></li>";
	$paymentsMenu .= "
						</ul>
					</li>
					";
}
$marketingMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$marketingMenu .= "
						<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Marketing <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
					";
	$marketingMenu .= "<li><a href=\"".HOST."/users/sales/new-enquiry.php\">Manage Marketing</a></li>";
	$marketingMenu .= "<li><a href=\"".HOST."/users/sales/follow-up.php\">Marketing Overview</a></li>";
	$marketingMenu .= "
						</ul>
					</li>
					";
}
$manageMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$manageMenu .= "
						<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Manage <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
					";
	$manageMenu .= "<li><a href=\"".HOST."/users/source/manage-source.php\">Source</a></li>";
	$manageMenu .= "<li><a href=\"".HOST."/users/category/manage-category.php\">Contact Category</a></li>";
	$manageMenu .= "<li><a href=\"".HOST."/users/training-category/manage-training-category.php\">Training Category</a></li>";
	$manageMenu .= "<li><a href=\"".HOST."/users/customers/manage-customers.php\">All Trainings</a></li>";
	$manageMenu .= "<li><a href=\"".HOST."/users/customers/add-customer.php\">Add Training</a></li>";
	$manageMenu .= "</ul>
					</li>
					";
}
$projectMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$projectMenu .= "
						<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Project <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
					";
	$projectMenu .= "<li><a href=\"".HOST."/users/project/update-project-cost.php\">Update Revenue / Cost</a></li>";
	$projectMenu .= "<li><a href=\"".HOST."/users/project/project-monitor.php\">Project Monitor</a></li>";
	$projectMenu .= "<li><a href=\"".HOST."/users/project/create-project.php\">Create Project</a></li>";
	$projectMenu .= "<li><a href=\"".HOST."/users/project/manage-heads.php\">Manage Heads</a></li>";
	$projectMenu .= "
						</ul>
					</li>
					";
}

$userMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 90) {
	$userMenu .= "
					<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Users <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
				";
	$userMenu .= "<li><a href=\"".HOST."/users/users/manage-users.php\">Manage Users</a></li>";
	$userMenu .= "
						</ul>
					</li>
				";
}


$homeMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$homeMenu .= "<li><a href=\"".HOST."/users/welcome.php\">Home</a></li>";
}

//profile menu
$profileMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
	$profileMenu .= "<li><a href=\"".HOST."/users/users/profile.php\">Profile</a></li>";
}

//logout
if($_SESSION['loggedIn'] == 1) {
	$logOut = "<li><a href=\"".HOST."/users/users/logout.php\">Log Out</a></li>";
} else {
	$logOut = "";
}

//Admin log in
$adminMenuItem = "";
if(User::rights($db,$_SESSION['logInID']) >= 90) {
	$adminMenuStart = "<ul class=\"nav navbar-nav navbar-right\">
							<li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Admin Tools <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\">
						";
	$adminMenuItem .= "<li><a href=\"".HOST."/users/admin/temp.php\">Temp</a></li>";
	$adminMenuEnd = "</ul>
						</ul>
					</li>
					";
	
	$adminMenu = $adminMenuStart.$adminMenuItem.$adminMenuEnd;
}


?>

<nav class="navbar navbar-custom">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li><a href="#">Link</a></li>-->        
            <?php echo $homeMenu; ?>
            <?php echo $manageMenu; ?>
            <?php //echo $sourceMenu; ?>
            <?php //echo $categoryMenu; ?>
			<?php //echo $customerMenu; ?>
			<?php echo $salesMenu; //contacts ?> 
			<?php echo $paymentsMenu; ?>
            <?php echo $marketingMenu; ?>
            <?php //echo $projectMenu; ?>           
      </ul>
      
      <!--ADMIN MENU-->
      <?php //echo $adminMenu; ?>
      
      <ul class="nav navbar-nav navbar-right">
          	<?php echo $userMenu; ?>
			<?php echo $profileMenu; ?>
            <?php echo $logOut; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

