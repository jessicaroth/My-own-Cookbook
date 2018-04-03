<?php
  /***  MYSQL Connection ***/
  

if (isset($_GET)) {
	$email = $_POST["email"];
	$email_submitter; //wie komme ich da ran?
	
	check_email($email);
	$recipes = get_r_id($email_submitter);
	//hier noch eine foreach-Schleife
	grant_access($r_id, $email);
}
  

  function connect_mysql_oo() {
    $mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
  }

function check_email($email) {
    $mysqli = connect_mysql_oo();
	
	//echo "entered qps" . $email ."<br/>";


    if (!($stmt = $mysqli->prepare("SELECT COUNT(email) FROM user WHERE email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("s", $email)) {
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
	

  
function get_r_id($email_submitter) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT r_id FROM user WHERE email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("s", $email_submitter)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	$stmt->bind_result($r_id);
    $stmt->fetch();
	$arr = Array();
    while ($row = $stmt->fetch_array($t)) {
      array_push($arr, $row);
    }
	
	return $arr;
	//hier bin ich mir noch nicht so sicher, ob das klappt -> Recherche
	
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