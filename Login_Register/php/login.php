<?php
$pdo = new PDO('mysql:host=localhost;dbname=cookbookdb', 'root', '');

//entered_username = feld.innerHTML oder so ähnlich

$sql = "SELECT password FROM user WHERE username = entered_username";	//hier schauen, dass auch der Inhalt der Variable genommen wird

foreach ($pdo->query($sql) as $row) {
   echo $row['username']." ".$row['password']."<br />";
}
?>