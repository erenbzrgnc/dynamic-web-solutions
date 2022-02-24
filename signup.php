<?php
require ('resources/db/mysqli.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// pobri�emo morebitne dodatne presledke (trim)
	$trimmed = array_map('trim', $_POST);

	// predpostavljamo, da uporabnik ni vnesel veljavnih podatkov
	$username = $usersurname = $p = FALSE;

	$email = mysqli_real_escape_string ($dbc, $trimmed['mail']);

	/*// preverjanje imena
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	}

	else {
		echo '<p class="error">Please enter your first name!</p>';
	}

	// preverjanje priimeka
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	}
	else {
		echo '<p class="error">Please enter your last name!</p>';
	}*/
	// pretvorba izbire jezika

	// preverjanje uporabni�kega imena
	if (preg_match ('/^[A-Z \'.-]{4,20}$/i', $trimmed['name'])) {
		$username = mysqli_real_escape_string ($dbc, $trimmed['name']);
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Please enter a valid name!</div>';
	}


    if (preg_match ('/^[A-Z \'.-]{4,20}$/i', $trimmed['surname'])) {
		$usersurname = mysqli_real_escape_string ($dbc, $trimmed['surname']);
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Please enter a valid surname!</div>';
	}

	// preverjanje gesla
	// preverimo tudi ali se gesli, ki jih je uporabnik 2x vpisal ujemata
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		}
		else {
			echo '<div class="alert alert-danger" role="alert">Your password did not match the confirmed password!</div>';
		}
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Please enter a valid password!</div>';
	}

	// �e so vsaj osnovni zahtevani podatki ok, lahko nadaljujemo
	if ($username && $p && $usersurname) {

		// pogledamo ali uporabni�ko ime ni �e zasedeno
		$q = "SELECT id FROM user WHERE mail='$email'";
		if(!$q)
			echo '<h3>ojoj :(!</h3>';

		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		// uporabni�ki ime je na voljo
		if (mysqli_num_rows($r) == 0) {

			// vstavimo podatke v PB
			$q = "INSERT INTO user (id,mail, password, name, surname) VALUES (default,'$email', SHA1('$p'), '$username', '$usersurname')";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			// �e je vnos uspel
			if (mysqli_affected_rows($dbc) == 1) {

				echo '<div class="alert alert-success" role="alert">Thank you for registering!</div>';
				echo 'Please log-in using this <a href = "index.php"> link </a> <br/> ';
			
				exit();

			}
			// �e je pri�lo do napake
			else {
				echo '<div class="alert alert-danger" role="alert">You could not be registered due to a system error. We apologize for any inconvenience.</div>';
			}

		}
		// uporabni�ki ime je �e zasedeno
		else {
			echo '<div class="alert alert-danger" role="alert">That email has already been registered.</div>';
		}

	}
	// �e ne izpi�emo opozorilo
	else {
		echo '<div class="alert alert-danger" role="alert">Please try again.</div>';
	}

	mysqli_close($dbc);

}
?>