<?php
session_start();

$email = $_SESSION["email"];
$edit = $_POST["edit"];

show_profil($email, $edit);

function connect_mysql_oo() {
	$mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
  return $mysqli;
}

function show_profil($email, $edit) {
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
    if ($edit == 'false'){
		echo '<div><table><tr><td><b>First Name:</b></td><td>' .$first_name.'</td></tr><tr><td><b>Last Name:</b></td><td>'. $last_name. '</td></tr><tr><td><b>Email:</b></td><td>'. $email.'</td></tr></table></div>';
	}
	else{
		echo '<form action="edit_profile.php" method="post"><div><table></tr><tr><td><b>Email:</b></td><td>'. $email.'</td></tr><tr><td><b>First Name:</b></td><td><input type="text" name ="first_name" required value="' .$first_name.'"/></td></tr><tr><td><b>Last Name:</b></td><td><input type="text" name="last_name" required value="'. $last_name. '"/></td><tr><td><b>Old Password:</b></td><td><input type="password" name = "oldpw" title="You only have to enter a password, if you want to change it"/></td></tr><tr><td><b>New Password:</b></td><td><input type="password" name = "newpw" title="You only have to enter a password, if you want to change it"/></td></tr></table></div><input class="submit_button_profile_edit" type="submit" value="Submit changes"></form>';
	}
	
    $mysqli->close();

  }

  ?>