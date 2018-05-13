<?php
session_start();

  $category = $_POST['category'];
  $email = $_SESSION["email"];

  //Get all recipes the user has access to and which belong to the chosen category
  get_recipes($category, $email);

  
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

	//table "access" shows which user may see which recipe, r_id is a foreign key
	//table "recipe" stores the general information like the title and category of the recipes, r_id is the primary key
    if (!($stmt = $mysqli->prepare("SELECT r.r_id, r.title, r.category FROM recipe r INNER JOIN access a ON r.r_id = a.r_id WHERE r.category = ? AND a.email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $category, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	$stmt->bind_result($r_id, $title, $category) or die("Unable to bind result: " . $stmt->error);
    
	while($stmt->fetch()){
	  //each recipe is printed, so the user can click on them, to display the whole recipe
	  print '<div class="recipe_name" onclick = showRecipe("'.$r_id.'");>'. $title .'</div></br>';
	}

    $mysqli->close();
  }  
?>