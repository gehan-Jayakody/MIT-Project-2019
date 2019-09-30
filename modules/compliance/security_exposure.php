<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Security Exposure";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/compliance.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_print = 'false';

if(!empty($_POST['instrument_id'])){
	// initialize objects
	$exposure = new Compliance();
	$exposure=$exposure->securityExpose();
	$_SESSION['instrument_id'] = $_POST['instrument_id'];
	
	if($exposure==false){
		$alerttype = 'alert-danger';
		$alert = 'No Security Exposure details Found.';
		$out_print = 'false';
	}
	else{
		include_once '../../libs/table_print.php';
		$out_print = 'true';
		function modify($str) {
			return ucwords(str_replace("_", " ", $str));
		}
	}
}
elseif(!empty($_POST['weightage'])){
	// initialize objects
	$exposureUpdate = new Compliance();
	$exposureUpdate=$exposureUpdate->exposureUpdate();
	$out_print = 'false';
	
	if($exposureUpdate==false){
		$alerttype = 'alert-danger';
		$alert = 'Security Exposure Update Failed.';

	}
	else{
		$alerttype = 'alert-success';
		$alert = 'Security Exposure Update Success.';
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
	Security Exposure
  </h3>
  <nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">Compliance Management</span>
	</ol>
  </nav>
</div>		 
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">
	  <form class="form-inline needs-validation" action="modules/compliance/security_exposure.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		<label class="col-3 stretch-card" style="margin-bottom:0.5rem;">Instrument Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		<div class="input-group mb-2 mr-sm-2">
		  <input type="text" class="form-control" name="instrument_id" placeholder="Instrument Code Equity Only" pattern="[A-Z]{3,}.[A-Z]{1}[0-9]{4}" required>
		</div>
		<div class="col-1 stretch-card"></div>
		<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">View Details</button>
	  </form>
	  
	  <?php 
	  if($out_print == 'true'){
		    echo "<div class='col'><hr style='margin-top:0.1rem;margin-bottom:0.1rem;'></div>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $exposure ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($exposure)) as $v) { 
				echo $v;
			}
			echo "</table>";
			echo "</br>";
			echo "<div class='col'><hr style='margin-top:0.1rem'></div>";
			echo "<label class='col-8 stretch-card'>Adjust Security Exposure Value</label>";
		
	  echo "<form class='form-inline' action='modules/compliance/security_exposure.php' method='POST' onsubmit='return submitForm1(this)'>";
		echo "<div class='slidecontainer'>";
			echo "<input type='range' min='1' max='100' value='50' class='slider' id='myRange' onchange='range()'>";
		echo "</div>";
		echo "<div></div>";
		echo "<label class='col-3 stretch-card' style='margin-bottom:0.5rem;'>New Security Exposure<p>&nbsp;</p>:-<p>&nbsp;</p></label>";
		echo "<div class='input-group mb-2 mr-sm-2'>";
		  echo "<input type='number' class='form-control' name='weightage' id='weightage'>";
		echo "</div>";
		echo "<div class='col-1 stretch-card'></div>";
		echo "<button type='submit' class='btn btn-gradient-info btn-rounded btn-fw' style='margin-bottom:0.5rem;' name='submit' value='submit' >Update Details</button>";
	  echo "</form>";	
	  }			  
	  ?>	  
	</div>
  </div>
</div>

</body>

</html>
