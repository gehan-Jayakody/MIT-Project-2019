function type_client() {

var clientType = document.getElementById("client_type").value;
switch(clientType){
	case "Company":
		document.getElementById("client_type_opt1").style.display = "none";
		document.getElementById("client_type_opt2").style.display = "block";
		break;
	
	case "Individual":
		document.getElementById("client_type_opt1").style.display = "block";
		document.getElementById("client_type_opt2").style.display = "none";
		break;
	
	default:
		document.getElementById("client_type_opt1").style.display = "none";
		document.getElementById("client_type_opt2").style.display = "none";
}
}

function type_instrument() {

var instrumentType = document.getElementById("instrument_select").value;
switch(instrumentType){
	case "Equity":
		document.getElementById("instrument_type_opt1").style.display = "none";
		document.getElementById("instrument_type_opt11").style.display = "none";
		document.getElementById("instrument_type_opt2").style.display = "block";
		document.getElementById("instrument_type_opt22").style.display = "block";
		break;
	
	case "Debenture":
		document.getElementById("instrument_type_opt1").style.display = "block";
		document.getElementById("instrument_type_opt11").style.display = "block";
		document.getElementById("instrument_type_opt22").style.display = "none";
		document.getElementById("instrument_type_opt2").style.display = "none";
		break;
	
	default:
		document.getElementById("instrument_type_opt1").style.display = "none";
		document.getElementById("instrument_type_opt11").style.display = "none";
		document.getElementById("instrument_type_opt2").style.display = "none";
		document.getElementById("instrument_type_opt22").style.display = "none";
}
}

function userRole() {

var instrumentType = document.getElementById("user_role").value;
switch(instrumentType){
	case "120":
		document.getElementById("userRole_opt1").style.display = "none";
		document.getElementById("userRole_opt2").style.display = "block";
		break;
	
	case "130":
		document.getElementById("userRole_opt1").style.display = "block";
		document.getElementById("userRole_opt2").style.display = "none";
		break;
	
		case "100":
		document.getElementById("userRole_opt1").style.display = "block";
		document.getElementById("userRole_opt2").style.display = "none";
		break;
	
	default:
		document.getElementById("userRole_opt1").style.display = "none";
		document.getElementById("userRole_opt2").style.display = "none";
}
}