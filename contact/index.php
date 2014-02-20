<?php 

	require_once("../inc/config.php");
	
	$pageTitle = "All Computers";
	$section = "products";
	include(ROOT_PATH . 'inc/products.php');
	
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email =  trim($_POST["email"]);
    $message =  trim($_POST["message"]);
	
	// make sure that $name for sure (trim) is not empty
	if ($name == "" OR $email == "" OR $message == "") {
		$error_message[] = "You must specify a value for name, email and message";
	}
	
	// Email Header Injection Exploit Preventer
	// loop through all values of POST
	foreach( $_POST as $value ) {
		// check for malicious value
		if( stripos($value, 'Content-Type:') !== FALSE ){
			$error_message[] = "There was a problem with the information you entered.";
		}
	}
	
	// added measure to prevent evil bots 
	if($_POST["address"] != "") {
		$error_message[] = "Your form submission has en error.";	
	}
	
	// mailer process
	require_once(ROOT_PATH . "inc/phpmailer/class.phpmailer.php");
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	if(!$mail->ValidateAddress($email)){
		$error_message[] = "You must specify a valid email address.";
	}
	
	// if no error was found
	if(!isset($error_message)){
		$email_body = "";
		$email_body = $email_body . "Name: " . $name . "<br>";
		$email_body = $email_body . "Email: " . $email . "<br>";
		$email_body = $email_body . "Message: " . $message;
		
		//Set who the message is to be sent from
		$mail->setFrom($email, $name);
		//Set who the message is to be sent to
		$address = CONTACT_EMAIL;
		$mail->addAddress($address, "CompuX");
		//Set the subject line
		$mail->Subject = 'CompuX Form Submission | ' . $name;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($email_body);
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.gif');
		
		//send the message, check for errors
		if ($mail->send()) { // successful mail sender
			header("Location: " . BASE_URL . "contact/?status=thanks");
			exit;
		}else {
			$error_message[] = "There was a problem sending the email: " . $mail->ErrorInfo;
		} // end else	
	} // end if
}
$pageTitle = "Contact CompuX";
$section = "contact";
include(ROOT_PATH . 'inc/header.php'); ; ?>

	<div class="section page">

		<div class="wrapper"> 

            <h1>Contact</h1>

            <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
                <p>Thanks for the email! I&rsquo;ll be in touch shortly!</p>
            <?php } else { // user submit
					if(!isset($error_message)) { 
						echo '<p>We&rsquo;d love to hear from you! Complete the form to send me an email.</p>';

					} else {
						foreach($error_message as $error) {
							echo '<p class="message">' . $error .'</p>'; 
						} // end foreach
					}
				?>

                <form method="post" action="<?php echo BASE_URL; ?>contact/">

                    <table>
                        <tr>
                            <th>
                                <label for="name">Name</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name" value="<?php if(isset($name)){echo htmlspecialchars($name); }?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="email">Email</label>
                            </th>
                            <td>
                                <input type="text" name="email" id="email" value="<?php if(isset($email)){echo htmlspecialchars($email); }?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="message">Message</label>
                            </th>
                            <td>
                                <textarea name="message" id="message"><?php if(isset($message)){echo htmlspecialchars($message); }?></textarea>
                            </td>
                        </tr>  
                        <?php 
							// add measure to prevent header injection
						?>  
                        <tr style="display: none;">
                            <th>
                                <label for="Address">Address</label>
                            </th>
                            <td>
                                <input type="text" name="address" id="address">
                                <p>Please leave this field blank.</p>
                            </td>
                        </tr>                
                    </table>
                    <input type="submit" value="Send">

                </form>

            <?php } ?>

        </div>

	</div>

<?php
include(ROOT_PATH . 'inc/footer.php'); ?>
