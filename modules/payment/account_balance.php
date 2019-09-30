<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Account Balance";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/payment.php';

//Alert Massages
$alerttype = '';
$alert = '';
$account_bal = 'false';

if($_POST){
	// initialize objects
	$payment_balance = new Payment();
	$payment_balance=$payment_balance->paymentSummary();
	
	if($payment_balance==false){
		$alerttype = 'alert-danger';
		$alert = 'No Account Balance details Found.';
		$account_bal = 'false';
	}
	else{
		include_once '../../libs/table_print.php';
		$account_bal = 'true';
		function modify($str) {
			return ucwords(str_replace("_", " ", $str));
		}
		$trade_balance = $payment_balance['trade_summary'];
		$payment_balance = $payment_balance['payment_summary'];
	}
$pending_trades = 95000.73;
$pending_payments = 75000.00;
$accont_bal = ($payment_balance - $trade_balance - $pending_trades + $pending_payments);
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
	Account Balance
  </h3>
  <nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">Payment Management</span>
	</ol>
  </nav>
</div>		 
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">	  
	  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Client Details</p>
	  <form class="form-inline needs-validation" action="modules/payment/account_balance.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		<label class="col-3 stretch-card" style="margin-bottom:0.5rem;"><p class="text-danger"><sup>*</sup></p>Client CDS Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
		<div class="input-group mb-2 mr-sm-2">
		  <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}" required>
		</div>
		<div class="col-1 stretch-card"></div>
		<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">View Details</button>
	  </form>
	  
	  <?php 
	  if($account_bal == 'true'){
		    echo "<div class='col'><hr style='margin-top:0.1rem;margin-bottom:0.1rem;'></div>";
			
			echo "<table class='table table-hover'>";
				echo "<tbody>";
					echo "<tr>";
						echo "<td>Trade Summary<td>";
						echo "<td>Rs.<td>";
						echo "<td class='text-right'>".number_format($trade_balance, 2)."<td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Payment Summary<td>";
						echo "<td>Rs.<td>";
						echo "<td class='text-right'>".number_format($payment_balance, 2)."<td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Pending Trades<td>";
						echo "<td>Rs.<td>";
						echo "<td class='text-right'>".number_format($pending_trades, 2)."<td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Pending Payment<td>";
						echo "<td>Rs.<td>";
						echo "<td class='text-right'>".number_format($pending_payments, 2)."<td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td><b>Account Balance</b><td>";
						echo "<td>Rs.<td>";
						echo "<td class='text-right'><b>".number_format($accont_bal, 2)."</b><td>";
					echo "</tr>";
				echo "</tbody>";
			echo "</table>";
	  }				  
	  ?>
	</div>
  </div>
</div>

</body>

</html>
