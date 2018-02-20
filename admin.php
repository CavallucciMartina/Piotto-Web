<?php
require 'php/functions.php';
sec_session_start();
if (!is_admin()) {
  header('Location: index.php');
  die();
}

if(isset($_POST['elimina'])) {
  $no = 'no';
  $stmt = $mysqli -> prepare("UPDATE prodotti SET disponibile = ? WHERE id_prodotto = ?");
  $stmt->bind_param('sd', $no, $_POST["idProd"]);
  $stmt->execute();
  $stmt = $mysqli->prepare("DELETE FROM carrelli WHERE id_prodotto = ?");
  $stmt->bind_param('d', $_POST["idProd"]);
  $stmt->execute();
  header("location: menu.php?delete=1");
}

if(isset($_POST['modifica'])) {
  $stmt = $mysqli->prepare("SELECT id_prodotto, nome, ingredienti, prezzo, foto, tipo_prodotto FROM prodotti WHERE id_prodotto = ?");
  $stmt->bind_param('d', $_POST['idProd']);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows > 0) {
    $stmt->bind_result($id, $nome, $ingredienti, $prezzo, $foto, $tipo_prodotto);
    $stmt->fetch();
  } else {
    header('Location: menu.php');
    die();
  }
}
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" type="image/png" href="img/logo.png">
</head>
<body>
  <?php
  include 'navbar.php';
  ?>
  <div class="container pippo" >
    <div class="row">
      <div class="col-sm-12">
        <h1>Gestione prodotti</h1>
        <h3><?php echo isset($_POST['idProd']) ? "Modifica prodotto" : "Aggiungi un nuovo prodotto"; ?></h3>
      </div>
    </div>
    <div class="row">
    <form class="col-sm-12" id="form" enctype="multipart/form-data" method="post" action="php/edit_menu.php">
      <input type="number" name="id" value="<?php echo $_POST['idProd'] ?>" hidden>
      <div class="row">
        <div class="col-sm-6 ">
          <input type="text" class="form-control" name="nome"  value="<?php echo $nome ?>" placeholder="Nome prodotto" id="nome"><br>
        </div>
        <div class="col-sm-6">
          <select class="select" id="tipo_prodotto" name="tipo_prodotto" required>
            <option class="placeholder" selected disabled value="">Tipo prodotto</option hidden>
            <option>Pinsa</option>
            <option>Panzerotto</option>
            <option>Puccia</option>
          </select>
          <br>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="prezzo" id="prezzo" value="<?php echo $prezzo ?>" placeholder="Prezzo"><br>
        </div>
        <div class="col-sm-6 ">
          <input type="text" class="form-control" name="foto" id="foto" value="<?php echo $foto ?>" placeholder="Nome della foto (es: pinsa.jpg)"><br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <input type="text" class="form-control" name="descrizione" id="descrizione" value="<?php echo $ingredienti ?>" placeholder="Descrizione prodotto"><br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left">

        </div>

        <div class="col-sm-10 text-right">
          <button type="submit" class="btn ">Registra prodotto</button>
        </div>
      </div>
  </form>
  </div>





</div>

<?php
include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
