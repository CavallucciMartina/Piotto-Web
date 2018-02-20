<?php
    require "functions.php";
    sec_session_start();

    if(!is_admin() || !isset($_POST["nome"]) || !isset($_POST["descrizione"]) || !isset($_POST["prezzo"]) || !isset($_POST["foto"]) || !isset($_POST["tipo_prodotto"])) {
      header("location: ../index.php");
      die();
    }
  $si='si';
    if(!empty($_POST["id"])) {
      //Aggiornamento prodotto esistente
      $stmt = $mysqli->prepare("UPDATE prodotti SET nome=?, ingredienti=?, prezzo=?, foto=?, tipo_prodotto=?, disponibile=? WHERE id_prodotto = ?");
      $stmt->bind_param('ssdsssd', $_POST['nome'], $_POST['descrizione'], $_POST['prezzo'], $_POST["foto"], $_POST["tipo_prodotto"],$si, $_POST["id"]);
      $stmt->execute();
      header('Location: ../menu.php?edit=1');
    } else {
      //Nuovo prodotto
      $stmt = $mysqli->prepare("INSERT INTO prodotti (nome, ingredienti, prezzo, foto, tipo_prodotto, disponibile) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('ssdsss', $_POST['nome'], $_POST['descrizione'], $_POST['prezzo'], $_POST["foto"], $_POST["tipo_prodotto"], $si);
      $stmt->execute();
      header('Location: ../menu.php?new=1');
    }
?>
