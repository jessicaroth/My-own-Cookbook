<?php
session_start();
	if(isset($_SESSION["email"])) {
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cookbook</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../landing_page/landing_page.css" rel="stylesheet" type="text/css">
    <link href="../landing_page/slidebar.css" rel="stylesheet" type="text/css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../landing_page/slidebar.js"></script>
</head>
<body class="cookbook">
<header>
    <button class="button"><a href="../landing_page/logout.php" style="text-decoration: none">
        <div class="pattern">
            <div class="target inner bg1"></div>
        </div>
        <div class="text">Log Out</div></a>
    </button>
</header>

<article>
    <h1 align="center">My Cookbook</h1>
    <p>This cookbook is seperated in the following chapters: <br>
        <b><ul>
    <li><a href="drinks.php">Drinks</a></li>
    <li><a href="appetizers.php">Appetizers</a></li>
    <li><a href="main_courses.php">Main Courses</a></li>
    <li><a href="dessert.php">Dessert</a></li>
    <li> <a href="snacks.php">Snacks</a></li>
    <li> <a href="miscellaneous.php">Miscellanous</a></li>
        </ul></b>
        <!--
        Die Rezepte können unter diesen Kategorien erstellt und mit Freunden geteilt werden. Wenn du dein ganzes
        Rezeptbuch mit deinen Freunden teilen möchtest, dann klicke auf den folgenden Button. <br>
       -->
        Recipes can be created under these categories and shared with friends. If you want to share your whole
        recipe book with your friends, then click on the following button. <br>
        <br>
        <button class="button" style="margin-left: 70%"><a href="share_my_cookbook.php" style="text-decoration: none"  >
            <div class="pattern">
                <div class="target inner bg1"></div>
            </div>
            <div class="text">Share with friends</div></a>
        </button>
        <br>
        <br>
        <!--
        Deine gesamten Rezepte kannst du <a class="link" href="#"> hier</a> anschauen!
        -->
        <!--You can find all your recipes <a class="link" href="#"> here</a> .-->
    </p>
</article>

<div id="sidebar">

    <ul class="liste">
        <li class="listenelement"><a class="listenlink" href="../user_profil/my_profil.php">My Profile</a></li>
        <li class="listenelement"><a class="listenlink" href="../cookbook/my_cookbook.php">My Cookbook</a></li>
        <ul>
            <li class="listenelement"><a class="listenlink2" href="../cookbook/drinks.php">Drinks</a></li>
            <li class="listenelement"><a class="listenlink2" href="../cookbook/appetizers.php">Appetizers</a></li>
            <li class="listenelement"><a class="listenlink2" href="../cookbook/main_courses.php">Main Courses</a></li>
            <li class="listenelement"><a class="listenlink2" href="../cookbook/dessert.php">Dessert</a></li>
            <li class="listenelement"><a class="listenlink2" href="../cookbook/snacks.php">Snacks</a></li>
            <li class="listenelement"><a class="listenlink2" href="../cookbook/miscellaneous.php">Miscellaneous</a></li>
        </ul>
        <li class="listenelement">
            <a class="listenlink" href="../cookbook/share_my_cookbook.php">Share my cookbook</a>
        </li>
        <li class="listenelement"><a class="listenlink" href="./../landing_page/logout.php">Logout</a></li>
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