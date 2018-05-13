<?php
session_start();
	if(isset($_SESSION["email"])) {
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mein Kochbuch</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../landing_page/landing_page.css" rel="stylesheet" type="text/css">
    <link href="../landing_page/slidebar.css" rel="stylesheet" type="text/css">
    <link href="../Login_Register/sass_folder/stylesheets/login_register.css">
    <script src="../Login_Register/login_register.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../landing_page/slidebar.js"></script>
</head>
<body class="cookbook">
<header>
<!--Header with Logout-Button-->
  <a href="../landing_page/logout.php" style="text-decoration: none">
    <button class="button">
        <div class="pattern">
            <div class="target inner bg1"></div>
        </div>
        <div class="text">Log Out</div>
        </button>
    </a>
</header>
<!--Content, shows formular for sharing with friends-->
<article>
    <h1 align="center">Share with friends</h1>
    <p>Here you can share your cookbook or some part of it with your friends. Just enter your email address in the
        field below and select the category.
        <!--textfield for email-->
        <form action="share_cookbook.php" method="post">
            <div class="form">
                <div class="tab-content">
                    <div class="field-wrap">
                        <label>
                            Email address<span class="req">*</span>
                        </label>
                        <input type="email" required autocomplete="off" name="email"/>
                    </div>
                </div>
                <div>
    <p><label>
    <!--which category should be shared-->
        Category:<span class="req">*</span>
    </label>
        <select name="category" size="1" class="req">
            <option>whole cookbook</option>
            <option>drinks</option>
            <option>appetizers</option>
            <option>main courses</option>
            <option>dessert</option>
            <option>snacks</option>
            <option>miscellaneous</option>
        </select>
    </p>
    </div>
    </form>
    <!--submit button-->
    <input type="submit" class="smallbutton" value="Confirm">
</a>
    </input>
    </p>
</article>
<!--Sidebar-->
<div id="sidebar">
    <ul class="liste">
    <!--Sidebar listing elements-->
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