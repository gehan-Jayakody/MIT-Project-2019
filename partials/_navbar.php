<?php
// core configuration
include_once 'config/core.php';
include_once 'objects/message.php';
$message = new Message();
$message=$message->messageInfo();
$message_count=sizeof($message);
?>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img src="images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch" style="padding-left: 0px;">
		<div class="border border-secondary d-flex align-items-center">
		<marquee bgcolor=#ffffff onmouseover="this.stop();" onmouseout="this.start();">
		    <?php include("libs/ticker.php"); ?>
			<span class="stockbox" style="font-size:0.8em">Quotes from <a href="https://www.cse.lk/home/market" target="_blank">CSE</a></span>
			<span class="stockbox" style="font-size:0.8em">last update on <?php echo date("Y-m-d"); ?></span>
		</marquee>
		</div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="images/faces/face1.jpg" alt="image">
                <span class="availability-status online"></span>             
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?php echo $_SESSION['title'].$_SESSION['login_name']; ?></p>
				<span class="text-secondary text-small"><?php echo $_SESSION['surname']; ?></span>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#" onclick="user_Edit()">
                <i class="mdi mdi-account-edit mr-2 text-success"></i>
                Profile Edit
              </a>
			  <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" onclick="user_Password_1()">
                <i class="mdi mdi-cached mr-2 text-danger"></i>
                Change Password
              </a>
              <a class="dropdown-item" href="#" onclick="user_Logout()">>
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Sign-out
              </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-email-outline"></i>
              <span class="count-symbol bg-warning"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <h6 class="p-3 mb-0">Messages</h6>
              <?php
			  for ($i=0; $i<$message_count; $i++){
				echo "<div class='dropdown-divider'></div>";
				echo "<a class='dropdown-item preview-item' href='".$message[$i]->message_link."' target='_blank'>";
                echo "<div class='preview-item-content d-flex align-items-start flex-column justify-content-center'>";
                echo "<h6 class='preview-subject ellipsis mb-1 font-weight-normal'>".$message[$i]->message_name."</h6>";
                echo "<p class='text-gray mb-0' style='font-size:0.6rem;'>";
                echo $message[$i]->message_description;
                echo "</p>";
                echo "</div>";
				echo "</a> ";
			  }			  
			  ?>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">messages [<?php echo $message_count;?>]</h6>
            </div>
          </li>
         </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>