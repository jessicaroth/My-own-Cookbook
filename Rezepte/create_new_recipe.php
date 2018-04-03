<?php
  /***  MYSQL Connection ***/
  
  $arr = $_POST;	
if (isset($arr)) {
	$keys = array_keys($arr);
	print "<h1> &Uuml;bergebene Formulardaten:</h1>\n";
	//print '<table border="1">' . "\n  <tr>\n    <th>Name</th>\n    <th>Wert</th>\n  <tr>";
	foreach ($keys as $key) {
		$value = $arr[$key];
		switch ($key) {
    case "name_recipe":
        echo "Title: " .$value . "<br/>";
		//$title = $value;
        break;
    case "category":
        echo "Kategorie: " .$value . "<br/>";
		//$category = $category;
        break;
    case "process":
        echo "Ablauf: " .$value . "<br/>";
		//$process = $value;
        break;
	case "number_person":
        echo "Anzahl Personen: " .$value . "<br/>";
		//$nr_person = $value;
        break;	
	default :
	    // also eine Zutat
		echo "Zutat:" .$value . " " . "<br/>";
		break;
        }
	}

	create_table();
	check_recipe_exists($title, $email);
	recipe_into_db($title, $category, $created_by, $nr_person, $process);
	$r_id = get_r_id($title, $email);
	//hier vllt noch mal überlegen, ob r_id ein guter PK ist oder nicht doch lieber email + title
	grant_access($r_id, $email);
	
	
	
	//TO DO: Ingredients
	
} else {
	print "<h1>Keine Formulardaten übergeben!!<h1>";
}
  

  function connect_mysql_oo() {
    $mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
  }

  
function create_table(){
	
$mysqli = connect_mysql_oo();
  $sqltable_ingredient = "CREATE TABLE IF NOT EXISTS recipe ( 
  r_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  title VARCHAR(255) NOT NULL ,
  category VARCHAR(255) NOT NULL ,
  created_by VARCHAR(255) NOT NULL ,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  nr_person VARCHAR(255) NOT NULL ,
  process VARCHAR(8191) NOT NULL
  )";
$mysqli->query($sqltable_ingredient);

  $sqltable_access = "CREATE TABLE IF NOT EXISTS access ( 
  r_id INT UNSIGNED NOT NULL, 
  email VARCHAR(255) NOT NULL,
  PRIMARY KEY ('r_id','email'))
  )";
  
  //hier noch mal nach dem key schauen
$mysqli->query($sqltable_access);

$mysqli->close();

}
	
function check_recipe_exists($title, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT COUNT(email) FROM user WHERE title = ? AND email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $title, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	$stmt->bind_result($count);
    $stmt->fetch();
	//echo "Done PW" .$realpw ."<br/>";
	return $count;
	
    $mysqli->close();
  }
	
function recipe_into_db($title, $category, $created_by, $nr_person, $process) {
    $mysqli = connect_mysql_oo();
	
	//echo "entered qps" . $email ."<br/>";


    if (!($stmt = $mysqli->prepare("INSERT INTO user (title, category, created_by, nr_person, process) VALUES (?, ?, ?, ?, ?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("sssss", $title, $category, $created_by, $nr_person, $process)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	echo "Sucessfully Submitted Recipe";
		
    $mysqli->close();
	
  }

function get_r_id($title, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT r_id FROM user WHERE title = ? AND email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $title, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	$stmt->bind_result($r_id);
    $stmt->fetch();
	//echo "Done PW" .$realpw ."<br/>";
	return $r_id;
	
    $mysqli->close();
  }  
  
function grant_access($r_id, $email) {
    $mysqli = connect_mysql_oo();
	
	
    if (!($stmt = $mysqli->prepare("INSERT INTO access (r_id, email) VALUES (?, ?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $r_id, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	echo "Sucessfully granted access";
		
    $mysqli->close();
	
  }

?>