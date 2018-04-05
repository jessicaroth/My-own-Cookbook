
function showRecipes(category, email) {
	//document.location.href = 'show_recipes.php';
	//document.getElementById("1").innerHTML = ""

	$.post('show_recipes.php', { category: category, email: email }).done(function(res) {
    //$("#recipes").hmtl(res);
	$("#recipes").html(res);
	//alert(res);
});		
}

function test(vari){
	document.getElementById("1").innerHTML = vari;
}
/*
function showRecipe(r_id) {
	//document.location.href = 'show_recipes.php';
	document.getElementById("1").innerHTML = title;

	//$.post('show_recipe.php', { r_id: r_id }).done(function(res) {
    //$("#recipes").hmtl(res);
	//alert(data);
});		
}*/
