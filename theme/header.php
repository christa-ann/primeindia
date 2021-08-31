
<?php
$userName=User:: getName($db,$_SESSION['logInID']);
$userType=User::getUserType($db,$_SESSION['logInID']);
$userID=User::getUserIDwithLogInID($db,$_SESSION['logInID']);
$profileMenu = "";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
    //$profileMenu .= "<a href=\"".HOST."/users/users/profile.php\"><i class=\"fa fa-user\"></i>Profile</a>";
    $profileMenu .="<a class=\"dropdown-item\" href=\"".HOST."/users/users/profile.php\"><i class=\"dripicons-user text-muted\"></i> Profile</a>";
}

$adminimage=HOST."\assets/images/users/avatar-1.jpg";


$logout=HOST."/users/users/logout.php";
$home=HOST."/users/welcome.php";

$logoutMenu="";
if(User::rights($db,$_SESSION['logInID']) >= 20) {
    
    $logoutMenu .= "<a class=\"dropdown-item\" href=\"".HOST."/users/users/logout.php\"><i class=\"dripicons-exit text-muted\"></i> Logout</a>
                    ";
}

$usersMenu="";
if(User::rights($db,$_SESSION['logInID']) > 20 ) {
    $usersMenu.= "<li class=\"has-submenu\">
                                    <a href=\"#\"><i class=\"dripicons-user-group\"></i> Users <i class=\"mdi mdi-chevron-down mdi-drop\"></i></a>
                                    <ul class=\"submenu\">";
    $usersMenu.="<li><a href=\"".HOST."/users/usertype/manage-usertype.php\"><span>Manage User Roles</span></a></li>";
    $usersMenu.="<li><a href=\"".HOST."/users/users/add-users.php\"><span>Add Users</span></a></li>";
    $usersMenu.="<li><a href=\"".HOST."/users/users/manage-users.php\"><span>Manage Users</span></a></li>";
    //$usersMenu.="<li><a href=\"".HOST."/users/users/emp_attendance.php\"><span>Attendance Overview</span></a></li>";
    
    $usersMenu.="</ul></li>";
    
    
} 

$tasksMenu="";
if(User::rights($db,$_SESSION['logInID']) >= 20  ) {
    $tasksMenu.= "<li class=\"has-submenu\">
                                    <a href=\"#\"><i class=\"dripicons-checklist\"></i>Tasks <i class=\"mdi mdi-chevron-down mdi-drop\"></i></a>
                                    <ul class=\"submenu\">";

    if($userType==5 || User::rights($db,$_SESSION['logInID']) == 100  ) {
        $tasksMenu.="<li><a href=\"".HOST."/users/task/add-task.php\"><span>Add Task</span></a></li>";
    //$tasksMenu.="<li><a href=\"#\"><span>Assign Task</span></a></li>";
        $tasksMenu.="<li><a href=\"".HOST."/users/task/manage-tasks.php\"><span>Manage Tasks</span></a></li>";        
       
    }
    else{
        $tasksMenu.="<li><a href=\"".HOST."/users/task/team-tasks.php\"><span>View/Update Tasks</span></a></li>"; 
    }                              
        
     $tasksMenu.="</ul></li>";
}

// $masterMenu="";
// if(User::rights($db,$_SESSION['logInID']) >= 20 && $userType<=1) {
//     $masterMenu.= "<li class=\"has-submenu\">
//                                     <a href=\"#\"><i class=\"dripicons-rocket\"></i>Master <i class=\"mdi mdi-chevron-down mdi-drop\"></i></a>
//                                     <ul class=\"submenu\">";
//     $masterMenu.="<li class=\"has-submenu\">
//                                             <a href=\"#\">Customers</a>
//                                             <ul class=\"submenu\">
//                                                 <li><a href=\"".HOST."/users/customer/add-customer.php\">Add Customer</a></li>
//                                                 <li><a href=\"".HOST."/users/customer/manage-customer.php\">Manage Customer</a></li>
                                                
//                                             </ul>
//                                         </li>";
//     $masterMenu.="<li class=\"has-submenu\">
//                                             <a href=\"#\">Terms</a>
//                                             <ul class=\"submenu\">
//                                                 <li><a href=\"".HOST."/users/terms/add-terms.php\">Add Terms</a></li>
//                                                 <li><a href=\"".HOST."/users/terms/manage-terms.php\">Manage Terms</a></li>
                                                
