<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Payment ADD";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/payment.php';


//Alert Massages
$alerttype = '';
$alert = '';

if($_POST){
	// initialize objects
	$payment = new Payment();
	
	if($payment->paymentAdd()){
		$alerttype = 'alert-info';
		$alert = 'Payment Details Added Successfully.';
		
		// empty posted values
		$_POST=array();
	}
	else{
		$alerttype = 'alert-danger';
		$alert = 'Payment Detail Add Failed. Please Try Again.';
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
	  Add Payment
	</h3>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
		<span class="breadcrumb-item active">Payment Management</span>
	  </ol>
	</nav>
  </div>
  <div class="tab-pane fade show active" id="pills-equity" role="tabpanel" aria-labelledby="pills-equity-tab">
	<div class="col-12 grid-margin">
	  <div class="card text-black bg-secondary mb-3">
		<div class="card-body">
		  <form class="needs-validation" action="modules/payment/payment_add.php" method="POST" onsubmit="return submitForm(this)" novalidate>
			  <div class="form-group row">
				 <label class="col-4 stretch-card align-items-center">Receipt Number<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <div class="col-3 stretch-card">
				   <input type="text" class="form-control" name="receipt_id" value="rcpt-<?php echo date('Ymdhms');?>" readonly>
				 </div>
			  </div>
			  <div class="form-group row">
				 <label class="col-4 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Client CDS Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <div class="col-3 stretch-card">
				   <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}" required>
				   <div class="invalid-tooltip">Please Enter a Client Account Number</div>
				 </div>
			  </div>
			  <div class="form-group row">
				 <label class="col-4 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Receipt Date<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <div class="col-3 stretch-card">
				   <input type="date" class="form-control" name="receipt_date" required>
				   <div class="invalid-tooltip">Please Select Receipt Date</div>
				 </div>
			  </div>
			  <div class="form-group row">
				 <label class="col-3 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Payment Amount<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <label class="col-1 stretch-card align-items-center justify-content-end">LKR.</label>
				 <div class="col-3 stretch-card">
				   <input type="number" class="form-control" name="payment_amount" min="-10000000" max="10000000" step="0.01" required>
					<div class="invalid-tooltip">Please Enter Payment Amount</div>
				 </div>
			  </div>
			  <div class="form-group row">
				 <label class="col-4 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Payment Type<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <div class="col-3 stretch-card">
				   <select class="form-control" name="payment_type" required>
					  <option value="">Select Option</option>
					  <option value="cash">Cash</option>
					  <option value="cheque">Cheque</option>
					  <option value="bank_tranfer">Bank Tranfer</option>
					</select>
					<div class="invalid-tooltip">Please Select Payment Type</div>
				 </div>
			  </div>
			  <div class="form-group row">
				 <label class="col-4 stretch-card align-items-center">Transaction Refernce<p>&nbsp;</p>:-<p>&nbsp;</p></label>
				 <div class="col-3 stretch-card">
					<input type="text" class="form-control" name="transaction_refernce">
					<div class="invalid-tooltip">Please Select Instrument Code</div>
				 </div>
				 <label class="col-5 stretch-card align-items-center" style="font-size:0.75rem;">[Cash->recipt number]</br>[Cheque->cheque number]</br>[Bank Tranfer->bank refernce]</label>
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
  </div>

</body>

</html>
