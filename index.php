<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title="Index";
 
// include login checker
$require_login=true;
include_once "modules/login/login_checker.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profolio Manager</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="stylesheet" href="css/modal.css">
  <link rel="shortcut icon" href="images/favicon.png"/>
</head>
<body>
  <div class="container-scroller">
	<?php include("partials/_navbar.php"); ?>
    <div class="container-fluid page-body-wrapper">
	<?php include("partials/_sidebar.php"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
		<div id="mainbody"></div>
        </div>
        <!-- content-wrapper ends -->
		<?php include("partials/_footer.php"); ?>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->

  <!-- End custom js for this page-->
  <script src="js/navigation.js"></script>
  <script>mainbody()</script>
  <script src="js/dashboard.js"></script>
  <script src="js/submitForm.js"></script>
  <script src="js/alerts.js"></script>
  <script src="js/input.js"></script>
  <script src="js/print_modal.js"></script>
  <script src="js/email_submit.js"></script>
  <script src="js/no-ui-slider.js"></script>
</body>

</html>
