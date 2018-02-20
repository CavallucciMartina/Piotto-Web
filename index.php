<!DOCTYPE html>
<html lang="it-IT">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Piotto</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="shortcut icon" type="image/png" href="img/logo.png">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap -->
  <!-- Respomsive slider -->
  <link href="css/responsive-slider.css" rel="stylesheet">
</head>
<body>
  <?php
  include 'navbar.php';
  ?>


  <div class="container-fluid">
    <?php
    if(isset($_GET['newsletter'])) {
          echo '<br><br><br><p class="text-center alert alert-success">Registrazione alla newsletter avvenuta con successo!</p><br>';

      }
      if(isset($_GET['nonewsletter'])) {
            echo '<br><br><br><p class="text-center alert alert-success">Sei già presente nella nostra newsletter!</p><br>';

        }
      ?>
    <div class="row">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
          <div class="item active">
            <img src="img/pinsah.jpg" alt="pinsa">
            <div class="carousel-caption">
              <h3>Pinsa</h3>
              <p>Un'ottima pizza pugliese farcita con tutti gli ingredienti che vuoi!</p>
            </div>
          </div>

          <div class="item">
            <img src="img/pucciah.jpg" alt="puccia">
            <div class="carousel-caption">
              <h3>Puccia</h3>
              <p>Il panino più buono che ci sia!</p>
            </div>
          </div>

          <div class="item">
            <img src="img/panzerottoh.jpg" alt="panzerotto">
            <div class="carousel-caption">
              <h3>Panzerotto</h3>
              <p>Che sia una merenda o un dolce dopo pranzo, il panzerotto è sempre qui ad aspettarti</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <br>
      <div class="col-sm-12 text-center saluto">
        <p>Piotto è lo street food all'italiana, con prodotti freschi e genuini;<br> da oggi potrai
        acquistarli comodamente da qui, penseremo noi a recapitarteli!</p>
      </div>
      </div>

              <br>
                <div class="row">
      <div class="col-sm-12 text-center dicono">
        <h2>DICONO DI NOI...</h2>
      </div>
      <br>
      <br>
      <br>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div id="text-carousel" class="carousel slide" data-ride="carousel">
          <div class="row-recensioni">
            <div class="col-xs-offset-3 col-xs-6">
              <div class="carousel-inner">
                <div class="item active">
                  <div class="carousel-content">
                    <div>
                      <p>Pinsa n.2 buonissima!
                        Ci torno sicuramente!   <br>Marco</p>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="carousel-content">
                      <div>
                        <p>Puccia burger con vera carne di manzo,
                          cotta benissimo e buonissima.
                          Servizio velocissimo!
                        <br> Andrea </p>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="carousel-content">
                      <div>
                        <p>Prodotti freschissimi e di qualità vicino a casa! <br> Giorgia</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#text-carousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#text-carousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
      </div>

    </div>
  </div>



    <?php
    include 'footer.php';
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.event.move.js"></script>
    <script src="js/responsive-slider.js"></script>
  </body>
  </html>
