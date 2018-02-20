<?php
require "./php/functions.php";
require "./php/db_connect.php";


$stmt = $mysqli->prepare("INSERT INTO newsletter (email) VALUES (?)");
$stmt->bind_param('s', $_POST['email']);
if($stmt->execute()){
  $to = $_POST['email'];
  $subject = "Piotto - Newsletter";
  $body = "<p>Ciao ".$_POST['nome'].", grazie per esserti registrato alla nostra newsletter!</p>";
  $headers = "From: noreply@piotto.altervista.org\r\n";
  $headers .= "Reply-To: noreply@piotto.altervista.org\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  mail($to, $subject, $body, $headers);
  header('Location: ./index.php?newsletter=1');
}
else{
  header('Location: ./index.php?nonewsletter=1');
}
?>
