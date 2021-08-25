<?php 
header("Access-Control-Allow-Origin:*");
include('../../includes/init.php');
$total_order_count=Order::getTotalOrders($db,'');
$total_order_count_user=Order::getTotalOrders($db,$_POST['loginid']);
$today_order_count=Order::getTotalOrdersDateWise($db,date('Y-m-d'));
$salesMenu="<div class=\"post_single\">
			          
		            <span class=\"post_cart\">Today's Order - {$today_order_count}</span>
			            <span class=\"post_cart\">Total Orders - {$total_order_count}</span>
			            <span class=\"post_cart\">Your Orders - {$total_order_count_user}</span>
			          </div>";
$salesMenu.="<a href=\"add-order.html\" class=\"btn btn--full \">Add Order</a>
              <a href=\"view-order.html\" class=\"btn btn--full \">View Order</a>";

$generalMenu="";
$generalMenu.="<a href=\"view-order.html\" class=\"btn btn--full \">View Order</a>";

if(isset($_POST['getMenu'])){
	//print_r($_POST);
	$userType=User::getUserType($db,$_POST['loginid']);
	//echo $userType;
	if($userType==2){
		echo $salesMenu;

	}
	else
	{
		echo $generalMenu;
	}
}

?>