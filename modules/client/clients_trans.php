<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Client Transfer";
 
// include login checker
//include_once "../../login/login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/client.php';

//Alert Massages
$alerttype = '';
$alert = '';

if(!empty($_POST)){
	// initialize objects
	$client = new Client();
	$client=$client->clientTrans();
	
	if($client==false){
		$alerttype = 'alert-danger';
		$alert = 'Unable to Tranfer the Client. Please try again.';
	}
	else{
		$alerttype = 'alert-info';
		$alert = 'Client Tranfer Updated Successfully.';
	}
	$_POST=array();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
<div class="page-header">
  <h3 class="page-title">
    Client Transfer
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">Client Management</span>
    </ol>
  </nav>
</div>
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">
	  <form class="needs-validation" action="modules/client/clients_trans.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger">*</p>Client CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}"required>
			   <div class="invalid-tooltip">Please enter Client CDS Number</div>						  
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Client Status<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-2 stretch-card">
			   <select class="form-control" name="status">
				  <option value="1">Active</option>
				  <option value="0">Inactive</option>							  
				</select>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">New Broker<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="text" class="form-control" name="new_broker" placeholder="NDB Securities">					  
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Client Transfer Justification<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-6 stretch-card">
			   <textarea class="form-control" rows="5" name="client_trans_justification"></textarea>
			 </div>
		  </div>
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit" onclick="checkInput()">Submit</button>
			</div>
		</div>
	  </form>
	</div>
  </div>
</div>

</body>

</html>