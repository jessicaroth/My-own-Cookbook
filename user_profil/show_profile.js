function showProfile() {

//alert("Page is loaded");
	$.post('show_profile.php').done(function(res) {

	$("#profile").html(res);
	
	//alert(res);
});		
}