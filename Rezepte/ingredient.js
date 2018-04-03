function addFields(){
	
	id = id + 1 || 0;
	
    var container = document.getElementById("ingredients");
		
		/*		
		var input_measure = document.createElement("input");
		input_measure.name = "measure_" + id;
		input_measure.size = "3";
		input_measure.maxlength = "6";
		container.appendChild(input_measure);
        */
		
		// Create an <input> element, set its type and name attributes
        var input_ingredient = document.createElement("input");
        input_ingredient.type = "text";
        input_ingredient.name = "ingredient_" + id;
		input_ingredient.size = "20";
		input_ingredient.maxlength = "30";
        container.appendChild(input_ingredient);

        // Append a line break 
        container.appendChild(document.createElement("br"));
}