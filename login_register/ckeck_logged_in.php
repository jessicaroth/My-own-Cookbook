<?php
echo "else";
if ($_SESSION['email'])
    {
      header('Location:./../landing_page/landing_page.html'); 
	}
	else{
	echo "Stuff";
	}
	
?>