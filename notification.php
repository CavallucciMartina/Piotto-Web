<?php
require 'php/db_connect.php';
require 'php/functions.php';
sec_session_start();
if(login_check($mysqli) == true) {
  ?>
  <!DOCTYPE html>
  <html lang="it_IT">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Notifiche</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container pippo">
      <h1>Notifiche</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Stato degli ordini</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = $mysqli->prepare("SELECT ordini.id_ordine, notifiche.stato, orario, data FROM notifiche INNER JOIN ordini ON ordini.id_ordine = notifiche.id_ordine WHERE ordini.cliente = ? ORDER BY orario DESC");
          $stmt->bind_param('s', $_SESSION['email']);
          $stmt->execute();
          $stmt->store_result();
          if($stmt->num_rows > 0) {
            $stmt->bind_result($id_ordine, $stato, $orario, $data);
            while($stmt->fetch()) {
              echo '<tr>
              <td>Alle ore '.$orario.' il tuo ordine n.'.$id_ordine.' del '.$data.' è '.$stato . '</td>
              </tr>';
            }
          }
          else{
            echo "<tr><td colspan='6'>Nessuna notifica disponibile</td></tr>";
          }
          ?>

        </tbody>
      </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <?php
    include 'footer.php';
    ?>

  </body>
  </html>
  <?php


} else {
  header('Location: ../login.php?');
}





?>
