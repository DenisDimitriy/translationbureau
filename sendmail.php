 <?php


// get the q parameter from URL
$n = $_REQUEST["n"];
$e = $_REQUEST["e"];
$m = $_REQUEST["m"];

$n = urldecode($n);
$m = urldecode($m);
$e = urldecode($e);


require("PHPMailer_5.2.0/class.phpmailer.php");

$mail = new PHPMailer();
$mail->CharSet='utf-8';

$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "mail.perevod.dp.ua";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "bot@perevod.dp.ua";  // SMTP username
$mail->Password = "******"; // SMTP password

$mail->From = "bot@perevod.dp.ua";
$mail->AddAddress("mail@perevod.dp.ua");
$mail->AddAddress("marina.marina1@ukr.net");
$mail->AddReplyTo($e, $n);

$mail->Subject = "Automatic message";
$mail->Body    = $m;

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";

?>
