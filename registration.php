<?php
  require 'php/functions.php';
  sec_session_start();
  if (login_check()) {
    header('Location: index.php');
  }
  ?>
<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Registrazione</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
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
                        echo '<p class="text-center alert alert-danger">Registrazione fallita: è già presente un account associato a questo indirizzo email.</p><br>';
                    }
                    ?>

                      <div class="col-sm-12 offset-md-3">
                        <div class="form-box">
                          <div class="form-top">
                            <div class="form-top-left">
                              <h1>Registrati</h1>
                            </div>
                            <div class="form-top-right">
                              <em class="fa fa-pencil"></em>
                            </div>
                            </div>
                            <div class="form-bottom">
                          <form id="form" role="form" action="php/process_registration.php" method="post" class="registration-form">
                            <div class="row">
                            <div class="col-sm-6 form-group">
                              <label class="sr-only" for="nome">Nome</label>
                                <input type="text" name="nome" placeholder="Nome" class="form-name form-control" id="nome">
                              </div>
                              <div class="col-sm-6 form-group">
                                <label class="sr-only" for="cognome">Cognome</label>
                                <input type="text" name="cognome" placeholder="Cognome" class="form-surname form-control" id="cognome" >
                              </div>
                                </div>
                              <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <input type="text" name="email" placeholder="Email" class="form-email form-control" id="email">
                              </div>
                              <div class="row">
                              <div class="col-sm-6 form-group">
                                <label class="sr-only" for="password">Password</label>
                                <input type="password" name="password" minlength="6" placeholder="Password" class="form-password form-control" id="password" >
                              </div>
                              <div class="col-sm-6 form-group">
                                <label class="sr-only" for="password2">Ripeti password</label>
                                <input type="password" name="password2" minlength="6" placeholder="Ripeti password" class="form-r-password form-control" id="password2" >
                              </div>
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="indirizzo">Indirizzo di spedizione</label>
                                  <input type="text" name="indirizzo" placeholder="Indirizzo di spedizione" class="form-address form-control" id="indirizzo">
                                </div>
                                <div class="row">
                                <div class="col-sm-4 form-group">
                                <label class="sr-only" for="comune">Comune</label>
                                  <input type="text" name="comune" placeholder="Comune" class="form-district form-control" id="comune" >
                                </div>
                                <div class="col-sm-4 form-group">
                                <label class="sr-only" for="provincia">Provincia</label>
                                  <input type="text" name="provincia" placeholder="Provincia" class="form-province form-control" id="provincia" maxlength="2">
                                </div>
                                <div class="col-sm-4 form-group">
                                <label class="sr-only" for="cap">CAP</label>
                                  <input type="text" name="cap" placeholder="CAP" class="form-cap form-control" id="cap" maxlength="5">
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="sr-only" for="telefono">Telefono</label>
                                  <input type="text" name="telefono" placeholder="Telefono" class="form-telephone form-control" id="telefono" maxlength="10">
                                </div>
                              <button type="submit" class="btn">Registrati</button>
                          </form>
                        </div>
                        </div>

            </div>
        </div>
        <!-- Footer -->
        <?php
            include 'footer.php';
        ?>
        <!-- Javascript -->
    <script>
    $( document ).ready( function () {
			$( "#form" ).validate( {
				rules: {
					nome: "required",
					cognome: "required",
          email: {
            required: true,
            email: true
          },
					password: {
						required: true,
						minlength: 6
					},
					password2: {
						required: true,
						minlength: 6,
						equalTo: "#password"
					},
          indirizzo :{
            required : true,
            maxlength : 30
          },
          comune :{
            required : true,
            maxlength : 30
          },
          provincia :{
            required : true,
            maxlength : 2
          },
          cap :{
            required : true,
            maxlength : 5
          }
				},
				messages: {
					nome: "Inserisci il tuo nome",
					cognome: "Inserisci il tuo cognome",
					password: {
						required: "Inserisci una password",
						minlength: "Inserisci almeno 6 caratteri"
					},
					password2: {
						required: "Ripeti la password",
						minlength: "Inserisci almeno 6 caratteri",
						equalTo: "Ripeti la password correttamente"
					},
					email: {
            required:  "Inserisci un indirizzo email valido"
          },
          indirizzo : {
           required: "Inserisci un indirizzo di spedizione "
         },
         comune: {
          required: "Inserisci un comune "
        },
        provincia: {
         required: "Inserisci la provincia"
       },
       cap: {
        required: "Inserisci il CAP"
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
