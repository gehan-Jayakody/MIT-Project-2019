<?php
// core configuration
include_once "../../config/core.php";
 
// set page title
$page_title = "User Password Reset";
 
// include login checker
//include_once "../../login/login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/user.php';

//Alert Massages
$alerttype = '';
$alert = '';
if($_POST){
    // initialize objects
    $user = new User();

	if($user->userExists()){
		// check if user name already exists
		if($user->passwdReset()){
			$alerttype = 'alert-info';
			$alert = 'Password Reset successfully completed.';
			// empty posted values
			$_POST=array();

		}
		else{
			$alerttype = 'alert-danger';
			$alert = 'Password Reset Failed. Please Try Again!!.';
		}
	}
	else{
		$alerttype = 'alert-danger';
		$alert = 'The Login ID you specified is not Exists!!.';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
<div class="page-header">
  <h3 class="page-title">
    System User Password Reset
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">User Management</span>
    </ol>
  </nav>
</div>
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">
	  <form class="needs-validation" action="modules/user/user_passwd_reset.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-3 stretch-card"><p class="text-danger"><sup>*</sup></p>Login ID<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="login_name" placeholder="Login ID Required" autocomplete="on"  required>
			   <div class="invalid-tooltip">Please enter Login ID</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card"><p class="text-danger"><sup>*</sup></p>Password<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="password" class="form-control" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  required>
			   <div class="invalid-tooltip">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card">Confirm Password<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="password" class="form-control" name="password_confirm" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  required>
			   <div class="invalid-tooltip">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</div>
			 </div>
		  </div>
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" onclick="checkInput()">Reset</button>
			</div>
		</div>
	  </form>
	</div>
  </div>
</div>

</body>

</html>
