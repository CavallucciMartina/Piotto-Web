<!DOCTYPE html>
<html lang="it_IT">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Piotto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
      include 'navbar.php';
     ?>
<div class="container">



  <div class="row">
  	<div class="col-sm-4">
  		<h1>Piotto</h1>
  		<h2>Pizza e Panzerotto</h2>
  		<p>Piotto è lo street food all'italiana con prodotti freschi e genuini.</p>
  		<p>Da oggi potrai acquistare on-line le nostre Pinse, i gustosi Panzerotti e le grandi Pucce comodamente da qui.</p>
  		<p>Penseremo noi a recapitarti il tuo acquisto!</p>
  	</div>
  	<div class="col-sm-8">
  		<div id="carousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  		<ol class="carousel-indicators">
    		<li data-target="#carousel" data-slide-to="0" class="active"></li>
    		<li data-target="#carousel" data-slide-to="1"></li>
    		<li data-target="#carousel" data-slide-to="2"></li>
  		</ol>

  		<!-- Wrapper for slides -->
  		<div class="carousel-inner" role="listbox">
    	<div class="item active">
      		<img src="img/pinsa.jpg" alt="Pinsa">
      		<div class="carousel-caption">
      			Questa è una Pinsa
      		</div>
    	</div>
    	<div class="item">
      		<img src="img/pucciaBurger.jpg" alt="Puccia Burger">
      		<div class="carousel-caption">
        		Questa è una Puccia Burger
      		</div>
    	</div>
    	<div class="item">
      		<img src="img/panzerotto.jpg" alt="Panzerotto">
      		<div class="carousel-caption">
        		Questo è un panzerotto
      		</div>
    	</div>
  		</div>
		</div>
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
