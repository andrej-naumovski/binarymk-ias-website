$(document).ready(function() {
	$("#cpplinks, #javalinks, #htmllinks, #jslinks").hide();

	$("#cpp").click(function() {
		$("#javalinks, #htmllinks, #jslinks").fadeOut(300);
		$("#cpplinks").delay(300).fadeToggle(300);
	});

	$("#java").click(function() {
		$("#cpplinks, #htmllinks, #jslinks").fadeOut(300);
		$("#javalinks").delay(300).fadeToggle(300);
	});

	$("#HTML").click(function() {
		$("#cpplinks, #javalinks, #jslinks").fadeOut(300);
		$("#htmllinks").delay(300).fadeToggle(300);		
	});

	$("#JavaScript").click(function() {
		$("#cpplinks, #javalinks, #htmllinks").fadeOut(300);
		$("#jslinks").delay(300).fadeToggle(300);		
	});
});