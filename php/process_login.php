<?php
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_POST['email'], $_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password']; // Recupero la password criptata.
  if(login($email, $password, $mysqli) == true) {
    // Login eseguito
    echo 'Login eseguito';
    header('Location: ../utente.php');
  } else {
    header('Location: ../login.php?error=1');
  }
} else {
  // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
  echo 'Invalid Request';
}
?>
