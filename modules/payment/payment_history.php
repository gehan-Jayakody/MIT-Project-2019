<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Payment History";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/payment.php';
include_once '../../objects/client.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_history = 'false';
$filter_option = '';

if($_POST){
	// initialize objects
	$paymentHistory = new Payment();
	if(empty($_POST["from_date"]) && empty($_POST["to_date"])){
		$filter_option = '0';
	}
	elseif(!empty($_POST["from_date"]) && !empty($_POST["to_date"])){
		$filter_option = '3';
	}
	elseif(!empty($_POST["from_date"]) || !empty($_POST["to_date"])){
		if(!empty($_POST["from_date"])){
			$filter_option = '1';
		}
		else{
			$filter_option = '2';
		}
	}
	if(!empty($_POST["cds_account"])){ $out_history = 'true';}
	else{ $out_history = 'false';}
	$paymentHistory=$paymentHistory->paymentHistory($filter_option);
	$client = new Client();
	$client = $client->clientDetails();
	include_once '../../libs/table_print.php';
	function modify($str) {
		return ucwords(str_replace("_", " ", $str));
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
<div class="page-header">
  <h3 class="page-title">
    Payment History Report
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
	  <form class="needs-validation" action="modules/payment/payment_history.php" method="POST" onsubmit="return submitForm(this)" novalidate>
		  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Client Details</p>
		  <div class="form-group row" style="margin-bottom:0.1rem;">
			 <label class="col-3 stretch-card align-items-center"><p class="text-danger"><sup>*</sup></p>Client CDS Account<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-sm-3 input-group">
			   <input type="text" class="form-control" name="cds_account" placeholder="NBS-123456789-VN/00" pattern="[A-Z]{3}-[0-9]{4,}-[A-Z]{2}/[0-9]{2}" required>
			 </div>
			 <div class="invalid-tooltip">Please Enter a Client Account Number</div>
		  </div>
		  <div class="col"><hr style="margin-top:0.1rem;margin-bottom:0.1rem;"></div>
		  <p class="card-description" style="font-size:12px;margin-bottom:0.1rem;">Filter Details</p>
		  <div class="form-group row" style="margin-bottom:0.1rem;">
			 <label class="col-1.5 stretch-card align-items-center">Date Range<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <label class="col-1 stretch-card justify-content-end align-items-center">From</label>
			 <div class="col-2.5 stretch-card">
				<input type="date" class="form-control form-control-sm" name="from_date">
			 </div>
			 <label class="col-1 stretch-card justify-content-end align-items-center">To</label>
			 <div class="col-2.5 stretch-card">
				<input type="date" class="form-control form-control-sm" name="to_date">
			 </div>
			 <div class="col-1 stretch-card"></div>
			 <div class="col-2.5 stretch-card">
			   <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" style="margin-bottom:0.5rem;" name="submit" value="submit" onclick="checkInput()">View Details</button>
			 </div>
		  </div>
		<div class="col"><hr style="margin-top:0.1rem;margin-bottom:0.1rem;"></div>
	  </form>
	  <?php 
	  if($out_history == 'true'){
			echo "<table class='table table-striped'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $paymentHistory ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($paymentHistory)) as $v) { 
				echo $v;
			}
			echo "</table>";
			echo "</br>";
			echo "<div class='col'><hr style='margin-top:0.1rem;margin-bottom:0.1rem;'></div>";
			echo "</br>";
			echo "<div><button type='button' class='btn btn-success btn-fw' data-toggle='modal' data-target='#report'> Generate Report <i class='mdi mdi-file-export btn-icon-append'></i></button></div>";
	  
			//Email Subject
			$subject = "Payment History Report";
			//Email Body
			$message = "<html><body>";
			$message .= "<div class='text-center'><H2>NDB SECURITIES (PVT) LTD.<H2></div>";
			$message .= "<div class='text-center'><p>Level 2, NDB Capital Building, No.135, Bauddhaloka Mawatha, Colombo 04. Sri Lanka.<p></div>";
			$message .= "<div class='text-center'><p>Tel : 0112131000 | Fax : 0112314180 | Email : mail@ndbs.lk<p></div>";
			$message .= "<div class='text-center'><p><B><U>Payment History Report as at - ".date('d/m/Y')."</U></B><p></div>";
			$message .= "</br>";
			$message .= "<div class='row'>";
			$message .= "<div class='col-5 stretch-card'><p>Client Name :- ".$client[0]->title." ".$client[0]->initials." ".$client[0]->surname."</p></div>";
			$message .= "<div class='col-5 stretch-card'><p>CDS Account :- ".$client[0]->cds_account."</p></div>";
			$message .= "</div>";
			$message .= "</br>";
			$message .= "<table class='table table-striped'>";
			$message .= "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $paymentHistory ) ) ) as $headings ) {
					$heading = modify($headings);
					$message .= "<th class='text-center' style='width:150px;border:1px solid black;'>".$heading."</th>";
			}
			$message .= "</tr>";
			foreach ($paymentHistory as $index => $row){
				$message .= "<tr>";
				$index+1;
				foreach ($row as $value){
					$message .= "<td style='width:150px;border:1px solid black;'>".$value."</td>";
				}
				$message .= "</tr>";
			}
			$message .= "</table>";
			$message .= "</br>";
			$message .= "<div>";
			$message .= "<p >This is a computer generated report by ".$_SESSION['login_name']." on ".date('d/m/Y')." at ".date('h:i a')."</p>";
			$message .= "</div>";
			
			$message .= "</body></html>";
			//END Email Body
			$_SESSION['message'] = $message;
			$_SESSION['subject'] = $subject;
			$_SESSION['emalrcpt'] = $client[0]->email;
	  }				  
	  ?>
	<!-- Modal -->
		<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="report" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div id="print-me">
			  <div class="modal-header">
				<h5 class="modal-title" id="report">Payment History Report</h5>
			  </div>
			  <div class="modal-body">
				<div class="text-center"><H3>NDB SECURITIES (PVT) LTD.<H3></div>
				<div class="text-center"><p>Level 2, NDB Capital Building, No.135, Bauddhaloka Mawatha, Colombo 04. Sri Lanka.<p></div>
				<div class="text-center"><p>Tel : 0112131000 | Fax : 0112314180 | Email : mail@ndbs.lk<p></div>
				<div class="text-center"><p><B><U>Payment History Report as at - <?php echo date('d/m/Y'); ?></U></B><p></div>
				</br>
				<div class="row">
				  <div class="col-5 stretch-card"><p>Client Name<p>&nbsp;</p>:-<p>&nbsp;</p><?php echo $client[0]->title." ".$client[0]->initials." ".$client[0]->surname; ?></p></div>
				  <div class="col-2 stretch-card"></div>
				  <div class="col-5 stretch-card"><p>CDS Account<p>&nbsp;</p>:-<p>&nbsp;</p><?php echo $client[0]->cds_account; ?></p></div>
				</div>
				<table class='table table-dark'>
				<tr>
				<?php
				foreach ( array_keys ( get_object_vars ( reset ( $paymentHistory ) ) ) as $headings ) {
						$heading = modify($headings);
						echo "<th class='text-center'>".$heading."</th>";
				}
				?>
				</tr>
				<?php
				foreach(new TableRows(new RecursiveArrayIterator($paymentHistory)) as $v) { 
					echo $v;
				}
				?>
				</table>
				</br>
				<div style="visibility: hidden; display:inline;">
				  <p >This is a computer generated report by <?php echo $_SESSION['login_name']; ?> on <?php echo date('d/m/Y'); ?> at <?php echo date('h:i a'); ?></p>
				</div>
			  </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-gradient-info btn-icon-text" id="printButton" onclick="printDiv('print-me')"> Print <i class="mdi mdi-printer btn-icon-append"></i></button>
				<button type="submit" class="btn btn-gradient-info btn-icon-text" id="email_send" onclick="emailSubmit()"> E-mail <i class="mdi mdi-email btn-icon-append"></i></button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- Modal -->
	</div>
  </div>
</div>
 
</body>

</html>
