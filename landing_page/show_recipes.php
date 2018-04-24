<?php
session_start();

//Hier noch schauen, wie das mit AJAX funktioniert
$category = $_POST['category'];
$email = $_SESSION["email"];

//echo $category . '<br/>'. $email. '<br/>';
//echo "<b>Hello world!</b>";
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

    if (!($stmt = $mysqli->prepare("SELECT r_id, title, category FROM recipe WHERE category = ? AND created_by = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $category, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	//hier noch mal schauen, was dann im arr landet
	$stmt->bind_result($r_id, $title, $category) or die("Unable to bind result: " . $stmt->error);;
    
	
	//$arr = Array();
	while($stmt->fetch()){
		//array_push($arr, [$title, $category]);
	print '<div class="recipe_name" onclick = showRecipe("'.$r_id.'");>'. $title .'</div></br>';
	}


	//return $arr;
	//hier bin ich mir noch nicht so sicher, ob das klappt -> Recherche
    $mysqli->close();
  }  
  
?>