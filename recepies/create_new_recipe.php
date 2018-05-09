<?php
session_start();
	if(isset($_SESSION["email"])) {
	?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Rezepte</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../landing_page/landing_page.css" rel="stylesheet" type="text/css">
    <link href="../landing_page/slidebar.css" rel="stylesheet" type="text/css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../landing_page/slidebar.js"></script>
    <script src="ingredient.js"></script>
</head>

<body class="cookbook">
<header>
    <button class="button"><a href="../landing_page/landing_page.html" style="text-decoration: none">
        <div class="pattern">
            <div class="target inner bg1"></div>
        </div>
        <div class="text">Log Out</div>
    </a>
    </button>
</header>

<article>
    <h1 align="center">Adding a new recipe</h1>
    <p>
        <form action="create_a_new_recipe.php" method="post">

    <p><label>
        Name<span class="req">*</span>
    </label>
        <input name="name_recipe" type="text" size="50" maxlength="50" value="">
    </p>
    <p>
    <label>
        Category<span class="req">*</span>
    </label>
    <select name="category" size="1">
        <option>drinks</option>
        <option>appetizers</option>
        <option>main courses</option>
        <option>dessert</option>
        <option>snacks</option>
        <option>miscellaneous</option>
    </select>
    </p>
    <p>
    Für <input name="number_person" size="1" maxlength="3"> Person(en)
    </p>

    <!--Hier muss ich mir noch was überlegen, wie ich die Zutaten schön darstelle-->
    <div name="ingredients" id="ingredients">
        <label>
            Ingredients<span class="req">*</span>
        </label>
        <!--<textarea cols="100" rows="20"></textarea> -->
        <!--<input name="measure_0" size="3" maxlength="6">-->
        <input name="ingredient_0" type="text" size="20" maxlength="30">
        <br/>
    </div>
    <br/>
    <input class="smallbutton" type="button" name="add_ingredient" value="Füge Zutat hinzu" onclick="addFields()">

    <p><label>
        Ablauf<span class="req">*</span>
    </label></p>
    <textarea cols="100" rows="10" name="process"></textarea>

    <br/><br/>
    <input class="smallbutton" type="submit" value="Saving">
    </form>

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


<script>
    //hier am besten noch eine bessere Variante finden, um eine globale Variable zu definieren
    var id = 0;
</script>

</html>

<?php
}else 
header('Location:./../landing_page/landing_page.html');

?>