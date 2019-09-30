<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Instrument Update";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/instrument.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_instrument = 'false';

if(!empty($_POST['instrument_id'])){
	// initialize objects
	$instrument = new Instrument();
	$instrument=$instrument->instrumentViewCode();
	
	if($instrument==false){
		$alerttype = 'alert-danger';
		$alert = 'No instrument details Found.';
		$out_instrument = 'false';
	}
	else{
		include_once '../../libs/table_print.php';
		$out_instrument = 'true';
		function modify($str) {
			return ucwords(str_replace("_", " ", $str));
		}
		//$_SESSION['instrument_code'] = $_POST['instrument_code'];
	}
	$_POST=array();
}
elseif(!empty($_POST['instrument_update'])){
	$instrumentUpdate = new Instrument();
	$instrumentUpdate=$instrumentUpdate->instrumentUpdate();
	if($instrumentUpdate==false){
		$alerttype = 'alert-danger';
		$alert = 'No instrument Update Failed!!!';
		$out_instrument = 'false';
	}
	else{
		$out_instrument = 'false';
		$alerttype = 'alert-success';
		$alert = 'Instrument Update Successful.';
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
    Instrument Status/Edit
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">Instrument Management</span>
    </ol>
  </nav>
</div>
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">
	  <form class="form-inline needs-validation" action="modules/instrument/instrument_update.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		<label class="col-3 stretch-card" style="margin-bottom:0.5rem;"><p class="text-danger"><sup>*</sup></p>Instrument Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		<div class="input-group mb-2 mr-sm-2 autocomplete">
		  <input type="text" class="form-control" name="instrument_id" placeholder="Eg. SAMP.N0000" pattern="[A-Z]{3,}.[A-Z]{1}[0-9]{4}">
		</div>
		<div class="col-1 stretch-card"></div>
		<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">View Details</button>
	  </form>
	  <?php 
	  if($out_instrument == 'true'){
			echo "<div class='col-0.5'><hr></div>";
			echo "Current Details</br>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $instrument ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($instrument)) as $v) { 
				echo $v;
			}
			echo "</table>";
			echo "<div class='col-0.5'><hr></div>";
	  }				  
	  ?>
	  <?php if($out_instrument == 'false'){echo "<!--";} ?>
	  <form class="needs-validation" action="modules/instrument/instrument_update.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Company Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="company_code" placeholder="Eg. JKH">
			   <input type="text" class="form-control" name="instrument_update" value="true" hidden>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Sector<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-5 stretch-card">
			   <select class="form-control" name="sector">
				  <option value="">Select Option</option>
				  <option value="Consumer Discretionary">Consumer Discretionary</option>
				  <option value="Consumer Staples">Consumer Staples</option>
				  <option value="Energy">Energy</option>
				  <option value="Financial">Financial</option>
				  <option value="Health Care">Health Care</option>
				  <option value="Industrials">Industrials</option>
				  <option value="Information Technology">Information Technology</option>
				  <option value="Materials">Materials</option>
				  <option value="Real Estate">Real Estate</option>
				  <option value="Telecommunication Services">Telecommunication Services</option>
				  <option value="Utilities">Utilities</option>
				</select>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Company Share Volume<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="number" class="form-control" name="company_share_volume">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Market Share Volume<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="number" class="form-control" name="market_share_volume">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Instrument Status</label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="instrument_status2">
				  <option value="1">Active</option>
				  <option value="0">Inactive</option>							  							  							  
				</select>
			 </div>
		  </div>					  
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Weightage<p>&nbsp;</p>%<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="number" class="form-control" name="weightage" min="0" max="100" step="0.01">						   
			 </div>
		  </div>					  					
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit" onclick="checkInput()">Update</button>
			</div>
		</div>
	  </form>
	  <?php if($out_instrument == 'false'){echo "-->";} ?>
	</div>
  </div>
</div>

</body>

</html>
