<?php


// Create connection
$conn = new mysqli('localhost', 'root', '');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully" ."<br/>";

//Create data base if not exists
$sql = "CREATE DATABASE IF NOT EXISTS my_own_cookbook";		//hier kommt mal my_own_cookbook hin
$conn->query($sql);
$conn->close();

//Create table if not exists
$conn = new mysqli('localhost', 'root', '', 'my_own_cookbook');
  $sqltabelle = "CREATE TABLE IF NOT EXISTS user ( 
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  first_name VARCHAR(255) NOT NULL , 
  last_name VARCHAR(255) NOT NULL , 
  email VARCHAR(255) NOT NULL , 
  password VARCHAR(255) NOT NULL
  )";
$conn->query($sqltabelle);


//$pdo = new PDO('mysql:host=localhost;dbname=my_own_cookbook', 'root', '');		//hier auch my_own_cookbook

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
 
 //echo "First name: " .$first_name ."<br/>";
 //echo "Last name: " .$last_name ."<br/>";
 //echo "Email: " .$email ."<br/>";
 //echo "PW: " .$password;
 
//check if email exists
        $statement = $conn->prepare("SELECT COUNT(email) FROM user WHERE email = ?");
		$statement->bind_param("s", $email);
		/* execute query */
		$statement->execute();
        $statement->bind_result($count);
        $statement->fetch();
		$statement->close();
		
		echo $count."<br/>";
		if($count == 0){
			$statement = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
			$statement->bind_param("ssss", $first_name, $last_name, $email, $password);   
			$statement->execute();
			echo "Sucessfully Logged in";
			//hier natürlich die richtige Seite einfügen
			//header('Location:https://www.ibm.com/de-de/');
			$statement->close();
		}
		else{
		//Email already taken
		}
		
  $conn->close();
		  
?>