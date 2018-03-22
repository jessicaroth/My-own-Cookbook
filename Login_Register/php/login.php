<?php
 
      $pdo = new PDO('mysql:host=localhost;dbname=my_own_cookbook', 'root', '');

      $email = $_POST["email"];
	  $entered_password = $_POST["password"];
	  $realpw = "";

      $statement = $pdo->prepare("SELECT password FROM user WHERE email = :email");
      $statement->execute(array('email' => $email));   

	  
	  // vielleicht hier noch überprüfen, ob es nur ein Passwort gibt
        while($row = $statement->fetch()) {
		  $realpw = $row['password']; 
          echo "Passwort: ".$realpw."<br/>";
		  echo "Entered Passwort:" . $entered_password ."<br/>";
        }
	  
	  if($realpw = $entered_password){
		  echo "Sucessfully Logged in";
	  }
	  else{
		  echo "You might want to try this again";
	  }
?>

