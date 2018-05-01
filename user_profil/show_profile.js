function showProfile(edit) {

//alert("Page is loaded");
	$.post('show_profile.php', {edit: edit}).done(function(res) {

	$("#profile").html(res);
	
	//alert(res);
});		
}