<?php include('users/includes/init.php'); 

//init_set('display_error',1);
//echo mail("christaannphilip@gmail.com","hi","test");
//echo Email::newMemberEmail("christaannphilip@gmail.com","kahsgajghdajkshdgksajh");
Email::notifyTaskComplete($db,'33');
?>