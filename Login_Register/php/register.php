<?php
$pdo = new PDO('mysql:host=localhost;dbname=cookbookdb', 'root', '');

$neuer_user = array();

//hier dann eben entsprechend den Inhalt aus den Feldern ziehen

$neuer_user['first_name'] = 'MArcel';	
$neuer_user['last_name'] = 'Vidas';
$neuer_user['email'] = 'info@php-einfach.de';
$neuer_user['password'] = 'fdnjkfjnaslk';
 
$statement = $pdo->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
$statement->execute($neuer_user);   
?>