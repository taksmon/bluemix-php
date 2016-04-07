/**
 * 
 */

// validate Email
function validate_email(field, alerttxt) {
	with (field) {
		apos = value.indexOf("@")
		dotpos = value.lastIndexOf(".")
		if (apos < 1 || dotpos - apos < 2) {
			alert(alerttxt);
			return false
		} else {
			return true
		}
	}
}

// validate the first name
function validate_fname(field, alerttxt) {

	with (field) {
		var f = /^[A-Z\s]+$/;
		if (value.length > 1 && value.length < 7 && f.test(value)) {
			return true
		} else {
			alert(alerttxt);
			return false
		}
	}
}

// validate the last name
function validate_lname(field, alerttxt) {
	with (field) {
		var l = /^[A-Z\s]+$/;
		if (value.length < 7 && value.length > 1 && l.test(value)) {
			return true
		} else {
			alert(alerttxt);
			return false
		}
	}
}

// validate the phone numeber
function validate_rphone(field, alerttxt) {
	with (field) {
		var number = /\d{8}/;
		if (number.test(value)) {
			return true
		} else {
			alert(alerttxt);
			return false
		}
	}
}

// validate the retail store
function validate_rstore(field, alerttxt) {
	with (field) {
		if (value == null || value == "none") {
			alert(alerttxt);
			return false
		} else {
			return true
		}
	}
}

// validate the phone model
function validate_model(field, alerttxt) {
	with (field) {
		if (value == null || value == "") {
			alert(alerttxt);
			return false
		} else {
			return true
		}
	}
}

// validate the Form
function validate_form(thisform) {
	with (thisform) {
		if (validate_email(email, "Not a valid email address!") == false) {
			email.focus();
			return false
		}
		if (validate_fname(fname, "Please provide a correct First Name") == false) {
			fname.focus();
			return false
		}
		if (validate_lname(lname, "Please provide a correct Last Name") == false) {
			lname.focus();
			return false
		}
		if (validate_rphone(rphone, "Not a valid Phone number") == false) {
			rphone.focus();
			return false
		}
		if (validate_rstore(rstore, "Please select a store!") == false) {
			rstore.focus();
			return false
		}
		//in fact,it's not useful,just for attention
		if (validate_model(model, "Please choose a model!") == false) {
			model.focus();
			return false
		}
	}
}