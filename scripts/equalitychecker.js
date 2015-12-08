function isEmail(email) {
	var regex = /^[^\W]*[@][^\W]*\.[a-z, \.]*$/;
	return regex.test(email);
};

function hasInvalidCharacters(username) {
	var regex = /.*[^a-zA-Z0-9\.\-\_].*$/;
	return regex.test(username);
};


/*		checks two inputs for equality, gives red borders to both if they are not equal		*/
function setInputEquality(firstField, secondField) {
	if($(firstField).val().localeCompare($(secondField).val()) != 0) {
		$(firstField).removeClass("equal").addClass("notEqual");
		$(secondField).removeClass("equal").addClass("notEqual");
		$("input[type=submit]").attr('disabled', 'disabled');
		return false;
	} else {
		$(firstField).removeClass("notEqual").addClass("equal");
		$(secondField).removeClass("notEqual").addClass("equal");
		$("input[type=submit]").removeAttr('disabled');
	}
	return true;
};

function setEmailBlur(firstEmail, secondEmail, errorId) {
	if($(firstEmail).val().length != 0) {
		if(!isEmail($(firstEmail).val())) {
			$(firstEmail).removeClass("equal");
			$(secondEmail).removeClass("equal");
			$(firstEmail).addClass("notEqual");
			$(errorId).show(250);
			$("input[type=submit]").attr('disabled', 'disabled');
		} else {
			$("input[type=submit]").removeAttr('disabled');
			$(errorId).hide(250);
			$(firstEmail).removeClass("notEqual");
			if($(secondEmail).val().length > 0) {
				if(!setInputEquality(firstEmail, secondEmail)) {
					$("#emailsNotEqual").show(250);
				} else {
					$("#emailsNotEqual").hide(250);
				}
			}
		}
	}
};

$(document).ready(function() {
	$("#shortUsername").hide();
	$("#invalidCharacters").hide();
	$("#invalidEmail").hide();
	$("#emailsNotEqual").hide();
	$("#invalidRepeatEmail").hide();

	$("#email").blur(function () {
		setEmailBlur(this, "#repeatEmail", "#invalidEmail");
	});

	$("#repeatEmail").blur(function() {
		setEmailBlur(this, "#email", "#invalidRepeatEmail");
	});

	$("#username").blur(function() {
		if($(this).val().length > 0) {
			if($(this).val().length < 6) {
				$("#shortUsername").show(250);
				$("#invalidCharacters").hide(250);
				$(this).removeClass("equal").addClass("notEqual");
				$("input[type=submit]").attr('disabled', 'disabled');
			} else {
				$("#shortUsername").hide(250);
				$(this).removeClass("notEqual");
				if(hasInvalidCharacters($(this).val())) {
					$(this).removeClass("equal").addClass("notEqual");
					$("input[type=submit]").attr('disabled', 'disabled');
					$("#invalidCharacters").show(250);
				} else {
					$(this).removeClass("notEqual").addClass("equal");
					$("input[type=submit]").removeAttr('disabled');
					$("#invalidCharacters").hide(250);
				}
			}
		}
	});
});