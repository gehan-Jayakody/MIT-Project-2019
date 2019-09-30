<?php
// core configuration
include_once "../../config/core.php";
 
// set page title
$page_title = "User Register";
 
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

    // check if user name already exists
    if($user->userExists()){
        $alerttype = 'alert-danger';
		$alert = 'The Login ID you specified is already registered.';

    }
	else{
		// create the user
		if($user->createUser()){
			$alerttype = 'alert-info';
			$alert = 'Successfully registered.';
			// empty posted values
			$_POST=array();
		}
		else{
			$alerttype = 'alert-danger';
			$alert = 'Unable to register. Please try again.';
		}
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
    Add New System User
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
	  <form class="needs-validation" action="modules/user/user_add.php" method="POST" onsubmit="return submitForm(this)" novalidate>
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
			   <input type="password" class="form-control" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="on"  required>
			   <div class="invalid-tooltip">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card">Title<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="title">
				  <option value="">Select Option</option>
				  <option value="Mr.">Mr.</option>
				  <option value="Mrs.">Mrs.</option>
				  <option value="Miss.">Miss.</option>
				  <option value="Prof.">Prof.</option>
				  <option value="Rev.">Rev.</option>
				  <option value="Dr.">Dr.</option>
				  <option value="Ms.">Ms.</option>							  
				</select>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card">Initials<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="initials">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card">Name Denoted by initials<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-7 stretch-card">
			   <input type="text" class="form-control" name="name_denoted_by">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card">Last Name<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-5 stretch-card">
			   <input type="text" class="form-control" name="surname">						   
			 </div>
		  </div>					  					  
		  <div class="form-group row">
			 <label class="col-3 stretch-card"><p class="text-danger"><sup>*</sup></p>Role<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="user_role" id="user_role" onchange="userRole()" autocomplete="on" required>
				  <option value="">Select Option</option>
				  <option value="110">Client Viewer</option>
				  <option value="120">Client Advisor</option>
				  <option value="130">BackOffice Staff</option>
				  <option value="100">IT Administrator</option>
				</select>
			 </div>
		  </div>			  
		  <div class="form-group row">
			 <label class="col-3 stretch-card"><p class="text-danger"><sup>*</sup></p>Email<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-5 stretch-card">
			   <input type="email" class="form-control" name="email" placeholder="Email Address Required" autocomplete="on" required>
			   <div class="invalid-tooltip">Please Fill Email Address</div>
			 </div>
		  </div>
		  <div id="userRole_opt2" style="display:none">
		  <div class="form-group row">
			 <label class="col-3 stretch-card"><p class="text-danger"><sup>*</sup></p>Advisor Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="advisor_code" placeholder="Advisor Code Required">
			   <div class="invalid-tooltip">Please enter Advisor Code</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card">Commission Rate<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="number" class="form-control" name="commission_rate" placeholder="0.00 %" min="0.01" max="100" step="0.01">
			 </div>
		  </div>
		  </div>
		  <div id="userRole_opt1" style="display:none">
		  <div class="form-group row">
			 <label class="col-3 stretch-card"><p class="text-danger"><sup>*</sup></p>Backoffice Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="backoffice_code" placeholder="Backoffice Code Required">
			   <div class="invalid-tooltip">Please enter Backoffice Code</div>
			 </div>
		  </div>
		  </div>
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" id="submit" name="submit" value="submit" onclick="checkInput()">Submit</button>
			</div>
			<div class="col-3 stretch-card" align="center">
				<button type="reset" class="btn btn-gradient-info btn-rounded btn-fw">Cancel</button>
			</div>
		</div>
	  </form>
	</div>
  </div>
</div>

</body>

</html>
