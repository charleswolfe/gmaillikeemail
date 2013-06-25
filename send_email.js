


window.onload = function() {
//$(document).ready(function() {

console.log("read");


	$("#to_manuals").tokenInput("emailLookup.php?q=", {
		theme: "facebook",
		tokenValue: "name",
		resultsFormatter: function(item) {
			return "<li><div style=\'display: inline-block; padding-left: 10px;\'><div class=\'email_row\'>" + item.first_name + " " + item.last_name + " &lt;" + item.name + "&gt;" + "</div></div></li>";
		},
		tokenFormatter: function(item) {
			return "<li><p>" + item.displayname + "</b></p></li>";
		},
		preventDuplicates: false 
	});

	$("#cc_manuals").tokenInput("emailLookup.php?q=", {
		theme: "facebook",
		tokenValue: "name", 
		resultsFormatter: function(item) {
			return "<li><div style=\'display: inline-block; padding-left: 10px;\'><div class=\'email_row\'>" + item.first_name + " " + item.last_name + " &lt;" + item.name + "&gt;" + "</div></div></li>";
		},
		tokenFormatter: function(item) {
			return "<li><p>" + item.displayname + "</b></p></li>";
		},
		preventDuplicates: false 
	})

	$("#bcc_manuals").tokenInput("emailLookup.php?q=", {
		theme: "facebook",
		tokenValue: "name", 
		resultsFormatter: function(item) {
			return "<li><div style=\'display: inline-block; padding-left: 10px;\'><div class=\'email_row\'>" + item.first_name + " " + item.last_name + " &lt;" + item.name + "&gt;" + "</div></div></li>";
		},
		tokenFormatter: function(item) {
			return "<li><p>" + item.displayname + "</b></p></li>";
		},
		preventDuplicates: false 
	})


	//Hide intial CC feild and show the button, onclick hide the button and show feild
	$(".cc_container_div").hide();
	$(".add_cc").click(function() {
		$(".cc_container_div").show();
		$(".add_cc").hide();
	});

	//Do the same for BCC
	$(".bcc_container_div").hide();
	$(".add_bcc").click(function() {
		$(".bcc_container_div").show();
		$(".add_bcc").hide();
	});

	
	$('#send').click(handleSendClick);	

	nicEditors.allTextAreas();

console.log("done it all");

};


/**
* Handles a click of the Send button.
*/
var handleSendClick = function(event) {
	nicEditors.findEditor('email_body_html').saveContent();
	var confirm_msg = 'Are you sure you would like to send this message?';
	var missing_msg = '';
	var missing_count = 0;

	var my_subject = $('#subject').val();
	//var my_body = $('#email_body_html').val(); 
	var my_body = nicEditors.findEditor('email_body_html').getContent();
	var my_to = $('#to_manuals').val();

	if (my_subject.length == 0) {
		missing_msg += 'subject';
		missing_count++;
	}

//lenfth is not zero bug
	if (my_body.length == 0) {
		if (missing_msg.length)
			missing_msg += ', ';
		missing_msg += 'body';
		missing_count++;
	}

	if (my_to.length == 0) {
		if (missing_msg.length)
			missing_msg += ', ';
		missing_msg += 'to';
		missing_count++;
	}

	if (missing_count) {
		//capitalize first letter
		if (missing_count == 1)
			missing_msg += ' feild is empty, would you like to send anyway?';
		else 
			missing_msg += ' feilds are empty, would you like to send anyway?';
		confirm_msg = missing_msg;
	}


	if (confirm(confirm_msg)) {
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "send_email.php?action=send");

		var params = new Array();
		params['subject'] = my_subject;
		params['body'] = my_body;
		params['to'] = my_to;
		params['cc'] = $('#cc_manuals').val();
		params['bcc'] = $('#bcc_manuals').val();
		params['fileuids'] = $('#attachments').val();

		for(var key in params) {
			if(params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);
				form.appendChild(hiddenField);
			}
		}
		document.body.appendChild(form);
		form.submit();
	}
}


