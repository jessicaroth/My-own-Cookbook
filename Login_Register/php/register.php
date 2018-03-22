<?php
$pdo = new PDO('mysql:host=localhost;dbname=my_own_cookbook', 'root', '');

$new_user = array();

$new_user["first_name"] = $_POST["first_name"];
$new_user["last_name"] = $_POST["last_name"];
$new_user["email"] = $_POST["email"];
$new_user["password"] = $_POST["password"];
 
 echo "First name: " .$new_user["first_name"] ."<br/>";
 echo "Last name: " .$new_user["last_name"] ."<br/>";
 echo "Email: " .$new_user["email"] ."<br/>";
 echo "PW: " .$new_user["password"];
 
 
//$statement = $pdo->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
//$statement->execute($new_user);   
?>