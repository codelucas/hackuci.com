<?php
if ( !isset( $_SESSION ) ) session_start();
if ( !$_POST ) exit;
if ( !defined( "PHP_EOL" ) ) define( "PHP_EOL", "\r\n" );


$to = "yourmail@yourdomain.com";
$subject = "Website contact form ";



foreach ($_POST as $key => $value) {
    if (ini_get('magic_quotes_gpc'))
        $_POST[$key] = stripslashes($_POST[$key]);
    $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

// Assign the input values to variables for easy reference
$name      = @$_POST["name"];
$email     = @$_POST["email"];
$company   = @$_POST["company"];
$message   = @$_POST["comment"];
$quoteType = @$_POST["quoteType"];



// Test input values for errors
$errors = array();
 //php verif name
if(isset($_POST["name"])){
 
        if (!$name) {
            $errors[] = "You must enter a name.";
        } elseif(strlen($name) < 2)  {
            $errors[] = "Name must be at least 2 characters.";
        }
 
}
    //php verif email
if(isset($_POST["email"])){
    if (!$email) {
        $errors[] = "You must enter an email.";
    } else if (!validEmail($email)) {
        $errors[] = "You must enter a valid email.";
    }
}

//php verif company
if(isset($_POST["company"])){
        if (!$company) {
            $errors[] = "You must enter a company.";
        } elseif(strlen($company) < 2)  {
            $errors[] = "Company must be at least 2 characters.";
        }
}

//php verif quoteType
if(isset($_POST["quoteType"])){
        if (!$quoteType) {
            $errors[] = "You must select a project type.";
        }
}

//php verif comment
if(isset($_POST["comment"])){
    if (strlen($message) < 10) {
        if (!$message) {
            $errors[] = "You must enter a message.";
        } else {
            $errors[] = "Message must be at least 10 characters.";
        }
    }
}


if ($errors) {
        // Output errors and die with a failure message
    $errortext = "";
    foreach ($errors as $error) {
        $errortext .= '<li>'. $error . "</li>";
    }

    echo '<div class="alert alert-error">The following errors occured:<br><ul>'. $errortext .'</ul></div>';

}else{



    // Send the email
    $headers  = "From: $email" . PHP_EOL;
    $headers .= "Reply-To: $email" . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
    $headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

    $mailBody  = "You have been contacted by $name" . PHP_EOL . PHP_EOL;
    $mailBody .= (!empty($company))?'Company: '. PHP_EOL.$company. PHP_EOL . PHP_EOL:'';
    $mailBody .= (!empty($quoteType))?'project Type: '. PHP_EOL.$quoteType. PHP_EOL . PHP_EOL:''; 
    $mailBody .= "Message :" . PHP_EOL;
    $mailBody .= $message . PHP_EOL . PHP_EOL;
    $mailBody .= "You can contact $name via email, $email." . PHP_EOL . PHP_EOL;
    $mailBody .= (isset($phone) && !empty($phone))?"Or via phone $phone." . PHP_EOL . PHP_EOL:'';
    $mailBody .= "-------------------------------------------------------------------------------------------" . PHP_EOL;






    if(mail($to, $subject, $mailBody, $headers)){
        echo '<div class="alert alert-success">Success! Your message has been sent.</div>';
    }
}

// FUNCTIONS 
function validEmail($email) {
    $isValid = true;
    $atIndex = strrpos($email, "@");
    if (is_bool($atIndex) && !$atIndex) {
        $isValid = false;
    } else {
        $domain = substr($email, $atIndex + 1);
        $local = substr($email, 0, $atIndex);
        $localLen = strlen($local);
        $domainLen = strlen($domain);
        if ($localLen < 1 || $localLen > 64) {
            // local part length exceeded
            $isValid = false;
        } else if ($domainLen < 1 || $domainLen > 255) {
            // domain part length exceeded
            $isValid = false;
        } else if ($local[0] == '.' || $local[$localLen - 1] == '.') {
            // local part starts or ends with '.'
            $isValid = false;
        } else if (preg_match('/\\.\\./', $local)) {
            // local part has two consecutive dots
            $isValid = false;
        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
            // character not valid in domain part
            $isValid = false;
        } else if (preg_match('/\\.\\./', $domain)) {
            // domain part has two consecutive dots
            $isValid = false;
        } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
            // character not valid in local part unless
            // local part is quoted
            if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
                $isValid = false;
            }
        }
        if ($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) {
            // domain not found in DNS
            $isValid = false;
        }
    }
    return $isValid;
}

?>
