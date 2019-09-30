<?php 
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Company ADD";


// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/company.php';


//Alert Massages
$alert = '';
$alerttype = '';

if($_POST){
    // initialize objects
    $company = new Company();
    // ADD Company
	if($company->companyAdd()){
		$alerttype = 'alert-info';
		$alert = 'Company Details Successfully Added.';
		// empty posted values
		$_POST=array();
	}
	else{
		$alerttype = 'alert-danger';
		$alert = 'Unable to Add the Company details. Please try again.';
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
<div class="page-header" id="test">
  <h3 class="page-title">
    Add New Listed Company
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
	  <form class="needs-validation" action="modules/instrument/company_add.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <p class="card-description">
		  Company info
		  </p>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger">*</p>Company Code<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="text" class="form-control" name="company_code" placeholder="Company Code Required" pattern="[A-Z]{3,}" required>
			   <div class="invalid-tooltip">Please enter Company Code</div>
			 </div>
		  </div>				  
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center"><p class="text-danger">*</p>Company Name<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-6 stretch-card">
			   <input type="text" class="form-control" name="company_name" placeholder="Company Name Required" required>
			   <div class="invalid-tooltip">Please enter Company Name</div>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Address<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-6 stretch-card">
			   <textarea type="text" class="form-control" name="address" placeholder="Company Address Required" rows="3" required></textarea>
			   <div class="invalid-tooltip">Please Fill Company Address</div>
			 </div>
		  </div>
		  <p class="card-description">
		  Contact info
		  </p>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Telephone<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="tel" class="form-control" name="telephone_number" placeholder="(94)011-2345678" pattern=".{10,}">
			 </div>
		  </div>  
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">FAX<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
			   <input type="tel" class="form-control" name="fax_number" placeholder="(94)011-2345678" pattern=".{10,}">
			 </div>
		  </div>  
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Email<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-6 stretch-card">
			   <input type="email" class="form-control" name="email">
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Contact Person<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-5 stretch-card">
			   <input type="text" class="form-control" name="contact_person">
			 </div>
		  </div>
		  <p class="card-description">
		  Regularity info
		  </p>  
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Secretaries<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-5 stretch-card">
			   <input type="text" class="form-control" name="company_secretary">
			 </div>
		  </div>				    
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Directors<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <textarea type="text" class="form-control" name="company_directors" rows="3"></textarea>
			 </div>
		  </div>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">Quoted Date<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-3 stretch-card">
				<input class="form-control" type="date" name="quoted_date">
				<span class="add-on"><i class="mdi mdi-calendar col-1" style="font-size: 30px"></i></span>
			 </div>
		  </div>				
		<div class="form-group row">
			<div class="col-3 stretch-card" align="center"></div>
			<div class="col-3 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit" onclick="checkInput()">ADD</button>
			</div>
			<div class="col-3 stretch-card" align="center">
				<button type="reset" class="btn btn-gradient-info btn-rounded btn-fw">Reset</button>
			</div>
		</div>
	  </form>
	</div>
  </div>
</div>

</body>

</html>