<?php

echo '
<div class="container">
    <!----------- Footer ------------>
    <footer class="footer-bs">
        <div class="row">
          <div class="col-md-4 footer-brand animated fadeInLeft">
              <h2>Piotto</h2>
                <p>Pizza e panzerotto </br>

                  Piazza Fabbri, 2 - Cesena (FC)</br>
                CAP 47521</p>
                <p>© Copyright 2018 Piotto - Tutti i diritti riservati.</p>
            </div>

          <div class="col-md-4 footer-social animated fadeInDown">
              <h4>Seguici su</h4>
                <a target="_blank" class="btn-social btn-facebook"><i class="fa fa-facebook"></i></a>
                <a target="_blank" class="btn-social btn-instagram"><i class="fa fa-instagram"></i></a>
                <a target="_blank" class="btn-social btn-twitter"><i class="fa fa-twitter"></i></a>
                <a target="_blank" class="btn-social btn-google-plus"><i class="fa fa-google-plus"></i></a>
                <a target="_blank" class="btn-social btn-pinterest"><i class="fa fa-pinterest"></i></a>
            </div>
          <div class="col-md-4 footer-ns animated fadeInRight">
              <h4>Newsletter</h4>
                <p>Rimani aggiornato su tutte le novità del nostro Menù!</p>
                <p>
                <form role="form" action="newsletter.php" method="post" class="newsletter-form">
                    <div class="input-group">
                      <input type="email" class="form-control" name="email"  placeholder="Inserisci la tua email" id="email"required>
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-envelope"></span></button>

                      </span>
                    </div><!-- /input-group -->
                    </form>
                 </p>
            </div>
        </div>
    </footer>

</div>'


?>
