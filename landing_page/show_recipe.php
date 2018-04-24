<?php
session_start();

$r_id = $_POST['r_id'];

//echo 'r_id: '. $r_id . '</br>';
show_recipe($r_id);


function connect_mysql_oo() {
	$mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
  return $mysqli;
}

function show_recipe($r_id) {
    $mysqli = connect_mysql_oo();

	//"SELECT title FROM recipe r, ingredient i WHERE r_id = ? JOIN r.r_id = i.r_id"

    if (!($stmt = $mysqli->prepare("SELECT title, category, created_by, nr_person, process FROM recipe WHERE r_id = ? "))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("i", $r_id)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

	//header('Location:);
	$stmt->bind_result($title, $category, $created_by, $nr_person, $process);
    $stmt->fetch();

//TODO: schönes Design und schöner hinschreiben
	echo '<div><h2>'.$title. '</h2><table><tr><td>Kategorie:</td><td>' .$category.'</td></tr><tr><td>Ersteller:</td><td>'. $created_by. '</td></tr><tr><td>Für:</td><td>'. $nr_person.' Person(en)</td></tr></table>'. $process.'</table></div>';

    $mysqli->close();

  }

  ?>