<?php
session_start();


$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
 
 create_db();
 create_table();
 $count = check_email($email);
 if($count == 0){
	 $password = crypt($password, '$5$rounds=5000$sdhfkjicejmfcmoewlkllkldkmfxokewo$');
	 echo $password;
 register_into_db($first_name, $last_name, $email, $password); 
 }
 else{
 echo "email already taken";
 //TODO
 }
 	

function connect_mysql_db(){
$mysqli = new mysqli("localhost", "root", "");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

function connect_mysql_oo() {
    $mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

function create_db(){
	$mysqli = connect_mysql_db();
$sql = "CREATE DATABASE IF NOT EXISTS my_own_cookbook";
$mysqli->query($sql);
$mysqli->close();
}
  
function create_table(){
	
  $mysqli = connect_mysql_oo();
  $sqltabelle = "CREATE TABLE IF NOT EXISTS user ( 
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  first_name VARCHAR(255) NOT NULL , 
  last_name VARCHAR(255) NOT NULL , 
  email VARCHAR(255) NOT NULL , 
  password VARCHAR(255) NOT NULL
  )";
$mysqli->query($sqltabelle);
$mysqli->close();

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

function register_into_db($first_name, $last_name, $email, $password) {
    $mysqli = connect_mysql_oo();
	
	//echo "entered qps" . $email ."<br/>";


    if (!($stmt = $mysqli->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ssss", $first_name, $last_name, $email, $password)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	echo "Sucessfully Registered";
	$_SESSION["email"] = $email;
	//echo "Done PW" .$realpw ."<br/>";
	//header('Location:./../../landing_page/landing_page_after_Login.html'); 
		
    $mysqli->close();
  }
  
?>