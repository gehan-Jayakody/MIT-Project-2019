<?php
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Trade Upload";
 
// include login checker
//include_once "login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/trades.php';

//Alert Massages
$alerttype = '';
$alert = '';
$out_trades = 'false';

if($_POST){	
	// initialize objects
	$trades = new Trades();
	$trades=$trades->tradesUpload();
	if($trades[0]==false){
		$alerttype = 'alert-danger';
		$alert = 'CSE Trade File Formatting Error!!.';
		$out_trades = 'false';
	}
	elseif($trades=="filezero"){
		$alerttype = 'alert-danger';
		$alert = 'CSE Trade File Size Zero!!';
		$out_trades = 'false';
	}
	else{
		$alerttype = 'alert-info';
		$alert = 'Trade details Upload Success.'.$trades[1].' Rows Added';
		$trades_print = new Trades();
		$trades_print=$trades_print->tradesView();
		include_once '../../libs/table_print.php';
		$out_trades = 'true';
		function modify($str) {
			return ucwords(str_replace("_", " ", $str));
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profolio Manager</title>
  <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="shortcut icon" href="../../images/favicon.png"/>
</head>
<body>
  <div class="container-scroller">
	<?php include_once("../../partials/__navbar.php"); ?>
    <div class="container-fluid page-body-wrapper">
	<?php include_once("../../partials/__sidebar.php"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
		
<div style='text-align:center' class='alert <?php echo $alerttype ?>'><?php echo $alert ?></div>
<div class="page-header">
  <h3 class="page-title">
	CSE Trading Data Upload
  </h3>
  <nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	  <a class="breadcrumb-item" href="<?php echo $home_url ?>">Dashboard</a>
	  <span class="breadcrumb-item active">System Administration</span>
	</ol>
  </nav>
</div>		 
<div class="col-12 grid-margin">
  <div class="card text-black bg-secondary mb-3">
	<div class="card-body">
	  <form class="needs-validation" action="#" method="POST" enctype="multipart/form-data" onsubmit="return submitFile(this)" novalidate>
		  <div class="form-group row">
			 <label class="col-4 stretch-card align-items-center">CSE Trade File<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			 <div class="col-4 stretch-card">
			   <input type="file" class="form-control align-items-center" name="cse_trade_file" onclick="checkInput()" required>
			   <div class="invalid-tooltip">Please Select CSE Trade File</div>
			 </div>
		  </div>				  
		<div class="form-group row">
			<label class="col-4 stretch-card align-items-center">Upload Data<p>&nbsp;</p>:-<p>&nbsp;</p></label>
			<div class="col-4 stretch-card" align="center">
				<button type="submit" class="btn btn-gradient-info btn-rounded btn-fw" name="submit" value="submit">Upload</button>
			</div>
		</div>
	  </form>  
	  <?php 
	  if($out_trades == 'true'){
		    echo "<div class='col'><hr style='margin-top:0.1rem;margin-bottom:0.1rem;'></div>";
			echo "<table class='table table-striped'>";
			echo "<tr>";
			/*foreach ( array_keys ( get_object_vars ( reset ( $trades_print ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center'>".$heading."</th>";
			}*/
			echo "</tr>";
			/*foreach(new TableRows(new RecursiveArrayIterator($trades_print)) as $v) { 
				echo $v;
			}*/
			echo "</table>";
	  }				  
	  ?>
	</div>
  </div>
</div>
		<?php include_once("../../partials/_footer.php"); ?>
      </div>
    </div>
  </div>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/js/vendor.bundle.addons.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/misc.js"></script>

  <script src="../../js/navigation.js"></script>
  <script src="../../js/dashboard.js"></script>
  <script src="../../js/submitForm.js"></script>
  <script src="../../js/alerts.js"></script>
</body>

</html>