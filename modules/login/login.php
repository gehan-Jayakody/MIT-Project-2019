<?php
// core configuration
include_once "../../config/core.php";
 
// set page title
$page_title = "Login";
 
// include login checker
$require_login=false;
include_once "login_checker.php";

//Include classes
include_once "../../config/dbconfig.php";
include_once "../../objects/user.php";
 
// Alert default
$alert = "";

if($_POST){
	// initialize objects
	$username = new User();
	$username=$username->userExists();
	$userpasswd = new User();
	$userpasswd=$userpasswd->passwdVerfy();

	// validate login
	if ($username && $userpasswd){
		
		$userdetail = new User();
		$userdetail=$userdetail->userDetails();
	 
		// if it is, set the session value to true
		$_SESSION['logged_in'] = true;
		$_SESSION['login_name'] = $userdetail[0]->login_name;
		$_SESSION['title'] = $userdetail[0]->title;
		$_SESSION['user_role'] = $userdetail[0]->user_role;
		$_SESSION['surname'] = $userdetail[0]->surname;
	 
		// if Role ID is '100-Admin', redirect to admin section
		if($user->user_role=='100'){
			header("Location: {$home_url}/index");
		}
	 
		// else, redirect only to 'Customer' section
		else{
			header("Location: {$home_url}/index");
		}
	}
	 
	// if login name does not exist or password is wrong
	else{
		$alert = "<div style='text-align:center' class='alert alert-danger margin-top-40' role='alert'>
        Access Denied.<br/>
        Your Login ID or Password maybe incorrect.
		</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Portfolio Manger</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/logo-mini.svg" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
		   <?php echo $alert ?>
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg">
              </div>
              <h3>Welcome..!!</h3>
              <h6 class="font-weight-light">Please Sign in to continue.</h6>
              <form class="pt-3"  action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="login_name" name="login_name" placeholder="Login ID" autocomplete="on">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" autocomplete="off">
                </div>
				<div class="mt-3">
                  <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="submit" name="submit">SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/js/vendor.bundle.addons.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>