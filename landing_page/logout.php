<?php
session_start();
session_destroy();
$_SESSION = array();

header('Location:./../landing_page/landing_page.html');
?>