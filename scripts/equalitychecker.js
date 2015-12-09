function isEmail(email) {
	var regex = /^[^\W]*[@][^\W]*\.[a-z\.]*$/;
	return regex.test(email);
};

function hasInvalidCharacters(username) {
	var regex = /.*[^a-zA-Z0-9\.\-\_].*$/;
	return regex.test(username);
};

function slowEquals(a, b) {
	var diff = a.length ^ b.length;
	for(var i=0;i<a.length && i<b.length;i++) {
		diff |= a.charAt(i) ^ b.charAt(i);
	}
	return diff === 0;
}

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

function setEmailOnBlur(firstEmail, secondEmail, errorId) {
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
	$("#shortPassword").hide();
	$("#passwordsNotMatch").hide();

	$("#email").blur(function () {
		setEmailOnBlur(this, "#repeatEmail", "#invalidEmail");
	});

	$("#repeatEmail").blur(function() {
		setEmailOnBlur(this, "#email", "#invalidRepeatEmail");
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

	var isPasswordLongEnough;

	$("#password").blur(function() {
		if($(this).val().length > 0) {
			if($(this).val().length < 6) {
				$(this).removeClass("equal").addClass("notEqual");
				$("input[type=submit]").attr('disabled', 'disabled');
				$("#shortPassword").show(250);
				isPasswordLongEnough = false;
			} else {
				isPasswordLongEnough = true;
				$("#shortPassword").hide(250);
				if(setInputEquality(this, "#repeatPassword")) {
					$("#passwordsNotMatch").hide(250);
				} else {
					$("#passwordsNotMatch").show(250);
				}
			}
		}
	});

	$("#repeatPassword").blur(function() {
		if($(this).val().length > 0 && isPasswordLongEnough) {
			if(setInputEquality(this, "#password")) {
				$("#passwordsNotMatch").hide(250);
			} else {
				$("#passwordsNotMatch").show(250);
			}
		}
	})
});