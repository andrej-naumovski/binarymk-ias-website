$(document).ready(function() {
	$(".navButton").hover(function() {
		$(this).animate({opacity: "0.9"}, 250);
	}, function() {
		$(this).animate({opacity: "0.5"}, 250);
	});
});