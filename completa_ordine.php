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
    <title>Completa ordine</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
     <script src="js/jquery.validate.min.js"></script>
     <script src="js/messages_it.min.js"></script>
  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container pippo" >
      <div class="row">
        <div class="col-sm-12">
          <h1>Completa ordine</h1>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-sm-12">
          <h2>Pagamento</h2>
        </div>
      </div>
      <br>
      <form action="php/process_checkout.php" id="frmCarta" method="post">

        <div class="row">
          <div class="col-sm-12">
            <label class="radio-inline">
              <input type="radio" name="optradio"><i class="fa fa-cc-mastercard" style="font-size:35px"></i>
            </label>
            <label class="radio-inline">
              <input type="radio" name="optradio"><i class="fa fa-cc-visa" style="font-size:35px"></i>
            </label>
            <label class="radio-inline">
              <input type="radio" name="optradio"><i class="fa fa-cc-paypal" style="font-size:35px"></i>
            </label>
            <label class="radio-inline">
              <input type="radio" name="optradio"><i class="fa fa-cc-amex" style="font-size:35px"></i>
            </label>
          </div>
        </div>
        <br>

        <div class="row">
          <div class="col-sm-6">
              <label class="sr-only" for="numero">Numero</label>
            <input type="text" name="numero" class="form-control" id="numero" value="" placeholder="Numero carta" minlength="13" maxlength="16"><br>
          </div>
          <div class="col-sm-6 ">
                           <label class="sr-only" for="intestatario">Intestatario</label>
            <input type="text" name="intestatario" class="form-control" id="intestatario" value="" placeholder="Nome e cognome intestatario"><br>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-12">
            <p>Data di scadenza</p>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
                  <label class="sr-only" for="sel1">Selezione mesi</label>
              <select id="sel1" name="sel1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
              </select>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label class="sr-only" for="sel2">Selezione</label>
              <select id="sel2" name="sel2">
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
                <option>2024</option>
                <option>2025</option>
                <option>2026</option>
                <option>2027</option>
                <option>2028</option>
                <option>2029</option>
                <option>2030</option>
                <option>2031</option>
                <option>2032</option>
                <option>2033</option>
                <option>2034</option>
                <option>2035</option>
              </select>
            </div>
          </div>
          <div class="col-sm-5">
            <label class="sr-only" for="cvv">CVV</label>
            <input type="text" name="cvv" id="cvv" value="" placeholder="CVV" minlength="3" maxlength="3">
          </div>
          <div class="col-sm-1">
            <br>
            <h2>Totale: </h2>
          </div>
          <div class="col-sm-2 text-right">
            <br>
            <?php
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
            $totale += 2;
            echo '<h2>' . $totale . ' €</h2>';
            ?>

          </div>
          <br>
        </div>
        <div class="row">
          <div class="col-sm-12 text-right">
            <button type="submit" class="btn ">Paga ora</button>
          </div>
        </div>
      </form>

    </div>



    <?php
    include 'footer.php';
    ?>
    <script>
    $( document ).ready( function () {
      $( "#frmCarta" ).validate( {
        rules: {
          numero: {
            required: true,
            minlength : 13
          } ,
          intestatario: "required",
          sel1: {
            required: true,
          },
          sel2: {
            required: true,
          },
          cvv: {
            required: true,
            minlength: 3,
            maxlength : 5,
          },
          optradio :{
            required : true,
          }
        },
        messages: {
          numero: {
            required : "Inserisci il numero della carta",
            minlength: "Inserisci almeno 13 caratteri"
          },
          intestatario: {
            required: "Inserisci il nome e cognome intestatario"
          },
          sel1: {
            required : "Selezione il mese di scadenza"
          },
          sel2 :{
            required : "Selezione l'anno di scadenza"
          },
          cvv:{
            required : "Inserisci il numero CVV della carta",
            minlength: "Inserisci almeno 3 caratteri"
          },
          optradio : {
            required : "Seleziona un tipo di carta"
          }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
        }
      } );
    } );
    </script>
  </body>
  </html>
  <?php


} else {
  header('Location: ../login.php?');
}





?>
