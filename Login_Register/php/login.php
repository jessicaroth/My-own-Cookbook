<?php

 if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      $pdo = new PDO('mysql:host=localhost;dbname=my_own_cookbook', 'root', '');

      $email = "keine-ahnung@freenet.de";

      $statement = $pdo->prepare("SELECT password FROM user WHERE email = :email");
      $statement->execute(array('email' => $email));   
      while($row = $statement->fetch()) {
        echo "Passwort: ".$row['password']."<br /><br />";
      }
    }

?>