<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Client ADD";
 
// include login checker
//include_once "../../login/login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/client.php';
include_once '../../objects/user.php';

$adv_code = new User();
$adv_code=$adv_code->advisorCode();

//Alert Massages
$alerttype = '';
$alert = '';

include_once '../../libs/form_num_gen.php';
$form_num = new Form_num();
$form_num=$form_num->formNum();

if($_POST){
    // initialize objects
	$client = new Client();
	// ADD Client
	if($client->clientAdd()){
		$alerttype = 'alert-info';
		$alert = 'Client Details Successfully Added.';

		// empty posted values
		$_POST=array();
	}
	else{
		$alerttype = 'alert-danger';
		$alert = 'Unable to Add the Client details. Please try again.';
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
    Add New Client
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
	  <form class="needs-validation" action="modules/client/clients_add.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		<p class="card-description">
		  Application Information
		</p>
		<div class="form-group row">
		  <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Application Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		  <div class="col-3 stretch-card">
			<input type="number" class="form-control" name="application_number" value="<?php echo $form_num;?>" readonly required>
			   <div class="invalid-tooltip">Please enter Application Number</div>
			 </div>
			 <label class="col-3 stretch-card align-items-center">Registered Through<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
				<select class="form-control" name="registered_through">
				  <option value="">Select Option</option>
				  <option value="Investment Advisor">Investment Advisor</option>
				  <option value="On-line Form">On-line Form</option>
				  <option value="Front Office">Front Office</option>
				  <option value="Branch">Branch</option>
				  <option value="Bank">Bank</option>
				  <option value="Margin Provider">Margin Provider</option>
				  <option value="3rd Party Contact">3rd Party Contact</option>							  
				</select>						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Date of Application<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="date" class="form-control" name="date_of_application" value="<?php echo date('Y-m-d');?>" required>
			   <div class="invalid-tooltip">Please enter date of application</div>
			 </div>
		  </div>
		  <p class="card-description">
		  Account Information
		  </p>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Client CDS Account Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}" required>
			   <div class="invalid-tooltip">Please enter Client CDS Number</div>						  
			 </div>
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Custodial Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="custodial" required>
				  <option value="">Select Option</option>
				  <option value="Yes">Yes</option>
				  <option value="No">No</option>							  
				</select>						   
			   <div class="invalid-tooltip">Please State this is Custodial Account or not</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Margin Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="margin_account" required>
				  <option value="">Select Option</option>
				  <option value="Yes">Yes</option>
				  <option value="No">No</option>
				 <div class="invalid-tooltip">Please State this is Margin Account or not</div>
				</select>
			 </div>
		  </div>
		  <p class="card-description">
		  Client Information
		  </p>
		  <div class="form-group row">
		  	 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Client Type<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
				<select class="form-control" id="client_type" name="client_type" onchange="type_client()" required>
				  <option value="">Select Option</option>
				  <option value="Company">Company</option>
				  <option value="Individual">Individual</option>							  
				</select>						   
			   <div class="invalid-tooltip">Please Select Client Type</div>
			 </div>
		  </div>
		  <div id="client_type_opt1" style="display:none">
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Title<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="title">
				  <option value="">Select Option</option>
				  <option value="Mr.">Mr.</option>
				  <option value="Mrs.">Mrs.</option>
				  <option value="Miss.">Miss.</option>
				  <option value="Prof.">Prof.</option>
				  <option value="Rev.">Rev.</option>
				  <option value="Dr.">Dr.</option>
				  <option value="Ms.">Ms.</option>							  
				</select>
			 </div>
			 <label class="col-3 stretch-card align-items-center">Initials<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="initials">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Surname<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="surname">
			   <div class="invalid-tooltip">Please enter Surname</div>						   
			 </div> 
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Citizenship<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="citizenship">
				  <option value="">Select Option</option>
				  <option value="Local">Local</option>
				  <option value="Foreign">Foreign</option>							  
				</select>						   
			   <div class="invalid-tooltip">Please Select Client Citizenship</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Date of Birth<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">						   
			   <input type="date" class="form-control" name="date_of_birth">
			 </div>
			 <label class="col-3 stretch-card align-items-center">National Identity Card No<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="NIC_number" placeholder="123456789v">						   
			 </div>
		  </div>
		  </div>
		  <div id="client_type_opt2" style="display:none">
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Business Registration No<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="business_registration">						   
			 </div>
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Company Name<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="company_name">
			   <div class="invalid-tooltip">Please enter Company Name</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Date of Incorporation<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="date" class="form-control" name="date_of_incorporation">						   
			 </div>
		  </div>
		  </div>
		  <p class="card-description">
		  Contact Information
		  </p>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Address<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="address">						   
			 </div>
			 <label class="col-3 stretch-card align-items-center">Contact Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="tel" class="form-control" name="contact_number" placeholder="(94)011-2345678" pattern=".{10,}">						   
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center">Email<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="email" class="form-control" name="email">						   
			 </div>
		  </div>					  
		  <p class="card-description">
		  Mapping Information
		  </p>
		  <div class="form-group row">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger">*</p>Advisor Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <select class="form-control" name="company_code">
			    <?php
					foreach($adv_code as $v) { 
						echo "<option value=".$v->advisor_code.">".$v->advisor_code."<p> - [".$v->login_name."]</p></option>";
					}
				?>							  							  
			   </select>
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