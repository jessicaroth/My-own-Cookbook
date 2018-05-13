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
<!--Logout button-->
<a href="../landing_page/logout.php" style="text-decoration: none">
    <button class="button">
        <div class="pattern">
            <div class="target inner bg1"></div>
        </div>
        <div class="text">Log Out</div>
    </button>
    </a>
</header>

<article>
    <h1 align="center">Adding a new recipe</h1>
    <p>
        <form action="create_a_new_recipe.php" method="post" enctype="multipart/form-data">
		<table id="create_new_recipe">
		<tr>
		<!--textfields for adding information about recipe-->
    <p><td><label>
        <b>Name<span class="req">*</span></b>
    </label></td>
        <td><input name="name_recipe" type="text" size="50" maxlength="50" value="" required></td>
    </p>
	</tr>
	<tr><p>
	<td><label>
	<!--categories to choose for recipe-->
        <b>Category<span class="req">*</span></b>
    </label>
	</td><td>
    <select name="category" size="1" required>
        <option>drinks</option>
        <option>appetizers</option>
        <option>main courses</option>
        <option>dessert</option>
        <option>snacks</option>
        <option>miscellaneous</option>
    </select></td>
    </p></tr>
    <tr><p>
    <td><b>For <span class="req">*</span></b></td>
	<td><input name="number_person" size="1" maxlength="3" required> Person(s)</td>
    </p></tr>
    <tr><div name="ingredients" id="ingredients">
        <td><label>
            <b>Ingredients<span class="req">*</span></b>
        </label></td>
        <td><input name="ingredient_0" type="text" size="50" maxlength="50" required>
        </td>
    </div></tr>
	</table>
    <br/>
    <!--Submit button for adding ingredients-->
    <input class="smallbutton" type="button" name="add_ingredient" value="Add ingredient" onclick="addFields()">

    <p><label>
        <b>Process<span class="req">*</span></b>
    </label></p>
    <textarea cols="90" rows="10" name="process" required></textarea>

    <br/><br/>
	<label><b>Upload an image (smaller than 1MB)</b></label>
	<br/>
	 <input type="file" name="upfile" accept="image/*">
	
	<br/><br/>
    <!--Submit button-->
    <input class="smallbutton" type="submit" value="Saving">
    </form>

    </p>
</article>
<!--Navigation sidebar-->
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