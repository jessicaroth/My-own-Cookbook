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

    if (!($stmt = $mysqli->prepare("SELECT r.title, r.category, r.created_by, r.nr_person, r.process, i.ingredient FROM recipe r NATURAL JOIN ingredient i WHERE r.r_id = ? "))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("i", $r_id)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

	//header('Location:);
	$stmt->bind_result($title, $category, $created_by, $nr_person, $process, $ingredient)or die("Unable to bind result: " . $stmt->error);
    $stmt->fetch();
	
	echo '<div><h2>'.$title. '</h2><div class="whole_recipe"><table><tr><td><b>Kategorie:</b></td><td>' .$category.'</td></tr><tr><td><b>Ersteller:</b></td><td>'. $created_by. '</td></tr><tr><td><b>Für:</b></td><td>'. $nr_person.' Person(en)</td></tr>';
	
	echo '<tr><td><b>Zutaten:</b></td><td>'.$ingredient.'</td></tr>';
	
	$arr = Array();
	while($stmt->fetch()){
	echo '<tr><td></td><td>'.$ingredient.'</td></tr>';
	}
	
	echo '</table><b>Ablauf:</b></br>'.$process.'</div></div>';

//TODO: schönes Design und schöner hinschreiben

    $mysqli->close();

  }

  ?>