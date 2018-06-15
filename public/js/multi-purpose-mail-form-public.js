(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

})( jQuery );

// JavaScript Document
/*
Author: Lindeni Mahlalela
Date: 01/09/2011
Email: mahlamusa@hotmail.com
*/
//<!--
/*
* Validate the default form
*/
function validate_custom_form ( )
{
	var validform = true;
	var errormessage = "";
	
	var count = document.customForm.count.value;
	for ( var co = 1; co <= count; co ++){
		var fname = "f"+co;
		alert(count);
		if ( document.customForm.fname.value = ""){
			errormessage += "Information missing on Field " + co + "\n";
			validform = false;
		}
	}
	//
	if(message == ""){
		validform = true;
		alert(errormessage + "Count : " +count);	
	}else{
		validform = false;
		alert(errormessage + "Count : " +count);	
	}
    return valid;
}
/*
* Validate the default form
*/
function validate_form ()
{
    var valid = true;
	var message = "";
    if ( document.contactForm.req_info.value == "" )
    {
        message += "Please specify what information you need." + "\n";
        valid = false;
    }
	if (document.contactForm.fname.value ==""){
		message += "Please fill in the 'First Name ' field." + "\n";
		valid = false;
	}
	if (document.contactForm.lname.value ==""){
		message += "Please fill in the 'Last Name' field."  + "\n";
		valid = false;
	}
	if (document.contactForm.email.value !=""){
		//validate email
		if(!validEmail(document.contactForm.email.value)){
			message += "Please enter a valid email address in the 'Email Address' field." + "\n";
			valid = false;	
		}
	}
	if (document.contactForm.phone.value !=""){
		//validate
		if(document.contactForm.phone.value.length < 10 || document.contactForm.phone.value.length > 12){
			message += "Please enter a valid phone number: 10 digits without, or 11 digits with international code." + "\n";
			valid = false;
		}
		else if(!validPhone(document.contactForm.phone.value)){
			message += "Please enter a valid phone number digits from 0 to 9" + "\n";
			valid = false;
		}
	}
	if (document.contactForm.message.value ==""){
		message += "Please fill in the 'Your query/ Question ' field."  + "\n";
		valid = false;
	}
	if (document.contactForm.contby.value ==""){
		message += "Please answer the 'How can we contact you?' question."  + "\n";
		valid = false;
	}
	
	//
	if(message == ""){
		valid = true;	
	}else{
		valid = false;
		alert(message);	
	}
    return valid;
}
//
function validEmail(elementValue){  
   var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
   return emailPattern.test(elementValue);
}  
function validPhone(elementValue){  
   var phonePattern = /[0-9]$/;  
   return phonePattern.test(elementValue);
} 
