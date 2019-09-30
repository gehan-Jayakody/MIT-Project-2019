<?php 
// if $require_login was set and value is 'true'
if(isset($require_login) && $require_login==true){
    // if user not yet logged in, redirect to login page
    if(!isset($_SESSION['user_role'])){
        header("Location: {$home_url}/modules/login/login.php");
    }
}
 
// if it was the 'login' or 'register' or 'sign up' page but the customer was already logged in
else if(isset($page_title) && ($page_title=="Login" || $page_title=="Sign Up")){
    // if user not yet logged in, redirect to login page
    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=="110"){
        header("Location: {$home_url}/index.php");
    }
}

else{
    // no problem, stay on current page
}
?>