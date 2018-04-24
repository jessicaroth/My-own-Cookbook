
function showRecipes(category) {
	//document.location.href = 'show_recipes.php';
	//document.getElementById("1").innerHTML = ""

	$.post('show_recipes.php', { category: category}).done(function(res) {

	$("#recipes").html(res);
	//alert(res);
});		
}

//function test(vari){
//	document.getElementById("snacks").innerHTML = vari;
//}

function showRecipe(r_id){
    $.post('show_recipe.php', {r_id: r_id}).done(function(res){
        $("#other").html(res);
        $("#recipes").html("");
    });
}


