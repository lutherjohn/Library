jQuery(function($) {
	var validation_holder;
	
	$("form#register_form input[name='submit']").click(function() {
	
	var validation_holder = 0;
	
		var isbn 			= $("form#register_form input[name='isbn']").val();
		var title 			= $("form#register_form input[name='title']").val();
		var author 			= $("form#register_form input[name='author']").val();
		var edition 		= $("form#register_form input[name='edition']").val();
		var copies 		    = $("form#register_form input[name='book_copies']").val();
		var copies_regex	= /^[0-9]{4,20}$/; // reg ex phone check
		var price 			= $("form#register_form input[name='price']").val();
		var price_regex		= /^[0-9]{4,20}$/; // reg ex phone check
		var cn 				= $("form#register_form input[name='cn']");
		var cn_regex		= /^[0-9]{4,20}$/; // reg ex phone check
		var book_category 	= $("form#register_form select[name='book_category']").val(); // month
		var book_publisher 	= $("form#register_form select[name='book_publisher']").val(); // day
		
		
		/* validation start */	
		if(isbn == "") {
			$("span.val_isbn").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_isbn").html("");
		}
		if(title == "") {
			$("span.val_title").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_title").html("");
		}
		if(author == "") {
			$("span.val_author").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_author").html("");
		}	
		if(edition == "") {
			$("span.val_edition").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			$("span.val_edition").html("");
		}

		if(copies == "") {
			$("span.val_copies").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			if(!copies_regex.test(copies)){ // if invalid phone
				$("span.val_copies").html("Invalid Copies!").addClass('validate');
				validation_holder = 1;
			
			} else {
				$("span.val_copies").html("");
			}
		}
		
		if(price == "") {
			$("span.val_price").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			if(!price_regex.test(price)){ // if invalid phone
				$("span.val_price").html("Invalid Price!").addClass('validate');
				validation_holder = 1;
			
			} else {
				$("span.val_price").html("");
			}
		}
		
		if(cn == "") {
			$("span.val_cn").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
			if(!cn_regex.test(cn)){ // if invalid phone
				$("span.val_cn").html("Invalid Phone Number!").addClass('validate');
				validation_holder = 1;
			
			} else {
				$("span.val_cn").html("");
			}
		}
		if(book_category == "") {
			$("span.val_category").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
				$("span.val_category").html("");
		}
		if(book_publisher == "") {
			$("span.val_publisher").html("This field is required.").addClass('validate');
			validation_holder = 1;
		} else {
				$("span.val_publisher").html("");
		}
	
		
		if(validation_holder == 1) { // if have a field is blank, return false
			$("p.validate_msg").slideDown("fast");
			return false;
		}  validation_holder = 0; // else return true
		/* validation end */	
	}); // click end 

}); // jQuery End