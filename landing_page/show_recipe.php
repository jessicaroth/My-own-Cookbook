<?php

$r_id = $_POST['r_id'];

echo 'r_id: '. $r_id;
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

    if (!($stmt = $mysqli->prepare("SELECT title FROM recipe WHERE r_id = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("i", $r_id)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	//header('Location:);
	$stmt->bind_result($title);
    $stmt->fetch();
	
	echo $title;
		
    $mysqli->close();
	
  }  

  ?>