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

    if (!($stmt = $mysqli->prepare("SELECT r.title, r.category, r.created_by, r.nr_person, r.process, i.ingredient FROM recipe r NATURAL JOIN ingredient i WHERE r.r_id = ? "))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("i", $r_id)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

	$stmt->bind_result($title, $category, $created_by, $nr_person, $process, $ingredient)or die("Unable to bind result: " . $stmt->error);
    $stmt->fetch();
	
	//Print for the recipe: title, category, creator, nr_person it is for 
	echo '<div class="whole_recipe"><h2>'.$title. '</h2><div >';
	echo '<img class="image_recipe" src="./../recepies/images_recipes/'.$r_id.'.png"alt="">';
	echo '<table><tr><td><b>Category:</b></td><td>' .$category.'</td></tr><tr><td><b>Creator:</b></td><td>'. $created_by. '</td></tr><tr><td><b>For:</b></td><td>'. $nr_person.' Person(s)</td></tr>';
	
	//print first ingredient
	echo '<tr><td><b>Zutaten:</b></td><td>'.$ingredient.'</td></tr>';
	
	$arr = Array();
	while($stmt->fetch()){
	  //print each ingredient
	  echo '<tr><td></td><td>'.$ingredient.'</td></tr>';
	}
	
	//print process of the recipe
	echo '</table><b>Process:</b></br><div class="process">'.$process.'</div></div></div>';


    $mysqli->close();

  }

  ?>