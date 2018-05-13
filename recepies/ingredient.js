//function for adding fields for additional ingredients
function addFields(){
	
	 id = id + 1 || 0;
		
		// // Create an <input> element, set its type and name attributes
        var input_ingredient = document.createElement("input");
        input_ingredient.type = "text";
        input_ingredient.name = "ingredient_" + id;
		input_ingredient.size = "20";
		input_ingredient.maxlength = "30";
		
		//Create a new row for the table "create new recipe"
		var table = document.getElementById("create_new_recipe");
		var row = table.insertRow(-1);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		cell1.innerHTML = "";
		cell2.appendChild(input_ingredient);
}

