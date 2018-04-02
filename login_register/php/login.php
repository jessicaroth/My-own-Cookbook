<?php


$conn = new mysqli('localhost', 'root', '', 'my_own_cookbook');
  if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  else {
      echo "DB exists";

      $email = $_POST["email"];
	  $entered_password = $_POST["password"];
	  $realpw = "";
		
		$statement = $conn->prepare("SELECT password FROM user WHERE email = ?");
		$statement->bind_param("s", $email);
		/* execute query */
		$statement->execute();
        $statement->bind_result($password);
        $statement->fetch();
		$realpw = $password;
		
	echo "Passwort: ".$realpw."<br/>";
	echo "Entered Passwort:" . $entered_password ."<br/>";
	
	  
	  if($realpw == $entered_password){
		  echo "Sucessfully Logged in";
		  //hier natürlich die richtige Seite einfügen
		  //header('Location:https://www.ibm.com/de-de/');
		  
	  }
	  else{
		  echo "You might want to try this again";
	  }
	  
  }
?>

