<?php
session_start();

//Session variables are invalidated
$_SESSION = array();
session_destroy();



//Redirect to start page
header('Location:./../landing_page/landing_page.html');
?>