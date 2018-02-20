<?php
require 'php/db_connect.php';
require 'php/functions.php';
sec_session_start();
?>
<!DOCTYPE html>
<html lang="it_IT">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Menù</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/notify.js"></script>

  <script src="js/bootstrap.min.js"></script>

  <link rel="shortcut icon" type="image/png" href="img/logo.png">
</head>
<body>
  <?php
  include 'navbar.php';
  ?>
  <div class="container pippo" >

    <?php
    if(is_admin()){
      echo '
      <div class="row">
        <div class="col-sm-6 text-center">
          <form action="admin.php" method="post">
            <button type="submit" name="aggiungi" class="btn btn-secondary">Aggiungi prodotto <i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
          </form>
             <br>
        </div>

        <div class="col-sm-6 text-center">
          <form action="gestione_ordini.php" method="post">
            <button type="submit" name="gestione" class="btn btn-secondary">Gestione ordini <i class="fa fa-cog" aria-hidden="true"></i></button>
          </form>
        </div>
      </div><br>';

    }
    if(isset($_GET['new'])) {
      echo '<p class="text-center alert alert-success">Inserimento avvenuto con successo</p><br>';
    } else if(isset($_GET['edit'])) {
      echo '<p class="text-center alert alert-success">Modifica avvenuta con successo</p><br>';
    } else if(isset($_GET['delete'])) {
      echo '<p class="text-center alert alert-success">Eliminazione avvenuta con successo</p><br>';
    }
    ?>
    <div class="row">
      <div class="col-sm-12">
        <h1>Pinse</h1><br>
      </div>
      <?php
      //elenco delle pinse
      $imgFolder="./img/menu/";
      $stmt = $mysqli->prepare("SELECT id_prodotto, nome, prezzo, ingredienti, foto FROM prodotti WHERE tipo_prodotto = 'Pinsa' AND disponibile = 'si'");
      $stmt->execute();
      $stmt->store_result();
      //echo $stmt->num_rows;
      if($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $prezzo, $descrizione, $immagine);
        while($stmt->fetch()) { ?>
          <div class="col-sm-4">
            <div class="card">
              <img class="img-fluid w-100" style="max-height:280px;" src="<?php echo $imgFolder.$immagine ?>" alt="<?php echo $nome; ?>">
              <div class="card-body text-center vcenter" style="padding-bottom:0px;">
                <h5 class="mb-0 text-center"><?php echo $nome; ?></h5>
                <p><?php echo $descrizione; ?></p>
                <h3><?php echo $prezzo; ?>€</h3>
              </div>
              <div class="card-footer force-to-bottom text-center">
                <form action="admin.php" method="post">
                  <input type="number" name="idProd" value="<?php echo $id; ?>" required hidden>
                  <?php
                  if(!is_admin()) {
                    echo '
                    <label>Quantità: <input type="number" name="quantita" value="1" min="1" max="20" required></label><br>
                    <button type="button" onclick="add2cart(this.form)" class="btn btn-secondary">Aggiungi al carrello <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>';
                  } else {
                    echo '
                    <button type="submit" name="modifica" class="btn btn-secondary">Modifica <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button type="submit" name="elimina" onclick="conferma(event)" class="btn btn-secondary"> Elimina <i class="fa fa-trash-o" aria-hidden="true"></i></button>';

                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
          <?php
          //echo $nome, $prezzo, $ingredienti, $foto;

        }
      }
      else{
        //se non ci sono prodotti
        echo "<tr><td colspan='12'>Nessun prodotto disponibile</td></tr>";
      }

      ?>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <br><br><h1>Panzerotti</h1><br>
      </div>
      <?php
      //elenco delle pinse
      $imgFolder="./img/menu/";
      $stmt = $mysqli->prepare("SELECT id_prodotto, nome, prezzo, ingredienti, foto FROM prodotti WHERE tipo_prodotto = 'Panzerotto' AND disponibile = 'si'");
      $stmt->execute();
      $stmt->store_result();
      //echo $stmt->num_rows;
      if($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $prezzo, $descrizione, $immagine);
        while($stmt->fetch()) { ?>
          <div class="col-sm-4">
            <div class="card">
              <img class="img-fluid w-100" style="max-height:280px;" src="<?php echo $imgFolder.$immagine ?>" alt="<?php echo $nome; ?>">
              <div class="card-body text-center vcenter" style="padding-bottom:0px;">
                <h5 class="mb-0 text-center"><?php echo $nome; ?></h5>
                <p><?php echo $descrizione; ?></p>
                <h3><?php echo $prezzo; ?>€</h3>
              </div>
              <div class="card-footer force-to-bottom text-center">
                <form action="admin.php" method="post">
                  <input type="number" name="idProd" value="<?php echo $id; ?>" required hidden>
                  <?php
                  if(!is_admin()) {           //<button type="button" onclick="add2cart(this.form)" class="fa fa-cart-arrow-down"> Aggiungi al carrello</button>
                    echo '
                    <label>Quantità: <input type="number" name="quantita" value="1" min="1" max="20" required></label><br>
                    <button type="button" onclick="add2cart(this.form)" class="btn btn-secondary">Aggiungi al carrello <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>';
                  } else {
                    echo '
                    <button type="submit" name="modifica" class="btn btn-secondary">Modifica <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button type="submit" name="elimina" onclick="conferma(event)" class="btn btn-secondary"> Elimina <i class="fa fa-trash-o" aria-hidden="true"></i></button>';

                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
          <?php
          //echo $nome, $prezzo, $ingredienti, $foto;

        }
      }
      else{
        //se non ci sono prodotti
        echo "<tr><td colspan='12'>Nessun prodotto disponibile</td></tr>";
      }

      ?>
    </div>

    <div class="row d-flex">
      <div class="col-sm-12">
        <br><br><h1>Pucce</h1><br>
      </div>
      <?php
      //elenco delle pinse
      $imgFolder="./img/menu/";
      $stmt = $mysqli->prepare("SELECT id_prodotto, nome, prezzo, ingredienti, foto FROM prodotti WHERE tipo_prodotto = 'Puccia' AND disponibile = 'si'");
      $stmt->execute();
      $stmt->store_result();
      //echo $stmt->num_rows;
      if($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $prezzo, $descrizione, $immagine);
        while($stmt->fetch()) { ?>
          <div class="col-sm-4">
            <div class="card">
              <img class="img-fluid w-100" style="max-height:280px;" src="<?php echo $imgFolder.$immagine ?>" alt="<?php echo $nome; ?>">
              <div class="card-body text-center vcenter" style="padding-bottom:0px;">
                <h5 class="mb-0 text-center"><?php echo $nome; ?></h5>
                <p><?php echo $descrizione; ?></p>
                <h3><?php echo $prezzo; ?>€</h3>
              </div>
              <div class="card-footer force-to-bottom text-center">
                <form action="admin.php" method="post">
                  <input type="number" name="idProd" value="<?php echo $id; ?>" required hidden>
                  <?php
                  if(!is_admin()) {           //<button type="button" onclick="add2cart(this.form)" class="fa fa-cart-arrow-down"> Aggiungi al carrello</button>
                    echo '
                    <label>Quantità: <input type="number" name="quantita" value="1" min="1" max="20" required></label><br>
                    <button type="button" onclick="add2cart(this.form)" class="btn btn-secondary">Aggiungi al carrello <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>';
                  } else {
                    echo '
                    <button type="submit" name="modifica" class="btn btn-secondary">Modifica <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button type="submit" name="elimina" onclick="conferma(event)" class="btn btn-secondary"> Elimina <i class="fa fa-trash-o" aria-hidden="true"></i></button>';

                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
          <?php
          //echo $nome, $prezzo, $ingredienti, $foto;

        }
      }
      else{
        //se non ci sono prodotti
        echo "<tr><td colspan='12'>Nessun prodotto disponibile</td></tr>";
      }

      ?>
    </div>





  </div>
  <script>
  function add2cart(form) {
    var qta = form.quantita.value;
    var idProd = form.idProd.value;
    $.post("php/add2cart.php", { idProd: idProd, qta: qta }, function(result){
      var messaggio = "";
      var tipo = "";
      switch(result) {
        case "NOLOGIN":
        messaggio = "Esegui il login per poter acquistare!";
        tipo = "warn";
        break;
        case "OK":
        messaggio = "Prodotto inserito nel carrello!";
        tipo = "success";
        break;
        case "MAX":
        messaggio = "E' possibile ordinare al massimo 20 unità per prodotto";
        tipo = "warn";
        break;
        default:
        messaggio = "Si è verificato un errore inatteso...";
        tipo = "error";
      }
      $.notify(messaggio, tipo);
    });
  }
</script>



<?php
include 'footer.php';
?>
</body>
</html>
