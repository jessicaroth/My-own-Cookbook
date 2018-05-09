<?php
session_start();

if (isset($_GET)) {
	$email = $_POST["email"];
    $entered_password = $_POST["password"];
    $_SESSION["email"] = $email;
	create_db();
	
	echo $email ."<br/>";
    $realpw = query_prepared_statement($email);
	echo "Passwort: ".$realpw."<br/>";
	$entered_password = $_POST["password"];
	echo "Entered Passwort:" . $entered_password ."<br/>";
	check_pw($entered_password, $realpw);
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
  
  function query_prepared_statement($email) {
    $mysqli = connect_mysql_oo();
	
	//echo "entered qps" . $email ."<br/>";
	
	$mysqli = connect_mysql_oo();


    if (!($stmt = $mysqli->prepare("SELECT password FROM user WHERE email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("s", $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	$stmt->bind_result($password);
    $stmt->fetch();
	$realpw = $password;
	//echo "Done PW" .$realpw ."<br/>";
	return $realpw;
		
    $mysqli->close();
  }

	function check_pw($entered_password, $realpw){
		
	$entered_password = crypt($entered_password, '$5$rounds=5000$sdhfkjicejmfcmoewlkllkldkmfxokewo$');
	  if(hash_equals($realpw, $entered_password)){
		  
		  header('Location:./../../landing_page/landing_page_after_Login.php');
	  }
	  else{
		  header('Location:./../../login_register/login_register.html');
		  echo "You might want to try this again";
	  }
	}
	  
?>

