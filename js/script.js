/* 
	author: istockphp.com
*/
jQuery(function($) {
	var validation_holder;
	
	$("form#register_form input[name='submit']").click(function() {
	
	var validation_holder = 0;
	
		var user			= $("form#register_form input[name='s_username']").val();
		var pass			= $("form#register_form input[name='s_password']").val();
		var lname 			= $("form#register_form input[name='s_lastname']").val();
		var fname 			= $("form#register_form input[name='s_firstname']").val();
		var mname 			= $("form#register_form input[name='s_middlename']").val();
		var grade 			= $("form#register_form input[name='s_gylevel']").val();
		var email 			= $("form#register_form input[name='s_email']").val();
		var email_regex 	= /^[\w%_\-.\d]+@[\w.\-]+.[A-Za-z]{2,6}$/; // reg ex email check
		var phone 			= $("form#register_form input[name='s_cp']").val();
		var phone_regex		= /^[0-9]{4,20}$/; // reg ex phone check
		var gender 			= $("form#register_form input[name='s_gender']");
		var month 			= $("form#register_form select[name='s_month']").val(); // month
		var day 			= $("form#register_form select[name='s_day']").val(); // day
		var year 			= $("form#register_form select[name='s_year']").val(); // year
		var address 		= $("form#register_form input[name='s_address']").val(); // year
		var parent 			= $("form#register_form input[name='s_parent']").val(); // day
		var relationship 	= $("form#register_form input[name='s_parentRelation']").val(); // year
		var pcp 			= $("form#register_form input[name='s_parentCp']").val(); // year
		
		
		/* validation start */	
		if(user == "") {
			$("span.val_username").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_username").html("");
		}
		
		if(pass == "") {
			$("span.val_password").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_password").html("");
		}
		
		if(lname == "") {
			$("span.val_lname").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_lname").html("");
		}
		if(fname == "") {
			$("span.val_fname").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_fname").html("");
		}
		if(mname == "") {
			$("span.val_mname").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_mname").html("");
		}	
		if(grade == "") {
			$("span.val_grade").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_grade").html("");
		}	
		if(email == "") {
			$("span.val_email").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			if(!email_regex.test(email)){ // if invalid email
				$("span.val_email").html("Invalid Email!").addClass('validate');
				validation_holder = 1;
			} else {
				$("span.val_email").html("");
			}
		}
		if(phone == "") {
			$("span.val_cp").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			if(!phone_regex.test(phone)){ // if invalid phone
				$("span.val_cp").html("Invalid Phone Number!").addClass('validate');
				validation_holder = 1;
			
			} else {
				$("span.val_cp").html("");
			}
		}
		if(gender.is(':checked') == false) {
			$("span.val_gen").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
				$("span.val_gen").html("");
		}
		if((month == "") || (day == "") || (year == "")) {
			$("span.val_bday").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
				$("span.val_bday").html("");
		}
		if(address == "") {
			$("span.val_address").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_address").html("");
		}
		if(parent == "") {
			$("span.val_pname").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_pname").html("");
		}
		if(relationship == "") {
			$("span.val_relationship").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_relationship").html("");
		}
		if(pcp == "") {
			$("span.val_pcp").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			if(!phone_regex.test(phone)){ // if invalid phone
				$("span.val_pcp").html("Invalid Phone Number!").addClass('validate');
				validation_holder = 1;
			
			} else {
				$("span.val_pcp").html("");
			}
		}
		if(validation_holder == 1) { // if have a field is blank, return false
			$("p.validate_msg").slideDown("fast");
			return false;
		}  validation_holder = 0; // else return true
		/* validation end */	
	}); // click end 

}); // jQuery End