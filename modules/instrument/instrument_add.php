<?php 
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Instrument Add";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/instrument.php';
include_once '../../objects/company.php';

$company = new Company();
$company = $company->companyCode();

//Alert Massages
$alerttype = '';
$alert = '';

if(!empty($_POST)){
	include_once '../../objects/instrument.php';
	// initialize objects
	$instrument = new Instrument();
	$instrument=$instrument->instrumentAdd();
	
	if($instrument==false){
		$alerttype = 'alert-danger';
		$alert = 'No instrument details Found.';
	}
	else{
		$alerttype = 'alert-success';
		$alert = 'Instrument Added Successful.';
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
    Add New Instrument
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
	  <form class="needs-validation" action="modules/instrument/instrument_add.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Asset Class<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" id="instrument_select" onchange="type_instrument()">
				  <option value="">Select Option</option>
				  <option value="Equity">Equity</option>
				  <option value="Debenture">Debenture</option>							  							  
			   </select>		   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Company Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="company_code">
			    <?php
					foreach($company as $v) { 
						echo "<option value=".$v->company_code.">".$v->company_code."<p> - [".$v->company_name."]</p></option>";
					}
				?>							  							  
			   </select>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Instrument Name<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-6 stretch-card">
			   <input type="text" class="form-control" name="instrument_name">						   
			 </div>
		  </div>
		  <div id="instrument_type_opt2" style="display:none">
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Instrument Type<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="instrument_type">
				  <option value="">Select Option</option>
				  <option value="N">Normal</option>
				  <option value="R">Right</option>
				  <option value="W">Warrants</option>							  							  
				</select>
			 </div>
		  </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Instrument Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-7 stretch-card">
			   <input type="text" class="form-control" name="instrument_id" placeholder="Instrument Code Required" aria-describedby="instrument_help" required>
			   <small class="col-7 text-muted align-self-center" id="instrument_help">Eg. ABC.N0000 or ABCD.R1234</small>
			   <div class="invalid-tooltip">Please enter Instrument Code</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Sector<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-5 stretch-card">
			   <select class="form-control" name="sector" required>
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
				<div class="invalid-tooltip">Please Select a Sector</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">ISIN<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="text" class="form-control"  name="ISIN_number">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Company Share Volume<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="number" class="form-control" name="company_share_volume">						   
			 </div>
		  </div>
		  <div id="instrument_type_opt22" style="display:none">
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Market Share Volume<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="number" class="form-control" name="market_share_volume">						   
			 </div>
		  </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Weightage<p>&nbsp;</p>%<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="number" class="form-control" name="weightage" min="0" max="100" step="0.01">						   
			 </div>
		  </div>
		  <div id="instrument_type_opt1" style="display:none">
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Coupon Rate<p>&nbsp;</p>%<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="number" class="form-control" name="coupon_rate" min="0" max="100" step="0.01">						   
			 </div>
		  </div>
		  </div>
		  <div id="instrument_type_opt11" style="display:none">
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Maturity Date<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">						   
			   <input type="date" class="form-control" name="maturity_date">
			 </div>
		  </div>
		  </div>
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit" onclick="checkInput()">Submit</button>
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
