<?php
session_start();

  $email = $_POST["email"];
  $entered_password = $_POST["password"];
  $_SESSION["email"] = $email;
  
  //Create database "my-own-cookbook" if not existant
  create_db();
  
  //Create all tables if not existant
  create_table();
	
  echo $email ."<br/>";
  
  //Get password associated with entered email
  $realpw = query_prepared_statement($email);
  echo "Passwort: ".$realpw."<br/>";
  echo "Entered Passwort:" . $entered_password ."<br/>";
  
  //Check if entered password and password associated with entered email are the same
  check_pw($entered_password, $realpw);

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
  
  //user information is stored in theis table
  //data which is stored: first name, last name, email, password(encrypted)
  $sqltabelle = "CREATE TABLE IF NOT EXISTS user ( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    first_name VARCHAR(255) NOT NULL , 
    last_name VARCHAR(255) NOT NULL , 
    email VARCHAR(255) NOT NULL , 
    password VARCHAR(255) NOT NULL
    )";
  $mysqli->query($sqltabelle);

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

$mysqli->close();;
  }
  
  function query_prepared_statement($email) {
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
	return $realpw;
		
    $mysqli->close();
  }

  function check_pw($entered_password, $realpw){
		
	$entered_password = crypt($entered_password, '$5$rounds=5000$sdhfkjicejmfcmoewlkllkldkmfxokewo$');
	if(hash_equals($realpw, $entered_password)){
	  //echo "Right password";
	  //Redirect to start page when logged in
      header('Location:./../../landing_page/landing_page_after_Login.php');
	}
	else{
      //echo "You might want to try this again";
	  //Redirect to Login_Register page
	  header('Location:./../../login_register/login_register.html');
    }
  }
	  
?>