//                                             </ul>
//                                         </li>";
//     $masterMenu.="<li class=\"has-submenu\">
//                                             <a href=\"#\">Pack</a>
//                                             <ul class=\"submenu\">
//                                                 <li><a href=\"".HOST."/users/pack/add-pack.php\">Add Pack</a></li>
//                                                 <li><a href=\"".HOST."/users/pack/manage-pack.php\">Manage Pack</a></li>
                                                
//                                             </ul>
//                                         </li>";
//     $masterMenu.="<li class=\"has-submenu\">
//                                             <a href=\"#\">Product</a>
//                                             <ul class=\"submenu\">
//                                                 <li><a href=\"".HOST."/users/product/add-product.php\">Add Product</a></li>
//                                                 <li><a href=\"".HOST."/users/product/manage-product.php\">Manage Product</a></li>
                                                
//                                             </ul>
//                                         </li>";
//     $masterMenu.="<li class=\"has-submenu\">
//                                             <a href=\"#\">Warehouse</a>
//                                             <ul class=\"submenu\">
//                                                 <li><a href=\"".HOST."/users/warehouse/add-warehouse.php\">Add Warehouse</a></li>
//                                                 <li><a href=\"".HOST."/users/warehouse/manage-warehouse.php\">Manage Warehouse</a></li>
                                                
//                                             </ul>
//                                         </li>";
                                        
    
    
    
    
//     $masterMenu.="</ul></li>";
    
    
// } 

