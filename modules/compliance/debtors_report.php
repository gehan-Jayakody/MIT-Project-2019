<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Debtors Report";
 
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
	if(empty($_POST["from_date"]) && empty($_POST["to_date"])){
		$alerttype = 'alert-danger';
		$alert = 'Please Select the Date Range.';
		$out_print = 'false';
	}
	elseif(!empty($_POST["from_date"]) && empty($_POST["to_date"])){
		$alerttype = 'alert-danger';
		$alert = 'Please Select the From Date.';
		$out_print = 'false';
	}
	elseif(empty($_POST["from_date"]) && !empty($_POST["to_date"])){
		$alerttype = 'alert-danger';
		$alert = 'Please Select the To Date.';
		$out_print = 'false';
	}
	else{
		$debtor = new Compliance();
		$debtor=$debtor->debtorReport();
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
<div class="page-header">
  <h3 class="page-title">
    Debtors Report
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
	  <form class="needs-validation" action="modules/compliance/debtors_report.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Filter Details</p>
		  <div class="form-group row" style="margin-bottom:0.1rem;">
			 <label class="col-1.5 stretch-card align-items-center">Date Range<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <label class="col-1 stretch-card justify-content-end align-items-center">From</label>
			 <div class="col-2.5 stretch-card">
				<input type="date" class="form-control form-control-sm" name="from_date">
			 </div>
			 <label class="col-1 stretch-card justify-content-end align-items-center">To</label>
			 <div class="col-2.5 stretch-card">
				<input type="date" class="form-control form-control-sm" name="to_date">
			 </div>
			 <div class="col-1 stretch-card"></div>
			 <div class="col-2.5 stretch-card">
			   <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">Generate Report</button>
			 </div>
		  </div>
		<div class="col"><hr style="margin-top:0.1rem;margin-bottom:0.1rem;"></div>
	  </form>
	  <?php 
	  if($out_print == 'true'){
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $debtor ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($debtor)) as $v) { 
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
