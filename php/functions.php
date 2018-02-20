<?php
require 'db_connect.php';

function sec_session_start() {
	$session_name = 'sec_session_id'; // Imposta un nome di sessione
	$secure = true; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
	$httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
	ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
	$cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
	session_start(); // Avvia la sessione php.
	session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function login($email, $password, $mysqli) {
	// Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
	if ($stmt = $mysqli->prepare("SELECT email, password, salt FROM utenti WHERE email = ? LIMIT 1")) {
		$stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
		$stmt->execute(); // esegue la query appena creata.
		$stmt->store_result();
		$stmt->bind_result($username, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
		$stmt->fetch();
		$password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
		if($stmt->num_rows == 1) { // se l'utente esiste

				if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
					// Password corretta!
					$user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

					$_SESSION['email'] = $email;
					$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
					// Login eseguito con successo.
					return true;
				} else {
					echo "la password è sbagliata";
					// Password incorretta.
					// Registriamo il tentativo fallito nel database.

					return false;
				}
			//}
		} else {
			// L'utente inserito non esiste.
			echo "l'utente non esiste $email";
			return false;
		}
	}
}


function login_check() {
	global $mysqli;
	//Verifica che tutte le variabili di sessione siano impostate correttamente
	if (isset($_SESSION['email'], $_SESSION['login_string'])) {
		$email = $_SESSION['email'];
		$login_string = $_SESSION['login_string'];
		$user_browser = $_SERVER['HTTP_USER_AGENT']; //Reperisce la stringa 'user-agent' dell'utente.
		if ($stmt = $mysqli->prepare("SELECT password FROM utenti WHERE email = ? LIMIT 1")) {
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->num_rows == 1) {
				$stmt->bind_result($password);
				$stmt->fetch();
				$login_check = hash('sha512', $password . $user_browser);
				if ($login_check == $login_string) {
					return true;
				}
			}
		}
	}
}

function is_admin() {
		if (strcmp($_SESSION['email'],"admin@piotto.it") == 0) {
				return true;
		}
		else{
			return false;
		}

}

/*
function random_string($length) {
return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )), 1, $length);
}

function logout() {
//Elimina tutti i valori della sessione.
$_SESSION = array();
//Recupera i parametri di sessione.
$params = session_get_cookie_params();
//Cancella i cookie attuali.
setcookie(session_name() , '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
//Cancella la sessione.
session_destroy();
header('Location: ../index.php');
}*/
?>
