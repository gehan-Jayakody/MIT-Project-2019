<?php 
// core configuration
include_once "../../config/core.php";

// set page title
$page_title = "Instrument Holding Report";
 
// include login checker
//include_once "../../login/login_checker.php";

// include classes
include_once '../../config/dbconfig.php';
include_once '../../objects/instrument.php';

$instrument = new Instrument();
$instrument = $instrument->instrumentHolding();

include_once '../../libs/table_print.php';
function modify($str) {
	return ucwords(str_replace("_", " ", $str));
}

$_POST=array();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<div class="page-header">
  <h3 class="page-title">
    Instrument Holding Report
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
	  <?php
			echo "<table class='table table-hover'>";
			echo "<tr>";
			foreach ( array_keys ( get_object_vars ( reset ( $instrument ) ) ) as $headings ) {
					$heading = modify($headings);
					echo "<th class='text-center table-dark'>".$heading."</th>";
			}
			echo "</tr>";
			foreach(new TableRows(new RecursiveArrayIterator($instrument)) as $v) {
				echo $v;
			}
			echo "</table>";
			echo "<div class='col'><hr></div>";	
	  ?>
	</div>
  </div>
</div>

</body>

</html>