<?php

//Hier noch schauen, wie das mit AJAX funktioniert
$category;
$email;

get_recipes($category, $email);
//hier kommt ein Array raus
//das dann evtl aufbereiten und zurück -> Ausgabe

  
  function connect_mysql_oo() {
    $mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
  }
  
  
  function get_recipes($category, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT * FROM user WHERE category = ? AND email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $category, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	//hier noch mal schauen, was dann im arr landet
	$stmt->bind_result(*);
    $stmt->fetch();
	$arr = Array();
    while ($row = $stmt->fetch_array($t)) {
      array_push($arr, $row);
    }
	
	return $arr;
	//hier bin ich mir noch nicht so sicher, ob das klappt -> Recherche
	
    $mysqli->close();
  }  
  
?>