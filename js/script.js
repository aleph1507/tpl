$("#contactform").submit(function(event){
    event.preventDefault();
    //alert("Posle preventDefault");
    var token = $("#g-recaptcha-response").val();
    //console.log(token);
    if(token == ""){
    	$("#submitted").html("Не докажавте дека не сте робот.");
    	$("#submitted").removeClass("hidden");
    }
    else{
        	submit_form();
    		$("#submitted").html("Пораката е испратена!");
    }
});

function submit_form(){
	//alert("vo submit_form");
	var name = $('#name').val();
	var email = $('#email').val();
	var subject = $('#subject').val();
	var msg = $('#msg').val();
	var address = $('#address').val();

	// var captcha = grecaptcha.getResponse();
	// alert(captcha);

	$.ajax({
		type: "POST",
		url: "ajax_mail_handler.php",
		data: "name=" + name + "&email=" + email + "&subject=" + subject + "&address=" + address +"&msg=" + msg,
		success : function(data){
			// alert("Пораката е испратена");
			//console.log(data);
			//$("#submitted").html("success");
			$("#submitted").removeClass("hidden");
		 },
		//captcha: grecaptcha.getResponse(),
		error : function(data){
		 	$("#submitted").html("Имаше проблем при испраќањето на маилот. Ве молиме пробајте повторно.");
		 	$("#submitted").removeClass("hidden");
		 }
	});
}

function mailed(){
	$('#submitted').removeClass("hidden");
}