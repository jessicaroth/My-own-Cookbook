<?php
  session_start();

  $email = $_SESSION["email"];
  $arr = $_POST;	
  $arr_ingr = Array();
  
  //match the post data to the variables
  if (isset($arr)) {
	$keys = array_keys($arr);
	echo "<h1> &Uuml;bergebene Formulardaten:</h1>\n";
	foreach ($keys as $key) {
		$value = $arr[$key];
		switch ($key) {
    case "name_recipe":
        echo "Title: " .$value . "<br/>";
		$title = $value;
        break;
    case "category":
        echo "Kategorie: " .$value . "<br/>";
		$category = $value;
        break;
    case "process":
        echo "Ablauf: " .$value . "<br/>";
		$process = $value;
        break;
	case "number_person":
        echo "Anzahl Personen: " .$value . "<br/>";
		$nr_person = $value;
        break;	
	default :
		if($value != ""){
			//Ingredient
			echo "Zutat:" .$value . " " . "<br/>";
			array_push($arr_ingr, $value);
		}
		break;
        }
	}

	print_r($arr_ingr);

	//Create tables "recipe, ingredient, access" if not existant
	create_table();
	
	//Check if there is a recipe with the same name and creator
	$count = check_recipe_exists($title, $email);
	$count = 0;
	if ($count == 0){
	  //store the information in the table "recipe"
	  recipe_into_db($title, $category, $email, $nr_person, $process);
	  
	  //Get the r_id of the just stored recipe
	  $r_id = get_r_id($title, $email);
	  
	  //For each ingredient: Store this ingredient in the table "ingredient"
	  $size_arr_ingr = count( $arr_ingr );
	  for($i = 0; $i < $size_arr_ingr; $i ++){
		$ingredient = $arr_ingr[$i];
		ingredient_into_db($r_id, $ingredient);
		echo $arr_ingr[$i].'<br/>';
	  }
	
	  //Store the creator and the recipe_id in the table "access", so the creator can access his created recipe
	  grant_access($r_id, $email);
	  echo "Rezept gespeichert";
	}
	else{
	  echo "Rezept gibts schon";
	}
		
  } 
  else {
	print "<h1>Keine Formulardaten übergeben!!<h1>";
  }
  
  header('Location:./../landing_page/landing_page_after_Login.php'); 
  
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
	
	//Recipes are stored in this table
	//Post data that is stored: title, category, creator, nr_person for which the recipe is for
	//r_id is the primary key and is used as a foreign key in "ingredient" and "access"
    $sqltable_recipe = "CREATE TABLE IF NOT EXISTS recipe ( 
      r_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
      title VARCHAR(255) NOT NULL ,
      category VARCHAR(255) NOT NULL ,
      created_by VARCHAR(255) NOT NULL ,
      created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
      nr_person VARCHAR(255) NOT NULL ,
      process VARCHAR(8191) NOT NULL
      )";
    $mysqli->query($sqltable_recipe);

	//The ingredients are stored in this seperate table with their recipe_id
    $sqltable_ingredient = "CREATE TABLE IF NOT EXISTS ingredient ( 
      r_id INT UNSIGNED NOT NULL, 
      ingredient VARCHAR(255) NOT NULL,
      PRIMARY KEY (r_id,ingredient)
      )";  
    $mysqli->query($sqltable_ingredient);

	//Access stores which users may access which recipe
    $sqltable_access = "CREATE TABLE IF NOT EXISTS access ( 
      r_id INT UNSIGNED NOT NULL, 
      email VARCHAR(255) NOT NULL,
      PRIMARY KEY (r_id,email)
      )"; 
    $mysqli->query($sqltable_access);

    $mysqli->close();

}
	
  function check_recipe_exists($title, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT COUNT(title) FROM recipe WHERE title = ? AND created_by = ?"))) {
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

    if (!($stmt = $mysqli->prepare("INSERT INTO recipe (title, category, created_by, nr_person, process) VALUES (?, ?, ?, ?, ?)"))) {
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

  function ingredient_into_db($r_id, $ingredient){
	
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("INSERT INTO ingredient (r_id, ingredient) VALUES (?, ?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("is", $r_id, $ingredient)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	echo "Sucessfully Submitted Ingredient" . $ingredient. "<br/>";
		
    $mysqli->close();

}
  
  function get_r_id($title, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT r_id FROM recipe	WHERE title = ? AND created_by = ?"))) {
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