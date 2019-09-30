<?php 
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Company Details";
 
// include login checker
//include_once "../../login/login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/company.php';


//Alert Massages
$alerttype = '';
$alert = '';
$out_company = 'false';

if($_POST){
	// initialize objects
	$companyInfo = new Company();
	$companyInfo=$companyInfo->companyInfo();
	$companyContact = new Company();
	$companyContact=$companyContact->companyContact();
	$companyRegularity = new Company();
	$companyRegularity=$companyRegularity->companyRegularity();
	
	if($companyInfo==false){
		$alerttype = 'alert-danger';
		$alert = 'Unable to Find the Company details. Please try again.';
		$out_company = 'false';
	}
	else{
		//var_export($companyInfo[0]);
		include_once '../../libs/table_print.php';
		$out_company = 'true';
		function modify($str) {
			return ucwords(str_replace("_", " ", $str));
		}
	}
	$_POST=array();
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
    Listed Company Details/Edit
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">Company Management</span>
    </ol>
  </nav>
</div>
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">
	  <form class="needs-validation" action="modules/instrument/company_details.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger">*</p>Company Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card autocomplete">
			   <input type="text" class="form-control" name="company_code" onclick="checkInput()" placeholder="Company Code Required [JKH]" required>
			   <div class="invalid-tooltip">Please enter Company Code</div>
			 </div>
		  </div>				  
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit">View Details</button>
			</div>
			<!-- <div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="update" value="update">Update Details</button>
			</div> -->
		</div>
	  </form>
	  <?php 
	  if($out_company == 'true'){
			//Table Company info
			echo "<p class='card-description' style='font-size:12px;margin-bottom:0.1rem;'>Company info</p>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $companyInfo ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($companyInfo)) as $v) { 
				echo $v;
			}
			echo "</table>";
			echo "<div class='col'><hr></div>";
			//Table Contact info
			echo "<p class='card-description' style='font-size:12px;margin-bottom:0.1rem;'>Contact info</p>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $companyContact ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($companyContact)) as $v) { 
				echo $v;
			}
			echo "</table>";
			echo "<div class='col'><hr></div>";
			//Table Regularity info
			echo "<p class='card-description' style='font-size:12px;margin-bottom:0.1rem;'>Regularity info</p>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $companyRegularity ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($companyRegularity)) as $v) { 
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