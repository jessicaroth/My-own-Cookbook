
function showRecipes(category) {
	$.post('check_logged_in.php');
	
	$.post('show_recipes.php', {category: category}).done(function(res) {
	    $("#recipes").html(res);
	    $("#oneRecipe").html("");
	//alert(res);
    });		
}



function showRecipe(r_id){
    $.post('show_recipe.php', {r_id: r_id}).done(function(res){
        $("#oneRecipe").html(res);
        $("#recipes").html("");
		//$("#intro").html("");
    });
}


