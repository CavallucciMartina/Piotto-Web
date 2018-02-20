<?php
require 'php/db_connect.php';
require 'php/functions.php';
sec_session_start();
if(login_check($mysqli) == true) {
  ?>
  <!DOCTYPE html>
  <html lang="it-IT">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Carrello</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-notify.min.js"></script>


    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">


  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container pippo">
      <div class="row">

            <?php
            //prendo tutti i prodotti nel carrello dell'utente
            if($stmt = $mysqli->prepare("SELECT prodotti.id_prodotto, nome, ingredienti, foto, prezzo, quantita FROM carrelli INNER JOIN prodotti ON prodotti.id_prodotto = carrelli.id_prodotto WHERE email = ?")) {

              $stmt->bind_param("s", $_SESSION['email']);
              $stmt->execute();
              $stmt->store_result();
              if($stmt->num_rows > 0) {
                echo '
                <table id="cart" class="table table-hover table-condensed">
                  <thead>
                    <tr>
                      <th style="width:50%">Prodotto</th>
                      <th style="width:10%">Prezzo</th>
                      <th style="width:8%">Quantità</th>
                      <th style="width:20%"></th>
                    </tr>
                  </thead>
                  <tbody>
                ';
                $stmt->bind_result($id_prodotto, $nome, $descrizione, $foto, $prezzo, $quantita);
                while($stmt->fetch()) {
                  $parziale = $prezzo * $quantita;
                  $totaleParziale += $parziale;
                  echo '<tr id="' . $id_prodotto . '">
                  <td data-th="Prodotto">
                  <div class="row">
                  <div class="col-sm-4 hidden-xs"><img alt="foto" src="img/menu/' . $foto . '" class="img-responsive"/></div>
                  <div class="col-sm-10">
                  <h4 class="nomargin text-muted">' . $nome .'</h4>
                  <p>' . $descrizione . '</p>
                  </div>
                  </div>
                  </td>

                  <form>
                  <td data-th="Prezzo">
                  <p>€ ' . $prezzo . '</p>
                  </td>
                  <td data-th="Quantità">
                  <label for="qta" class="col-lg-4 col-sm-4 sr-only">Quantita</label>';?>
                  <input type="number" class="qta_group form-control text-center" onclick="updateQuantity(this.form)" onchange="updateQuantity(this.form)" max="40" min="1" name="qta" id="qta" value="<?php echo $quantita; ?>">
                  <label for="idProd" hidden>Id prodotto</label>
                  <input id="idProd" type="number" name="idProd" value="<?php echo $id_prodotto; ?>" hidden>
                  <?php
                  echo '</td>


                  <td data-th="">
                  <label for="btn_delete" class="col-lg-2 col-sm-2 sr-only control-label">Elimina:</label>
                  <button aria-label="Elimina" onclick="deleteProduct(this.form)" type="button" class="btn btn-danger btn-sm" id="btn_delete" name="btn_delete"><em class="fa fa-trash-o"></em></button>
                  </form>
                  </td>

                  </tr>';
                  //echo $prodotti_ordinati,$totale,$data,$indirizzo,$comune,$stato;
                }
                $totale = $totaleParziale + 2;
                echo '
                </tbody>
                <tfoot>
                <tr>
                <td colspan="2" class=""></td>
                <td class=" text-left"> Totale parziale</td>
                <td colspan="1" class=""></td>
                <td class="text-right" id="lblSubTotale">' . $totaleParziale . ' €</td>
                </tr>
                <tr>
                <td colspan="2" class=""></td>
                <td class=" text-left"> Spese di spedizione</td>
                <td colspan="1" class=""></td>
                <td class="text-right">2 €</td>
                </tr>
                <tr>
                <td colspan="2" class=""></td>
                <td class=" text-left"><strong>Totale</strong></td>
                <td colspan="1" class=""></td>
                <td class="text-right" id="lblTotale">' . $totale . ' € </td>

                </tr>

                </tfoot>
                </table>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <a href="menu.php" class="btn btn-warning btn-block text-left"><em class="fa fa-angle-left"></em> Continua lo shopping</a></td>
                  </div>
                  <div class="col-sm-6">
                    <input type = "hidden" name = "prezzoTot" value = € "'. $totale .'" />';?>
                    <input type="button" value="Procedi al checkout" class="btn btn-success btn-block text-right" onclick="location.href='completa_ordine.php'">
                    <?php
                  echo '</div>
                </div>
                ';

              }
              else {
                //se non ci sono ordini
                echo '
                <div class="col-sm-12">
                <h2>Carrello vuoto</h2>
                </div>
                      </div>
                ';
          
              }
            }


            ?>


        </div>

        <!-- Footer -->
        <?php
        include 'footer.php';
        ?>
        <!-- Javascript
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>-->
        <script>
        function updateQuantity(form) {
          if(form.qta.value < 1) form.qta.value = 1;
          if(form.qta.value > 40) form.qta.value = 40;
          var idProd = form.idProd.value;
          var qta = form.qta.value;

          //modifica totale
          $.post("php/edit_cart.php", { idProd: idProd, qta: qta, action: "modifica" }, function(result) {
            if(result != "ERROR") {
              $('#lblTotale').text(result.concat(" €"));
              result = result - 2;
              result.toString();
              $('#lblSubTotale').text(result + " €");

            } else {
              notifyError();
            }
          });
        }

        function deleteProduct(form) {
          var idProd = form.idProd.value;
          $.post("php/edit_cart.php", { idProd: idProd, action: "elimina" }, function(result) {
            if(result != "ERROR") {
              $('#' + idProd).remove();
              $('#lblTotale').text(result.concat(" €"));
              result = result - 2;
              result.toString();
              $('#lblSubTotale').text(result + " €");
            } else {
              notifyError();
            }
          });
        }

        function notifyError() {
          $.notify({
            message: "Si è verificato un errore imprevisto..."
          },{
            type: "danger",
            offset: {
              x: 0,
              y: 10
            }
          });
        }
        </script>
      </body>
      </html>
      <?php
    } else {
      header('Location: ../login.php?');
    }
    ?>
