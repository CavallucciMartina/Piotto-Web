<?php
require 'php/db_connect.php';
require 'php/functions.php';
sec_session_start();
if(login_check($mysqli) == false) {
?>
<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
    <script type="text/javascript" src="sha512.js"></script>
    <script type="text/javascript" src="forms.js"></script>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
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
  <!-- Top content -->
  <div class="container mappa">
                  <?php

                    if(isset($_GET['error'])) {
                        echo '<p class="text-center alert alert-danger">Autenticazione fallita, assicurati che email e password inseriti siano corretti</p><br>';
                    } else if(isset($_GET['new']) && $_GET['new'] == 1) {
                        echo '<p class="text-center alert alert-success">Registrazione avvenuta con successo!</p><br>';
                    } /*else if(isset($_GET['reset']) && $_GET['reset'] == 1) {
                        echo "<p class='text-center alert alert-success'>Ti abbiamo inviato una mail contenente un link per reimpostare la password</p><br>";
                    } else if(isset($_GET['reset']) && $_GET['reset'] == 2) {
                        echo "<p class='text-center alert alert-success'>Password impostata correttamente</p><br>";
                    }
                    */
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-top">
                              <div class="form-top-left">
                                <h1>Login</h1>
                              </div>
                              <div class="form-top-right">
                                <em class="fa fa-lock"></em>
                              </div>
                              </div>
                              <div class="form-bottom">
                            <form id="form" role="form" action="php/process_login.php" method="post" class="login-form">
                              <div class="form-group">
                                <label class="sr-only" for="email">Username</label>
                                  <input type="text" name="email" placeholder="Email" class="form-username form-control" id="email">
                                </div>
                                <div class="form-group">
                                  <label class="sr-only" for="password">Password</label>
                                  <input type="password" name="password" placeholder="Password" class="form-password form-control" id="password">
                                </div>
                                <button type="submit" class="btn" onclick="formhash(this.form, this.form.password);">Login</button>
                            </form>
                          </div>
                        </div>
                        </div>


                    </div>
                <div>

                  <div class="container text-center">
                    <h3>Sei un nuovo cliente?</h3>
                <a href="registration.php" class="btn btn-info" role="button">Registrati</a>
                </div>
            </div>

        <!-- Footer -->
        <?php
            include 'footer.php';
        ?>
    <script>
    $( document ).ready( function () {
      $( "#form" ).validate( {
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 6
          }
        },
        messages: {
          email: {
            required:  "Inserisci un indirizzo email valido"
          },
          password: {
            required: "Inserisci una password",
            minlength: "Inserisci almeno 6 caratteri"
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
 header('Location: ../utente.php');
}
?>
