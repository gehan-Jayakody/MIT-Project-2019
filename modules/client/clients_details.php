<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Client Details";
 
// include login checker
//include_once "../../login/login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/client.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_client = 'false';

if($_POST){
	// initialize objects
	$client = new Client();
	$client=$client->clientDetails();
	
	if($client==false){
		$alerttype = 'alert-danger';
		$alert = 'Unable to Find the Client details. Please try again.';
		$out_client = 'false';
	}
	else{
		//var_dump($client);
		$out_client = 'true';
	}
	$_POST=array();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo $home_url ?>/css/search.css">
</head>

<body>
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
<div class="page-header">  
  <h3 class="page-title">
    Client Details
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
	  <form class="needs-validation" action="modules/client/clients_details.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger">*</p>Client CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card autocomplete">
			   <input type="text" class="form-control" id="searchInput" name="cds_account" placeholder="NBS-123456789-VN/00" required>
			   <div class="invalid-tooltip">Please enter Client CDS Number</div>						  
			 </div>
			 <div class="col-1 stretch-card" align="center"></div>
			 <div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit" onclick="checkInput()">View Details</button>
			 </div>
		  </div>
	  </form>
	  <?php if($out_client == 'false'){echo "<!--";} ?>
	  <p class="card-description">
		  Application Information
		</p>
		<div class="form-group row">
		  <label class="col-3 stretch-card align-items-center">Application Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		  <div class="col-3 stretch-card">
			<input class="form-control" value="<?php echo $client[0]->application_number;?>" readonly>
		  </div>
			 <label class="col-3 stretch-card align-items-center">Registered Through<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
				<input class="form-control" value="<?php echo $client[0]->registered_through;?>" readonly>						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Date of Application<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->date_of_application;?>" readonly>
			 </div>
		  </div>
		  <p class="card-description">
		  Account Information
		  </p>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Client CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->cds_account;?>" readonly>						  
			 </div>
			 <label class="col-3 stretch-card align-items-center">Custodial Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->custodial;?>" readonly>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Margin Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->margin_account;?>" readonly>
			 </div>
		  </div>
		  <p class="card-description">
		  Client Information
		  </p>
		  <div class="form-group row">
		  	 <label class="col-3 stretch-card align-items-center">Client Type<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
				<input class="form-control" value="<?php echo $client[0]->client_type;?>" readonly>
			 </div>
		  </div>
		  <?php if($client[0]->client_type == "Company"){echo "<!--";} ?>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Title<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->title;?>" readonly>
			 </div>
			 <label class="col-3 stretch-card align-items-center">Initials<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->initials;?>" readonly>					   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Surname<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->surname;?>" readonly>					   
			 </div> 
			 <label class="col-3 stretch-card align-items-center">Citizenship<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->citizenship;?>" readonly>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Date of Birth<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">						   
			   <input class="form-control" value="<?php echo $client[0]->date_of_birth;?>" readonly>
			 </div>
			 <label class="col-3 stretch-card align-items-center">National Identity Card No<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->NIC_number;?>" readonly>						   
			 </div>
		  </div>
		  <?php if($client[0]->client_type == "Company"){echo "-->";} ?>
		  <?php if($client[0]->client_type == "Individual"){echo "<!--";} ?>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Business Registration No<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->business_registration;?>" readonly>						   
			 </div>
			 <label class="col-3 stretch-card align-items-center">Company Name<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->company_name;?>" readonly>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Date of Incorporation<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->date_of_incorporation;?>" readonly>						   
			 </div>
		  </div>
		  <?php if($client[0]->client_type == "Individual"){echo "-->";} ?>
		  <p class="card-description">
		  Contact Information
		  </p>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Address<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->address;?>" readonly>						   
			 </div>
			 <label class="col-3 stretch-card align-items-center">Contact Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->contact_number;?>" readonly>						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Email<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->email;?>" readonly>						   
			 </div>
		  </div>					  
		  <p class="card-description">
		  Mapping Information
		  </p>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Advisor Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input class="form-control" value="<?php echo $client[0]->advisor_code;?>" readonly>
			 </div>
		  </div>
	  <?php if($out_client == 'false'){echo "-->";} ?>
	</div>
  </div>
</div>

</body>

</html>