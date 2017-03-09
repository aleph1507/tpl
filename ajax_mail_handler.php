<html>
<head>
	<link href="css/new-age.css">
	<title>Mailing TPL</title>
</head>
<body>
<?php 
	//if(isset($_POST['submit'])){

		require 'PHPMailer_5.2.0/class.phpmailer.php';

		
		/* validation */

		$name = $subject = $email = $address = $msg = "";
		$error = "";

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			empty($_POST['name']) ? $GLOBALS['error'] .= 'Your name is required. <br>' : $GLOBALS['name'] = san_input($_POST['name']);
			empty($_POST['subject']) ? $GLOBALS['subject'] = null : $GLOBALS['subject'] = san_input($_POST["subject"]);
			empty($_POST['email']) ? $GLOBALS['error'] .= 'Your email is required. <br>' : 
				filter_var(san_input($_POST['email']), FILTER_VALIDATE_EMAIL) ? $GLOBALS['email'] = san_input($_POST['email']) : $GLOBALS['error'] .= 'Your email seems invalid. <br>';
			empty($_POST['address']) ? $GLOBALS['error'] .= 'Your address is required. <br>' : $GLOBALS['address'] = san_input($_POST['address']);

			//$GLOBALS['email'] = san_input($_POST['input']);
			empty($_POST['msg']) ? $GLOBALS['msg'] = null : $GLOBALS['msg'] = san_input($_POST["msg"]);
			//echo "<br>Globals[subject]: " . $GLOBALS['subject'] . '<br>';
			//echo "error: " . $GLOBALS['error'];
		}

		function san_input($data){
			return htmlspecialchars(trim($data));
		}

		if($error != "")
			died();

		//echo "error: $error <Br>";

		/* end validation */

		header('Refresh: 5;url=index.php');
		// $error = "success";
		// $error_message = '';

		function died(){
			$error_message_mk = 'Имаше грешки со праќањето на Вашиот емаил:<br>'
								. $GLOBALS['error'] . '<br><br>' . 'Ве молиме пробајте повторно.<br>'
								. 'Ќе бидете пренасочени за 10 секунди.';
			$error_message = "We encounter errors while sending your message:<br>" . 
					$GLOBALS['error'] . "<br><br>" . "Please try again. You will be redirected in 10 seconds.<br>";


			header('Refresh: 10;url=index.php');
			// echo '<div class="container mail-msg bg-primary"><div class="row"><div class="col-md-3 col-md-offset-2">';
			// echo $error_message_mk;
			// echo '</div></div>';
			// echo '<div class="row"><div class="col-md-3 col-md-offset-2">';
			echo $error_message;
			// echo '</div></div></div>';
			die();
		}

		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->IsHTML(true);
		$mail->Username = 'totalpostlogistics@gmail.com';
		$mail->Password = 'totalpostl';
		$mail->setFrom($email, $name);
		$mail->addAddress('totalpostlogistics@gmail.com');
		if(empty($subject))
			$subject = 'Nov e-mail od posetitel na TPL.';
		$mail->Subject = $subject;
		// echo '<br>subject: '.$subject . '<br>';
		if(empty($msg))
			$msg = 'Пораката нема содржина.';
		else {
			$message = '<p style="text-align:center;"><h2 style="margin-left:30%;">' . $subject . '</h2></p><br>' 
			. '<p>' . $msg . '</p><br><p style="text-align:right; color:grey;">' . $name 
			. ',<br>' . $email . '</p><p style="text-align:right;">Адреса:' . $address . '</p>';
		}
		$mail->Body = $message;
		if(!$success=$mail->send()){
			echo 'invalid';
			echo '<div class="container mail-msg bg-primary"><div class="row"><div class="col-md-3 col-md-offset-4">';
			echo 'Mail not sent.<br>';
			echo 'Mailer error: ' . $mail->ErrorInfo;
			echo '</div></div></div>';
		} else {
			//echo 'success';
			echo '<div class="container mail-msg bg-primary"><div class="row"><div class="col-md-3 col-md-offset-4">';
			echo '<br>Mail sent. You will be redirected in 5 seconds.<br>';
			echo '</div></div></div>';
		}





		// $to = "xrristo@gmail.com";
		// $from = $email;
		// //$name = $_POST['name'];
		// //$subject = $_POST['subject'];
		// $subject_sender = "Копија од Вашиот емаил до Тотал Пост Логистик";
		// $message = $name . " напиша: \n\n" . $msg;
		// $sender_msg = "You, " . $name . " wrote: \n\n" . $msg;

		// //echo "to: $to <br> from: $from <br> $name: $name <br> ";

		// $header = "From:" . $from;
		// $header2 = "From:" . $to;
		// mail($to,$subject,$message,$header);
		// mail($from,$subject_sender,$sender_msg,$header2); 
		// echo "Message sent. You will be redirected in 5 secondds."
	//}

?>
<!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/new-age.min.js"></script>

    <script src="js/script.js"></script>
</body>
</html>