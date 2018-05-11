<?php
session_start();
	if(isset($_SESSION["email"])) {
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <!--
    <title>Mein eigenes Kochbuch</title>
    -->
    <title>My own cookbook</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link href="landing_page.css" rel="stylesheet" type="text/css">
    <link href="slidebar.css" rel="stylesheet" type="text/css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="slidebar.js"></script>
</head>
<body class="landing_page_login" onload="">
<header>
     <button class="button"><a href="logout.php" style="text-decoration: none">
        <div class="pattern">
            <div class="target inner bg1"></div>
        </div>
        <div class="text">Log Out</div></a>
    </button>
</header>

<article>
    <!--
    <h1 align="center">Willkommen!</h1>
    <p>Viel Spaß beim Bearbeiten oder Erweitern deines persönlichen Kochbuches! <br>
       Nutze die vielfältigen Funktionen und erschaffe eine Welt des Geschmacks und der Vielfalt. Schließe dich mit Freunden und Familie zusammen, um dein Kochbuch Stück für Stück zu erweitern.
    </p>
    -->
	<div id="intro">
    <h1 align="center">Welcome!</h1>
    Have fun editing or expanding your personal cookbook! <br>
    Use the many functions and create a world of taste and variety. Join forces with friends and family to expand your
    cookbook piece by piece.
    </p>
	</div>
</article>

<div id="sidebar">

    <ul class="liste">
        <li class="listenelement"><a class="listenlink" href="../user_profil/my_profil.php">My Profile</a></li>
        <li class="listenelement"><a class="listenlink" href="../cookbook/my_cookbook.php">My Cookbook</a></li>
            <ul>
                <li class="listenelement"><a class="listenlink2" href="../cookbook/drinks.php">Drinks</a></li>
				<li class="listenelement"><a class="listenlink2" href="../cookbook/appetizers.php">Appetizers.html</a></li>
				<li class="listenelement"><a class="listenlink2" href="../cookbook/main_courses.php">Main Courses</a></li>
				<li class="listenelement"><a class="listenlink2" href="../cookbook/dessert.php">Dessert</a></li>
				<li class="listenelement"><a class="listenlink2" href="../cookbook/snacks.php">Snacks</a></li>
				<li class="listenelement"><a class="listenlink2" href="../cookbook/miscellaneous.php">Miscellaneous</a></li>
            </ul>
        <li class="listenelement">
            <a class="listenlink" href="../cookbook/share_my_cookbook.php">Share my cookbook</a>
        </li>
        <li class="listenelement"><a class="listenlink" href="logout.php">Logout</a></li>
    </ul>

    <div id="sidebar-btn">
        <span></span>
        <span></span>
        <span></span>
    </div>

</div>

</body>
</html>


<?php
}else 
header('Location:./../landing_page/landing_page.html');

?>