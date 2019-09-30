<?php
// core configuration
include_once("../../config/core.php");
 
// set page title
//$page_title = "Main";
 

// include classes
include_once("../../config/dbconfig.php");
//include_once '../../objects/advisor.php';

?>

  <div class="page-header">
	<h3 class="page-title">
	  <span class="page-title-icon bg-gradient-primary text-white mr-2">
		<i class="mdi mdi-home"></i>                 
	  </span>
	  Dashboard
	</h3>
	<nav aria-label="breadcrumb">
	  <ul class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">
		  <span></span>Overview
		  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
		</li>
	  </ul>
	</nav>
  </div>
  <div class="row">
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-danger card-img-holder text-white">
		<div class="card-body">
		  <img src="<?php echo $home_url ?>/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
		  <h4 class="font-weight-normal mb-3">Weekly Turnover
			<i class="mdi mdi-chart-line mdi-24px float-right"></i>
		  </h4>
		  <h2 class="mb-5">Rs.1,486,054.70</h2>
		  <h6 class="card-text">Increased by -3%</h6>
		</div>
	  </div>
	</div>
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-info card-img-holder text-white">
		<div class="card-body">
		  <img src="<?php echo $home_url ?>/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
		  <h4 class="font-weight-normal mb-3">Gain/Loss Stats
			<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
		  </h4>
		  <h2 class="mb-5">Rs.9,510.75</h2>
		  <h6 class="card-text">Decreased by 16%</h6>
		</div>
	  </div>
	</div>
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-success card-img-holder text-white">
		<div class="card-body">
		  <img src="<?php echo $home_url ?>/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
		  <h4 class="font-weight-normal mb-3">Weekly Orders
			<i class="mdi mdi-diamond mdi-24px float-right"></i>
		  </h4>
		  <h2 class="mb-5">37</h2>
		  <h6 class="card-text">Increased by 5%</h6>
		</div>
	  </div>
	</div>
  </div>  
  <div class="row">
	<div class="col-md-7 grid-margin stretch-card">
	  <div class="card">
		<div class="card-body">
		  <div class="clearfix">
			<h4 class="card-title float-left">Weekly Investment Statistics</h4>
			<div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
		  </div>
		  <canvas id="visit-sale-chart" class="mt-4"></canvas>
		</div>
	  </div>
	</div>
	<div class="col-md-5 grid-margin stretch-card">
	  <div class="card">
		<div class="card-body">
		  <h4 class="card-title">Portfolio Holding</h4>
		  <canvas id="traffic-chart"></canvas>
		  <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>                                                      
		</div>
	  </div>
	</div>
  </div>
  <div class="row">
	<div class="col-12 grid-margin">
	  <div class="card">
		<div class="card-body">
		  <h4 class="card-title">Client Events</h4>
		  <div class="table-responsive">
			<table class="table">
			  <thead>
				<tr>
				  <th>
					Client Name
				  </th>
				  <th>
					Email Address
				  </th>
				  <th>
					Mobile Number
				  </th>
				  <th>
					Date of Birth
				  </th>
				  <th>
					Next Meeting
				  </th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>
					<img src="<?php echo $home_url ?>/images/faces/face1.jpg" class="mr-2" alt="image">
					A.B.K.Weeraman
				  </td>
				  <td>
					anjan.weeraman@gmail.com
				  </td>
				  <td>
					071 4 568 152
				  </td>
				  <td>
					Dec 5, 1978
				  </td>
				  <td>
					Jun 25, 2019
				  </td>
				</tr>
				<tr>
				  <td>
					<img src="<?php echo $home_url ?>/images/faces/face2.jpg" class="mr-2" alt="image">
					A.M.P.Jayawardhana
				  </td>
				  <td>
					a.jayawardhana@cpsl.lk
				  </td>
				  <td>
					077 8 789 147
				  </td>
				  <td>
					Mar 12, 1967
				  </td>
				  <td>
					May 31, 2019
				  </td>
				</tr>                                                
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
  </div>