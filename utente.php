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
    <title>Utente</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container pippo">
      <?php
      $stmt = $mysqli->prepare("SELECT email, nome, cognome, indirizzo, comune, provincia, cap, telefono FROM utenti WHERE email = ? LIMIT 1");
      $stmt->bind_param('s', $_SESSION['email']);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($email, $nome, $cognome, $indirizzo, $comune, $provincia, $cap, $telefono);
      $stmt->fetch();
      ?>
      <div class="row">
        <div class="col-sm-9">
          <h1>Ciao <?php echo $nome." ".$cognome; ?>!</h1>
        </div>
        <div class="col-sm-3 text-right">
          <a class="btn btn-default btn-lg" href="php/logout.php"><em class="fa fa-sign-out"></em> Logout</a>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h2>I tuoi dati</h2>
          <p>Nome: <?php echo $nome?></p>
          <p>Cognome: <?php echo $cognome?></p>
          <p>Indirizzo: <?php echo $indirizzo." ".$comune." ".$cap." ".$provincia?></p>
          <p>Telefono <?php echo $telefono?></p><br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h2>I tuoi ordini</h2>
          <table class="table">
            <thead>
              <tr>
                <th>Ordine</th>
                <th>Prezzo</th>
                <th>Data</th>
                <th>Stato ordine</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //prendo tutti gli ordini di un utente
              if($stmt = $mysqli->prepare("SELECT id_ordine, totale, data, stato FROM ordini WHERE cliente='" . $_SESSION['email'] . "'")) {
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0) {
                  $stmt->bind_result($id_ordine, $totale, $data, $stato);
                  while($stmt->fetch()) {
                    echo '<tr>
                    <td data-label="prodotti ordinati">' . $id_ordine . '</td>
                    <td data-label="totale">' . $totale . '</td>
                    <td data-label="data">' . $data . '</td>
                    <td data-label="stato ordine">' . $stato . '</td>
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



    <?php
    include 'footer.php';
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  </html>
  <?php
} else {
  header('Location: ../login.php?');
}
?>
