// Main Page Load
function mainbody() {
  $("#mainbody").load("modules/dashboard/main.php");
}

//Portfolio Management
function porfolio_Valuation() {
  $("#mainbody").load("modules/portfolio/portfolio_valuation.php");
}
function porfolio_Details() {
  $("#mainbody").load("modules/portfolio/portfolio_details.php");
}
function porfolio_Transfer() {
  $("#mainbody").load("modules/portfolio/portfolio_transfer.php");
}
function company_hitory() {
  $("#mainbody").load("modules/portfolio/company_history.php");
}
//Instrument Management
function instrument_Status() {
  $("#mainbody").load("modules/instrument/instrument_update.php");
}
function instrument_Add() {
  $("#mainbody").load("modules/instrument/instrument_add.php");
}
function company_Add() {
  $("#mainbody").load("modules/instrument/company_add.php");
}
function company_Details() {
  $("#mainbody").load("modules/instrument/company_details.php");
}
function company_Report() {
  $("#mainbody").load("modules/instrument/company_report.php");
}
function instrument_holding() {
  $("#mainbody").load("modules/instrument/instrument_holding.php");
}

//Customer Management
function client_Details() {
  $("#mainbody").load("modules/client/clients_details.php");
}
function client_Add() {
  $("#mainbody").load("modules/client/clients_add.php");
}
function clients_Amend() {
  $("#mainbody").load("modules/client/clients_amend.php");
}
function clients_Trans() {
  $("#mainbody").load("modules/client/clients_trans.php");
}

//Payment Management
function account_Balance() {
  $("#mainbody").load("modules/payment/account_balance.php");
}
function payment_History() {
  $("#mainbody").load("modules/payment/payment_history.php");
}
function new_Payment() {
  $("#mainbody").load("modules/payment/payment_add.php");
}

//Compliance and Risk
function buying_power() {
  $("#mainbody").load("modules/compliance/buying_power.php");
}
function security_exposure() {
  $("#mainbody").load("modules/compliance/security_exposure.php");
}
function compliance_reports() {
  $("#mainbody").load("modules/compliance/debtors_report.php");
}

//System Administration
function user_Add() {
  $("#mainbody").load("modules/user/user_add.php");
}
function user_Password() {
  $("#mainbody").load("modules/user/user_passwd_reset.php");
}
function data_Upload() {
  var win = window.open('modules/trades/trade_upload.php', '_self');
  win.focus();
}
function Email_config() {
  $("#mainbody").load("modules/portfolio/portfolio_valuation.php");
}
function database_Admin() {
  var win = window.open('dbconfig/index.php', '_blank');
  win.focus();
}
//Navigation Bar Profile dropdown
function user_Edit() {
  $("#mainbody").load("modules/user/user_edit.php");
}
function user_Password_1() {
  $("#mainbody").load("modules/user/user_passwd_reset_1.php");
}
function user_Logout() {
  var win = window.open('modules/login/logout.php', '_self');
  win.focus();
}