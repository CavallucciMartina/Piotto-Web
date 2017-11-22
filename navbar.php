<?php
echo'
    <div class="jumbotron">
      <div class="container text-center">
        <h1>Piotto</h1>
        <p>Pizza e Panzerotto</p>
      </div>
    </div>
    <nav class="navbar navbar-inverse">
      <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Piotto</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="chi_siamo.php">Chi Siamo</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Prodotti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Hamburger</a></li>
            <li><a href="#">Pinse</a></li>
            <li><a href="#">Panzerotti</a></li>
          </ul>
        </li>
        <li><a href="#">Dicono di noi</a></li>
        <li><a href="#">Contatti</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Accedi</a></li>
        <li><a href="#">Carrello</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>'

?>
