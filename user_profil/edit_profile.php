<?php
session_start();

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_SESSION["email"];
$oldpw = $_POST["oldpw"];
$newpw = $_POST["newpw"];

echo $first_name. "</br>". $last_name."</br>". $email."</br>". $oldpw."</br>". $newpw;

edit_profile($first_name, $last_name, $email);

if (trim($newpw) != ''){
echo "not empty";
check_pw ($email,$oldpw, $newpw);
}
header('Location:.\my_profil.php'); 


function connect_mysql_oo() {
	$mysqli = new mysqli("localhost", "root", "", "my_own_cookbook");
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
  return $mysqli;
}

function edit_profile($first_name, $last_name, $email) {
    $mysqli = connect_mysql_oo();

    if (!($stmt = $mysqli->prepare("UPDATE user SET first_name = ?, last_name = ? WHERE email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("sss", $first_name, $last_name, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	echo "Sucessfully Changed";
	//header('Location:./../../landing_page/landing_page_after_Login.php'); 
		
    $mysqli->close();
  }

  function check_pw($email, $oldpw, $newpw) {
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
	
	$oldpw = crypt($oldpw, '$5$rounds=5000$sdhfkjicejmfcmoewlkllkldkmfxokewo$');
	  if(hash_equals($realpw, $oldpw)){
		  edit_pw($email, $newpw);
	  }
	  else{
		  //pw false
		  //return error oder so
	  }
		
    $mysqli->close();
  }
   
function edit_pw($email, $newpw) {
    $mysqli = connect_mysql_oo();
	
	$newpw = crypt($newpw, '$5$rounds=5000$sdhfkjicejmfcmoewlkllkldkmfxokewo$');

    if (!($stmt = $mysqli->prepare("UPDATE user SET password = ? WHERE email = ?"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param("ss", $newpw, $email)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
	
	echo "Sucessfully Changed PW";
	//header('Location:./../../landing_page/landing_page_after_Login.php'); 
		
    $mysqli->close();
  }


?>