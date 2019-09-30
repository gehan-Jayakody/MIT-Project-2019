<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Portfolio Transfer";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/portfolio.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_portfolio = 'false';

if(!empty($_POST['cds_account']) && empty($_POST['new_cds_account'])){
	// initialize objects
	$portfolio = new Portfolio();
	$portfolio=$portfolio->portfolioValuation();
	
	if($portfolio==false){
		$alerttype = 'alert-danger';
		$alert = 'No Portfolio details Found.';
		$out_portfolio = 'false';
	}
	else{
		//$_SESSION['cds_account'] = $_POST['cds_account'];
		include_once '../../libs/table_print.php';
		$out_portfolio = 'true';
		function modify($str) {
			return ucwords(str_replace("_", " ", $str));
		}
	}
}
elseif(!empty($_POST['new_cds_account'])){
	// initialize objects
	$porttran = new Portfolio();
	$porttran=$porttran->portfolioTran();
	
	if($porttran==false){
		$alerttype = 'alert-danger';
		$alert = 'Portfolio Transfer Failed.';
	}
	else{
		$alerttype = 'alert-success';
		$alert = 'Client Portfolio Transfer Successful.';
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
    View Portfolio Transfer
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">Portfolio Management</span>
    </ol>
  </nav>
</div>
<!-- Pill 1 -->
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">				  
	  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Client Details</p>
	  <form class="form-inline needs-validation" action="modules/portfolio/portfolio_transfer.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		<label class="col-3 stretch-card" style="margin-bottom:0.5rem;">CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		<div class="input-group mb-2 mr-sm-2">
		  <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}" required>
		</div>
		<div class="col-1 stretch-card"></div>
		<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit">View Details</button>
	  </form>
	  
	  <?php if($out_portfolio == 'false'){echo "<!--";} ?>
	  <form class="needs-validation" action="modules/portfolio/portfolio_transfer.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="col"><hr style="margin-top:0.1rem;margin-bottom:0.1rem;"></div>
		  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Transfer Details</p>
		  <div class="form-group row" style="margin-top:0.1rem;margin-bottom:0.1rem;">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>New CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			 <input type="text" class="form-control" name="new_cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}" required>
			 </div>
		  </div>					  
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit">Update Details</button>
			</div>
		</div>
		<div class="col"><hr></div>
	  </form>
	  <?php if($out_portfolio == 'false'){echo "-->";} ?>
	  <?php 
	  if($out_portfolio == 'true'){
			echo "<table class='table table-striped'>";
			echo "<tr>";
			//foreach ( array_keys ( get_object_vars ( reset ( $portfolio ) ) ) as $headings ) {
					//$heading = modify($headings);
					//echo "<th class='text-center'>".$heading."</th>";
					echo "<th class='text-center'>Instrument Name</th>";
					echo "<th class='text-center'>Quantity</th>";
					echo "<th class='text-center'>Average Price</th>";
					echo "<th class='text-center'>Total Value</th>";
			//}
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

</body>

</html>
