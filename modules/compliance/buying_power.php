<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Buying Power";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/compliance.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_print = 'false';

if($_POST){
	// initialize objects
	$buying = new Compliance();
	$buying=$buying->buyingPower();
	
	if($buying==false){
		$alerttype = 'alert-danger';
		$alert = 'No Trade details Found.';
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
	Buying Power
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
	  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Client Details</p>
	  <form class="form-inline needs-validation" action="modules/compliance/buying_power.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		<label class="col-3 stretch-card" style="margin-bottom:0.5rem;">CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		<div class="input-group mb-2 mr-sm-2">
		  <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00")">
		</div>
		<div class="col-1 stretch-card"></div>
		<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">View Details</button>
	  </form>
	  
	  <?php 
	  if($out_print == 'true'){
		    echo "<div class='col'><hr style='margin-top:0.1rem'></div>";
			echo "<label class='col-8 stretch-card'>Portfolio Instrument Weighted Value as at ".date('Y-m-d')."</label>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $buying ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($buying)) as $v) { 
				echo $v;
			}
			echo "</table>";
	  }				  
	  ?>
	</div>
  </div>
</div>

</body>

</html>
