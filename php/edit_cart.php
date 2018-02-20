<?php
    require "functions.php";
    require "db_connect.php";
    sec_session_start();

    if(login_check() && isset($_POST["action"]) && $_POST["action"] == "elimina") {
      $stmt = $mysqli->prepare("DELETE FROM carrelli WHERE email = ? AND id_prodotto = ?");
      $stmt->bind_param('sd', $_SESSION['email'], $_POST["idProd"]);
      $stmt->execute();
      echo calculateTotal();
    } else if(login_check() && isset($_POST["action"]) && $_POST["action"] == "modifica") {
      $stmt = $mysqli->prepare("UPDATE carrelli SET quantita=? WHERE email=? AND id_prodotto=?");
      $stmt->bind_param('dsd', $_POST["qta"], $_SESSION['email'], $_POST["idProd"]);
      $stmt->execute();
      echo calculateTotal();
    } else {
      echo "ERROR";
    }

    function calculateTotal() {
      global $mysqli;
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
      return $totale + 2;
    }
?>
