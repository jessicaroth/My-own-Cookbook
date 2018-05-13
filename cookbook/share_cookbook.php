<?php
session_start();

if (isset($_POST)) {
	$email = $_POST["email"];
	


	$email_submitter = $_SESSION["email"]; 
	$category = $_POST["category"];
	
	//echo $category;
	
	if($category == "whole cookbook"){
	    $category = '%';
	}
	//echo $category;
	
	$count = check_email($email);
	if ($count == 1){
	$recipes = get_r_id($category, $email_submitter, $email);
	}
	else{
	//echo "Email doesnt exist";
	}
	
	header('Location: .\share_my_cookbook.php');
	//echo "<script type='text/javascript'>alert('Test');</script>";
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
	

function get_r_id($category, $email_submitter, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("SELECT r_id FROM recipe WHERE category LIKE ? AND created_by = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $category, $email_submitter)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	$stmt->bind_result($r_id);
	
	while($stmt->fetch()){
		//array_push($arr, [$title, $category]);
	    grant_access($r_id, $email);
	}
	
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
	
	//echo "Sucessfully granted access";
		
    $mysqli->close();
	
  }

  
?>