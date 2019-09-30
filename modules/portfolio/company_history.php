<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Portfolio View";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/portfolio.php';
include_once '../../objects/company.php';

//Alert Massages
$alerttype = '';
$alert = '';
$print = 'false';


if($_POST){
	// initialize objects
	$portfolio = new Company();
	$portfolio=$portfolio->companyHistory();
	
	if($portfolio==false){
		$alerttype = 'alert-danger';
		$alert = 'No Company details Found.';
		$print = 'false';
	}
	else{
		include_once '../../libs/table_print.php';
		$print = 'true';
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
  <div class="page-header">
	<h3 class="page-title">
	  View Company History
	</h3>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
		<span class="breadcrumb-item active">Portfolio Management</span>
	  </ol>
	</nav>
  </div>
	<div class="col-12 grid-margin">
	  <div class="card text-black bg-secondary mb-3">
		<div class="card-body">				  
		  <form class="needs-validation" action="modules/portfolio/company_history.php" method="POST" onsubmit="return submitForm(this)" novalidate>
			  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Company Details</p>
			  <div class="form-group row" style="margin-bottom:0.1rem;">
				 <label class="col-3 stretch-card align-items-center">Company Name<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <div class="col-6 input-group">
				 <select class="form-control" name="company_code">
				   <option value="">Select Option</option>
				   <option value="JKH">JOHN KEELLS HOLDINGS PLC</option>
				   <option value="NDB">NATIONAL DEVELOPMENT BANK PLC</option>
				   <option value="SAMP">SAMPATH BANK PLC</option>
				   <option value="DIAL">DIALOG AXIATA PLC</option>
				 </select>
				   <input type="text" class="form-control" name="tranaction_date">
				 </div>
			  </div>
			  <!--
			  <div class="col"><hr style="margin-top:0.1rem;margin-bottom:0.1rem;"></div>
			  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Filter Details</p>
			  <div class="form-group row" style="margin-bottom:0.1rem;">
				 <label class="col-3 stretch-card align-items-center">Date Range<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <label class="col-1 stretch-card justify-content-end align-items-center">From</label>
				 <div class="col-2.5 stretch-card">
					<input type="text" class="form-control form-control-sm" name="tranaction_date">
				 </div>
				 -->
				 <div class="col-1 stretch-card"></div>
				 <div class="col-2.5 stretch-card">
				   <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">View Details</button>
				 </div>
			  </div>
			  
			<div class="col"><hr style="margin-top:0.1rem;margin-bottom:0.1rem;"></div>
		  </form>
		  <?php 
		  if($print == 'true'){
				echo "<table class='table table-striped'>";
				echo "<tr>";
				foreach ( array_keys ( get_object_vars ( reset ( $portfolio ) ) ) as $headings ) {
						$heading = modify($headings);
						echo "<th class='text-center'>".$heading."</th>";
				}
				echo "</tr>";
				foreach(new TableRows(new RecursiveArrayIterator($portfolio)) as $v) { 
					echo $v;
				}
				echo "</table>";
		  }				  
		  ?>
		</div>
	  </div>
	</div>
  </div>
  </div>
 
</body>

</html>
