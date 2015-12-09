function onHover(element, image) {
	$(element).hover(function() {
		$(image).animate({opacity: "0.8"}, 400);
	}, function() {
		$(image).animate({opacity: "0.4"}, 400);
	});
};


$(document).ready(function() {
	onHover("#java", "#javaimg");
	onHover("#cpp", "#cppimg");
	onHover("#HTML", "#htmlimg");
	onHover("#JavaScript", "#jsimg");
});