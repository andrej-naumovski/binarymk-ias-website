function toggleContents(contentHead, content) {
	$(contentHead).click(function() {
		if($(content).is(':hidden')) {
			$(content).show(250);
		} else {
			$(content).hide(250);
		}
	});
};

$(document).ready(function() {
	$("#easyContent").hide();
	$("#mediumContent").hide();
	$("#hardContent").hide();
	toggleContents("#easy", "#easyContent");
	toggleContents("#medium", "#mediumContent");
	toggleContents("#hard", "#hardContent");
});