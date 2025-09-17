// JavaScript Document
$(document).ready(function() {
	$('form').submit(function(event) {
		event.preventDefault();
		var username = $('#username').val();
		var password = $('#password').val();
		if (username == "" || password == "") {
			alert("Please fill in all fields.");
		} else {
			alert("Login successful!");
		}
	});
});