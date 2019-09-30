function emailSubmit(){
	$.post( "libs/email_send.php",
		function(data){ 
			console.log(data);
			alert(data);
		}
	);
	return false;
}