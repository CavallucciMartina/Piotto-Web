<?php
require 'php/db_connect.php';
require 'php/functions.php';
sec_session_start();
if(is_admin()) {
  ?>
  <!DOCTYPE html>
  <html lang="it_IT">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Gestione ordini</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container pippo">
      <div class="row">
        <div class="col-sm-12">
          <h1>Gestione ordini</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <table id="gestione" class="table">
            <thead>
              <tr>
                <th>Ordine</th>
                <th>Cliente</th>
                <th>Stato</th>
                <th>Azione</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //prendo tutti gli ordini
              if($stmt = $mysqli->prepare("SELECT id_ordine, email, stato FROM ordini INNER JOIN utenti ON ordini.cliente = utenti.email ORDER BY id_ordine")) {
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0) {
                  $stmt->bind_result($id_ordine, $email, $stato);
                  while($stmt->fetch()) {
                    echo '<tr>
                    <td data-label="id ordine">' . $id_ordine . '</td>
                    <td data-label="email">' . $email . '</td>
                    <td data-label="stato">' . $stato . '</td>
                    <td data-label="azione">
                    <form action="php/update_order.php" method="post">
                      <input type="text" name="idOrdine" value=" ' . $id_ordine . ' " hidden>';
                      if($stato == "IN ELABORAZIONE") {
                        echo '<button type="submit" class="btn btn-success btn-block" name="azione" value="spedito">Evadi ordine</button>';
                      } else if ($stato == "SPEDITO") {
                        echo '<button type="submit" class="btn btn-success btn-block" name="azione" value="consegnato">Ordine consegnato</button>';
                      }
                     echo '</form>
                     </td>
                    </tr>';
                    //echo $prodotti_ordinati,$totale,$data,$indirizzo,$comune,$stato;
                  }
                }
                else {
                  //se non ci sono ordini
                  echo "<tr><td colspan='12'>Nessun ordine disponibile</td></tr>";
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
  </html>
  <?php
} else {
  header('Location: ../login.php?');
}
?>
