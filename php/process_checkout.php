<?php
require "functions.php";
require "db_connect.php";
sec_session_start();

if(!login_check()) {
  header('Location: ../index.php');
  die();
}

$totale = 0;
$stmt = $mysqli->prepare("SELECT prezzo, quantita FROM carrelli INNER JOIN prodotti ON prodotti.id_prodotto = carrelli.id_prodotto WHERE email = ?");
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0) {
  $stmt->bind_result($prezzo, $quantita);
  while($stmt->fetch()) {
    $totale += $prezzo * $quantita;
  }
}
$totale = $totale + 2;

//Creo ordine
$data = date('Y-m-d H:i:s');
$stato = "IN ELABORAZIONE";
$stmt = $mysqli->prepare("INSERT INTO ordini(cliente, data, stato, totale) VALUES (?, ?, ?, ?)");
$stmt->bind_param('sssd', $_SESSION['email'], $data, $stato, $totale);
$stmt->execute();
$idOrdine = $stmt->insert_id;
//Creo dettaglio ordine
$stmt = $mysqli->prepare("SELECT carrelli.id_prodotto, quantita, prezzo FROM carrelli INNER JOIN prodotti ON prodotti.id_prodotto = carrelli.id_prodotto WHERE email = ?");
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($idProdotto, $quantita, $prezzo);
while($stmt->fetch()) {
  $stmt2 = $mysqli->prepare("INSERT INTO dettagli_ordini(id_ordine, id_prodotto, quantita, totale) VALUES (?, ?, ?, ?)");
  $stmt2->bind_param('dddd', $idOrdine, $idProdotto, $quantita, $prezzo);
  $stmt2->execute();
}
//Rimuovo il contenuto del carrello
$stmt = $mysqli->prepare("DELETE FROM carrelli WHERE email = ?");
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
//Invio la notifica all'utente

$to = $_SESSION['email'];
$subject = "Piotto - Nuova ordinazione";
$notifica = "Grazie per aver ordinato su Piotto! Per rimanere aggiornato sullo stato del tuo ordine visita la pagina delle notifiche.";
  $body = "<p>$notifica</p>";
  $headers = "From: noreply@piotto.altervista.org\r\n";
  $headers .= "Reply-To: noreply@piotto.altervista.org\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  mail($to, $subject, $body, $headers);
  $stmt2 = $mysqli->prepare("INSERT INTO notifiche(id_ordine, stato, orario) VALUES (?, ?, ?)");
  $stmt2->bind_param('dss', $idOrdine, $stato, date('H:i:s'));
  $stmt2->execute();

  $to = "alfredo161996@gmail.com";
  $subject = "Piotto Admin - Nuovo ordine";
  $notifica = "Nuovo ordine effettuato, visita la pagina di Gestione Ordini.";
    $body = "<p>$notifica</p>";
    $headers = "From: noreply@piotto.altervista.org\r\n";
    $headers .= "Reply-To: noreply@piotto.altervista.org\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";
    mail($to, $subject, $body, $headers);


  header('Location: ../utente.php');
  ?>
