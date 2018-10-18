<?php 
function fOpenConn() {
	if ($conn = mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD)) {
		if (mysqli_select_db($conn,DB_DATABASE)) {
                        mysqli_query($conn, "SET time_zone = '+07:00'");
			return $conn;
		}
	}
	else
	{
		echo "error fOpenConn<BR>";
		echo mysqli_error() . "<br>";
		return NULL;
	}
}

function antiinjection($str) {
 return addslashes($str);
}


function antiinjectionmain($str) {
 return addslashes($str);
}

# Suki - close connection
function fCloseConn($conn) {
    if (isset($conn)) mysqli_close($conn);
}



function mail_email($toaddress, $subject, $mailcontentmessage)
{
	require_once("../plugin/Phpmailer/class.smtp.php");
	require_once("../plugin/Phpmailer/class.phpmailer.php");
	$toaddress = $toaddress;
	$mail = new PHPMailer();
	$mail->IsSMTP(); // send via SMTP
	$mail->SMTPSecure = "ssl";
	$mail->Host = "asia5.myserverhosts.com"; // SMTP servers
	$mail->Mailer = "smtp";
	$mail->Port = "465";
	$mail->SMTPAuth = true; // turn on SMTP authentication
	
	$mail->Username = "no-reply@bandarbola855.com"; // SMTP username
	$mail->Password = "bola8888"; // SMTP password</pre>
	$mail->From = "no-reply@bandarbola855.com";
	$mail->FromName = "no-reply@bandarbola855.com";
	
	$mail->SmtpConnect();
	
	$mail->IsHTML(true);		
	
	$mail->AddAddress($toaddress); //bisa nambah penerima lagi, bebas
	
	$mail->Subject = $subject; //ini subject emailnya
	$mail->Body = $mailcontentmessage; //ini isi emailnya
	
	
	//mulai send emailnya

	if(!$mail->Send())
	{
		echo "Pengiriman Email Gagal kepada $toaddress";
	}
	else
	{
		return true;
	}
}
?>