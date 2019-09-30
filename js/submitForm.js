var check;
function checkInput() {
	// Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
	  form.addEventListener('submit', function(event) {
		if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
		  check = false;
        }
		else{
			check = true;
		}
        form.classList.add('was-validated');
		
      }, false);
    });
}
// Form Submit With validation
function submitForm(oFormElement){
	if(check){
		var xhr = new XMLHttpRequest();
		xhr.onload = function(){ 
			document.getElementById("mainbody").innerHTML = this.responseText;
		}
		xhr.open (oFormElement.method, oFormElement.action, true);
		xhr.send (new FormData (oFormElement));
	}
	return false;
}
// Form Submit Without validation
function submitForm1(oFormElement){
	var xhr = new XMLHttpRequest();
	xhr.onload = function(){ 
		document.getElementById("mainbody").innerHTML = this.responseText;
	}
	xhr.open (oFormElement.method, oFormElement.action, true);
	xhr.send (new FormData (oFormElement));

	return false;
}

function submitFile(oFormElement){
	if(check){
		var xhr = new XMLHttpRequest();
		xhr.onload = function(){ 
			document.getElementById("mainbody").innerHTML = this.responseText;
		}
		xhr.open (oFormElement.method, 'modules/trades/trade_upload.php', true);
		xhr.setRequestHeader("Content-Type","multipart/form-data");
		var formData = new FormData(oFormElement);
		formData.append('file', file);
		xhr.send (formData);
	}
	return false;
}