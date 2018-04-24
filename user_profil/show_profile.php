<?php
session_start();

$email = $_SESSION["email"];

show_profil($email);

function connect_mysql_oo() {
	$mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
  return $mysqli;
}

function show_profil($email) {
    $mysqli = connect_mysql_oo();


    if (!($stmt = $mysqli->prepare("SELECT first_name, last_name, email FROM user WHERE email = ? "))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("s", $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

	$stmt->bind_result($first_name, $last_name, $email);
    $stmt->fetch();

//TODO: schönes Design und schöner hinschreiben
	echo '<div><table><tr><td>Vorname:</td><td>' .$first_name.'</td></tr><tr><td>Nachname:</td><td>'. $last_name. '</td></tr><tr><td>Email:</td><td>'. $email.'</td></tr></table></div>';

    $mysqli->close();

  }

  ?>