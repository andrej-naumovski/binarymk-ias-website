function toggleContents(contentHead, content, prevContent) {
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
	toggleContents("#easy", "#easyContent", "body");
	toggleContents("#medium", "#mediumContent", "#medium");
	toggleContents("#hard", "#hardContent", "#medium");
});