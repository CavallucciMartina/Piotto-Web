<?php
    require "functions.php";
    require "db_connect.php";
    sec_session_start();

    //se l'utente non è loggato
    if(!login_check()) {
      //header('Location: ../login.php');
      echo "NOLOGIN";
      die();
    }

    if(is_admin() || !isset($_POST["idProd"]) || !isset($_POST["qta"])) {
      //header('Location: ../menu.php');
      echo "ERROR";
      die();
    }

    //Verifico se il prodotto è già presente nel carrello
    $stmt = $mysqli->prepare("SELECT quantita FROM carrelli WHERE email = ? AND id_prodotto = ?");
    $stmt->bind_param('sd', $_SESSION['email'], $_POST["idProd"]);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1) {
      //Se è già presente incremento la quantità
      $stmt->bind_result($qta);
      $stmt->fetch();
      $qta += $_POST["qta"];
      if($qta > 40) {
        echo "MAX";
        die();
      }
      $stmt = $mysqli->prepare("UPDATE carrelli SET quantita=?  WHERE email=? AND id_prodotto=?");
      $stmt->bind_param('dsd', $qta, $_SESSION['email'], $_POST["idProd"]);
      $stmt->execute();
    } else {
      //Altrimenti aggiungo il prodotto nel carrello
      $stmt = $mysqli->prepare("INSERT INTO carrelli(email, id_prodotto, quantita) VALUES (?, ?, ?)");
      $stmt->bind_param('sdd', $_SESSION['email'], $_POST["idProd"], $_POST["qta"]);
      $stmt->execute();
    }

    echo "OK";
?>
