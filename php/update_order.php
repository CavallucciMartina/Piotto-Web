<?php
  require "functions.php";
  sec_session_start();

  if(!is_admin() || !isset($_POST["idOrdine"]) || !isset($_POST["azione"])) {
    header('Location: ../index.php');
    die();
  }

  $idOrdine = $_POST['idOrdine'];
  switch ($_POST["azione"]) {
    case 'spedito':
      $titolo = "Piotto - Ordine #$idOrdine in consegna";
      $notifica = "Il tuo è stato evaso e presto arriverà a destinazione.";
      $stato = "SPEDITO";
      break;
    case 'consegnato':
      $titolo = "Piotto - Ordine #$idOrdine consegnato";
      $notifica = "Il tuo è stato consegnato. Buon appetito!!!</a>";
      $stato = "CONSEGNATO";
      break;
    default:
      return "IN ELABORAZIONE";
  }
  //Aggiorno stato ordine
  $stmt = $mysqli->prepare("UPDATE ordini SET stato= ? WHERE id_ordine = ?");
  $stmt->bind_param('sd', $stato, $_POST["idOrdine"]);
  $stmt->execute();
  //Invio notifica
  $stmt = $mysqli->prepare("SELECT cliente FROM ordini WHERE ordini.id_ordine = ?");
  $stmt->bind_param('d', $_POST["idOrdine"]);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($email);
  $stmt->fetch();
  $to = $email;
  $subject = $titolo;
  $body = "<p>$notifica</p>";
  $headers = "From: noreply@piotto.altervista.org\r\n";
  $headers .= "Reply-To: noreply@piotto.altervista.org\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  mail($to, $subject, $body, $headers);
  $data = date('H:i:s');
  $stmt2 = $mysqli->prepare("INSERT INTO notifiche(id_ordine, stato, orario) VALUES (?, ?, ?)");
  $stmt2->bind_param('dss', $_POST["idOrdine"], $stato, $data);
  $stmt2->execute();

  header('Location: ../gestione_ordini.php');
?>
