<?php
    require "functions.php";

    //Recupera la password criptata dal form di inserimento.
    $password = $_POST['password'];
    //Crea una chiave casuale
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()) , true));
    //Crea una password usando la chiave appena creata.
    $password = hash('sha512', $password . $random_salt);

    //verifico se l'utente esiste già
    $stmt = $mysqli->prepare("SELECT email FROM utenti WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->fetch();
    if($stmt->num_rows == 1) {
      //errore l'utente esiste già
      header('Location: ../registration.php?error=1');
    } else {
        //se l'utente non esiste lo inserisco
        $stmt = $mysqli->prepare("INSERT INTO utenti (email, password, salt, nome, cognome, indirizzo, comune, provincia, cap, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssssss',$_POST['email'], $password, $random_salt, $_POST['nome'],  $_POST['cognome'], $_POST['indirizzo'],  $_POST['comune'], $_POST['provincia'], $_POST['cap'], $_POST['telefono']);

        if($result = $stmt->execute()){
          header('Location: ../login.php?new=1');
        }
        else{
            header('Location: ../login.php?error=invalid');
        }

        $to = $_POST['email'];
        $subject = "Piotto - Registrazione completata";
        $body = "<p>Ciao ".$_POST['nome'].", grazie per esserti registrato!</p>";
        $headers = "From: noreply@piotto.altervista.org\r\n";
        $headers .= "Reply-To: noreply@piotto.altervista.org\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        mail($to, $subject, $body, $headers);


    }
?>
