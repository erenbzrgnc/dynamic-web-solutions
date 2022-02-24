<?php 

session_start();

require ('resources/db/mysqli.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// preverjamo vnos uporabniškega imena
	if (!empty($_POST['mail'])) {
		$m = mysqli_real_escape_string ($dbc, $_POST['mail']);
	}
	else {
		$m = FALSE;
		echo '<div class="alert alert-danger" role="alert">You forgot to enter your email!</div>';
	}

	// preverjamo vnos gesla
	if (!empty($_POST['password'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['password']);
	}
	else {
		$p = FALSE;
		echo '<div class="alert alert-danger" role="alert">You forgot to enter your password!</div>';
	}


	// če je uporabnik vnesel oboje
	if ($m && $p) {

		// izvedemo povpraševanje v PB
		$q = "SELECT mail, password, id FROM user WHERE (mail='$m' AND password=SHA1('$p'))";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		// če obstaja tak uporabnik
		if (@mysqli_num_rows($r) == 1) {

			// njegove podatke shranimo v sejo

			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC);
			
			//$_SESSION[user_id] = 2; 2 = uporabnik en ima id = 2
			//$_SESSION[land_id] = 1; 1 = angleščina
			//$_SESSION[username] = 'en'; uporabniško ime je "en"
			
			mysqli_free_result($r);
			mysqli_close($dbc);

			// preusmeritev na osnovno spletno stran
			$url = 'events.php';

			header("Location: $url");
			exit();

		}
		//uproabnik ni bil uspešno overjen
		else {
			echo '<div class="alert alert-danger" role="alert">The entered mail and/or password are incorrect!</div>';
		}

	}

	// če prijava ni bila ok
	else {
		echo '<div class="alert alert-danger" role="alert">Please try again.</div>';
	}

	mysqli_close($dbc);

}
?>

