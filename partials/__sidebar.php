<?php

?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
	  <li class="nav-item">
		<a class="nav-link" href="#">
		  <span class="menu-title"></span>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="../../index.php">
		  <span class="menu-title">Dashboard</span>
		  <i class="mdi mdi-home menu-icon"></i>
		</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#portfolio" aria-expanded="false" aria-controls="ui-basic">
		  <span class="menu-title">Portfolio</span>
		  <i class="menu-arrow"></i>
		  <i class="mdi mdi-finance menu-icon"></i>
		</a>
		<div class="collapse" id="portfolio">
		  <ul class="nav flex-column sub-menu">
		    <li class="nav-item"> <a class="nav-link" href="#" onclick="porfolio_Valuation()">Valuation</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="porfolio_Details()">Details</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="porfolio_Transfer()">Transfer</a></li>
		  </ul>
		</div>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#Instruments" aria-expanded="false" aria-controls="ui-basic">
		  <span class="menu-title">Security Instruments</span>
		  <i class="menu-arrow"></i>
		  <i class="mdi mdi-poll menu-icon"></i>
		</a>
		<div class="collapse" id="Instruments">
		  <ul class="nav flex-column sub-menu">
			<li class="nav-item"> <a class="nav-link" href="#" onclick="instrument_Status()">Instrument Status/Edit</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="instrument_Add()">Instrument Add</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="company_Add()">Listed Company Add</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="company_Details()">Company Details/Edit</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="company_Report()">Listed Company Report</a></li>
		  </ul>
		</div>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#client_management" aria-expanded="false" aria-controls="ui-basic">
		  <span class="menu-title">Client Management</span>
		  <i class="menu-arrow"></i>
		  <i class="mdi mdi-account-box menu-icon"></i>
		</a>
		<div class="collapse" id="client_management">
		  <ul class="nav flex-column sub-menu">
			<li class="nav-item"> <a class="nav-link" href="#" onclick="client_Details()">Details</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="client_Add()">Add</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="clients_Amend()">Amendment</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="clients_Trans()">Transfer</a></li>
		  </ul>
		</div>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="ui-basic">
		  <span class="menu-title">Payment Management</span>
		  <i class="menu-arrow"></i>
		  <i class="mdi mdi-account-box menu-icon"></i>
		</a>
		<div class="collapse" id="payment">
		  <ul class="nav flex-column sub-menu">
			<li class="nav-item"> <a class="nav-link" href="#" onclick="account_Balance()">Account Balance</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="payment_History()">Payment History</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="new_Payment()">New Payment Receipt</a></li>
		  </ul>
		</div>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#compliance_risk" aria-expanded="false" aria-controls="ui-basic">
		  <span class="menu-title">Compliance & Risk</span>
		  <i class="menu-arrow"></i>
		  <i class="mdi mdi-security menu-icon"></i>
		</a>
		<div class="collapse" id="compliance_risk">
		  <ul class="nav flex-column sub-menu">
			<li class="nav-item"> <a class="nav-link" href="#" onclick="buying_power()">Buying Power</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="security_exposure()">Security Exposure</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="compliance_reports()">Debtors Reports</a></li>
		  </ul>
		</div>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#system_administration" aria-expanded="false" aria-controls="ui-basic">
		  <span class="menu-title">System Administration</span>
		  <i class="menu-arrow"></i>
		  <i class="mdi mdi-settings menu-icon"></i>
		</a>
		<div class="collapse" id="system_administration">
		  <ul class="nav flex-column sub-menu">
			<li class="nav-item"> <a class="nav-link" href="#" onclick="user_Add()">System User Add</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="user_Password()">User Password Reset</a></li>
			<li class="nav-item"> <a class="nav-link" href="#" onclick="data_Upload()">CSE Data  Upload</a></li>
			<!-- <li class="nav-item"> <a class="nav-link" href="#" onclick="email_configuration()">Email Configuration</a></li> -->
			<li class="nav-item"> <a class="nav-link" href="#" onclick="database_Admin()">Database Administration</a></li>
		  </ul>
		</div>
	  </li>
	</ul>
</nav>