?>
<div class="topbar-main">
                    <div class="container-fluid">

                        <!-- Logo container-->
                        <div class="logo">
                            <!-- Text Logo -->
                            <a href="index.html" class="logo">
                                Prime India
                            </a>
                            <!-- Image Logo -->
                            <!-- <a href="index.html" class="logo">
                                <img src="assets/images/logo-sm.png" alt="" height="22" class="logo-small">
                                <img src="assets/images/logo.png" alt="" height="24" class="logo-large">
                            </a> -->

                        </div>
                        <!-- End Logo container-->


                        <div class="menu-extras topbar-custom">

                            <ul class="list-inline float-right mb-0">
                                
                                <!-- notification-->
                                <!-- <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <i class="ti-bell noti-icon"></i>
                                        <span class="badge badge-info badge-pill noti-icon-badge">3</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                        
                                        <div class="dropdown-item noti-title">
                                            <h5>Notification (3)</h5>
                                        </div>

                                        
                                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                        </a>

                                        
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                            <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
                                        </a>

                                        
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                                            <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
                                        </a>

                                   
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            View All
                                        </a>

                                    </div>
                                </li> -->
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <img src="<?php echo $adminimage; ?>" alt="user" class="rounded-circle">
                                        <span class="ml-1"><?php echo $userName; ?> <i class="mdi mdi-chevron-down"></i> </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <?php echo $profileMenu; ?>
                                        <!-- <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> My Wallet</a>
                                        <a class="dropdown-item" href="#"><span class="badge badge-success pull-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a>
                                        <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a> -->
                                        <div class="dropdown-divider"></div>
                                       <?php echo $logoutMenu; ?>
                                    </div>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>

                            </ul>
                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <div class="navbar-custom">
                    <div class="container-fluid">
                        <div id="navigation">
                            <!-- Navigation Menu-->
                            <ul class="navigation-menu">

                                <li class="has-submenu">
                                    <a href="<?php echo $home;?>"><i class="dripicons-device-desktop"></i>Dashboard</a>
                                </li>
                                <?php 
                                      
                                      echo $usersMenu; 
                                      echo $tasksMenu;
                                      
                                ?>
                                <!-- <li class="has-submenu">
                                    <a href="#"><i class="dripicons-suitcase"></i>User Interface <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu megamenu">
                                        <li>
                                            <ul>
                                                <li><a href="ui-buttons.html">Buttons</a></li>
                                                <li><a href="ui-cards.html">Cards</a></li>
                                                <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                                <li><a href="ui-modals.html">Modals</a></li>
                                                <li><a href="ui-images.html">Images</a></li>
                                                <li><a href="ui-alerts.html">Alerts</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                                <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                                <li><a href="ui-lightbox.html">Lightbox</a></li>
                                                <li><a href="ui-navs.html">Navs</a></li>
                                                <li><a href="ui-pagination.html">Pagination</a></li>
                                                <li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li><a href="ui-badge.html">Badge</a></li>
                                                <li><a href="ui-carousel.html">Carousel</a></li>
                                                <li><a href="ui-video.html">Video</a></li>
                                                <li><a href="ui-typography.html">Typography</a></li>
                                                <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                                                <li><a href="ui-grid.html">Grid</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#"><i class="dripicons-to-do"></i>Components <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li class="has-submenu">
                                            <a href="#">Email</a>
                                            <ul class="submenu">
                                                <li><a href="email-inbox.html">Inbox</a></li>
                                                <li><a href="email-read.html">Email Read</a></li>
                                                <li><a href="email-compose.html">Email Compose</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="calendar.html">Calendar</a>
                                        </li>
                                        <li class="has-submenu">
                                            <a href="#">Forms</a>
                                            <ul class="submenu">
                                                <li><a href="form-elements.html">Form Elements</a></li>
                                                <li><a href="form-validation.html">Form Validation</a></li>
                                                <li><a href="form-advanced.html">Form Advanced</a></li>
                                                <li><a href="form-editors.html">Form Editors</a></li>
                                                <li><a href="form-uploads.html">Form File Upload</a></li>
                                                <li><a href="form-mask.html">Form Mask</a></li>
                                                <li><a href="form-summernote.html">Summernote</a></li>
                                                <li><a href="form-xeditable.html">Form Xeditable</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-submenu">
                                            <a href="#">Icons</a>
                                            <ul class="submenu">
                                                <li><a href="icons-material.html">Material Design</a></li>
                                                <li><a href="icons-ion.html">Ion Icons</a></li>
                                                <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                                                <li><a href="icons-themify.html">Themify Icons</a></li>
                                                <li><a href="icons-dripicons.html">Dripicons</a></li>
                                                <li><a href="icons-typicons.html">Typicons Icons</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-submenu">
                                            <a href="#">Charts</a>
                                            <ul class="submenu">
                                                <li><a href="charts-morris.html">Morris Chart</a></li>
                                                <li><a href="charts-chartist.html">Chartist Chart</a></li>
                                                <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                                                <li><a href="charts-flot.html">Flot Chart</a></li>
                                                <li><a href="charts-c3.html">C3 Chart</a></li>
                                                <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-submenu">
                                            <a href="#">Tables </a>
                                            <ul class="submenu">
                                                <li><a href="tables-basic.html">Basic Tables</a></li>
                                                <li><a href="tables-datatable.html">Data Table</a></li>
                                                <li><a href="tables-responsive.html">Responsive Table</a></li>
                                                <li><a href="tables-editable.html">Editable Table</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-submenu">
                                            <a href="#">Maps</a>
                                            <ul class="submenu">
                                                <li><a href="maps-google.html"> Google Map</a></li>
                                                <li><a href="maps-vector.html"> Vector Map</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#"><i class="dripicons-trophy"></i>Advanced UI <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li><a href="advanced-animation.html">Animation</a></li>
                                        <li><a href="advanced-highlight.html">Highlight</a></li>
                                        <li><a href="advanced-rating.html">Rating</a></li>
                                        <li><a href="advanced-nestable.html">Nestable</a></li>
                                        <li><a href="advanced-alertify.html">Alertify</a></li>
                                        <li><a href="advanced-rangeslider.html">Range Slider</a></li>
                                        <li><a href="advanced-sessiontimeout.html">Session Timeout</a></li>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#"><i class="dripicons-copy"></i>Pages <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu megamenu">
                                        <li>
                                            <ul>
                                                <li><a href="pages-timeline.html">Timeline</a></li>
                                                <li><a href="pages-invoice.html">Invoice</a></li>
                                                <li><a href="pages-directory.html">Directory</a></li>
                                                <li><a href="pages-login.html">Login</a></li>
                                                <li><a href="pages-register.html">Register</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li><a href="pages-recoverpw.html">Recover Password</a></li>
                                                <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                                <li><a href="pages-blank.html">Blank Page</a></li>
                                                <li><a href="pages-404.html">Error 404</a></li>
                                                <li><a href="pages-500.html">Error 500</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> -->

                            </ul>
                            <!-- End navigation menu -->
                        </div> <!-- end #navigation -->
                    </div> <!-- end container -->
                </div> <!-- end navbar-custom -->