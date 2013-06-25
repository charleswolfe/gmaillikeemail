<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>Gmail Clone Example</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="send_email.css" />
	<link rel="stylesheet" type="text/css" href="token-input.css" />
	<link rel="stylesheet" type="text/css" href="token-input-facebook.css" />
<style>
</style>

<!-- Normally I would store these all in a js/ directory -->
<script src="jquery-2.0.1.min.js"></script>
<script src="jquery.tokeninput.js"></script>
<script src="nicEdit.js"></script>

<script src="send_email.js"></script>



</head>
<body id="body_email">

<?php
//TODO
/*
- scripts should be called in js, on onload, not here	(js)
-handlw posting/sending email (php)
-do the bcc/cc hide functions (js)
-change css to look like gmail

*/
/*
make the form
add css
add php calls / allow it to send using sendmail
add javascript
add toeknizer
add nicedit
*/ 




if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'send' ) {
	$missing_error = 0;

	if (isset($_REQUEST['subject'])) {
		$subject = $_REQUEST['subject'];  //shpould escape?
	}

	if (isset($_REQUEST['body'])) {
		$body = $_REQUEST['body'];
        }

	if (isset($_REQUEST['to'])) {
		$to = $_REQUEST['to'];
        }

	if (isset($_REQUEST['cc'])) {
		$cc = $_REQUEST['cc'];
        }

	if (isset($_REQUEST['bcc'])) {
		$bcc = $_REQUEST['bcc'];
        }

	//send email
	$headers  = 'MIME-Version: 1.0' . PHP_EOL;
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL;
	$headers .= 'From: Me <me@email.com>' . PHP_EOL;
	$headers .= 'Bcc: ' . $bcc . PHP_EOL; 
	$headers .= 'Cc: ' . $cc . PHP_EOL;

	mail($to, $subject, $body, $headers);

	//post sucess message

}
$html = '
	<div id="content">
		<!--- To Email Addresses --->
		<div>
			<div class="email_address_label"><span>' . _("To") . ': </span></div>
			<div class="email_address_wrapper">
				<div id="to" class="email_addresses">
					<input type="text" id="to_manuals" class="manual_email_addresses"/>
					</div>
				</div>
			</div>

			<!--- CC Email Addresses --->
			<div class="cc_container_div">
				<div class="email_address_label"><span>' . _("CC") . ': </span></div>
				<div class="email_address_wrapper">
					<div id="cc" class="email_addresses">
						<input type="text" id="cc_manuals" class="manual_email_addresses"/>
					</div>
				</div>
			</div>

			<!--- BCC Email Addresses --->
			<div class="bcc_container_div">
				<div class="email_address_label"><span>' . _("BCC") . ': </span></div>
				<div class="email_address_wrapper">
						<div id="bcc" class="email_addresses">
								<input type="text" id="bcc_manuals" class="manual_email_addresses"/>
						</div>
				</div>
			</div>


			<!--- BCC/CC BUTTONS --->
			<div>
				<div class="add_cc_label"><span>&nbsp;</span></div>
				<div class="add_cc_wrapper">
					&nbsp;
					<button id="add_cc" class="add_cc">
						' . _("Add CC") . '
					</button>
					<button id="add_bcc" class="add_bcc">
						' . _("Add BCC") . '
					</button>
					&nbsp;
				</div>
			</div>

			<!--- Subject --->
			&nbsp;
			<div>
				<div class="email_subject_label"><span>' . _("Subject") . ': </span></div>
				<div class="email_subject_wrapper">
					<input type="text" id="subject" class="subject"/>
				</div>
			</div>
			<!--- BODY TEXT --->
			<!--- BODY HTML --->
			<div>
				<div class="email_body_html_label"><span>' . _("Body") . ': </span></div>
				<div class="email_body_html_wrapper">
					<textarea cols="64" name="email_body_html" id="email_body_html" class="email_body_html" ></textarea>
	
				</div>
			</div>
				
			<!--- Send/Clear BUTTONS --->
			<div>
				<div id="button_bar">
					<button id="send">' . _("Send") . '</button>
				</div>
			</div>
		</div>
	';

echo $html;

?>
</body>
</html>
