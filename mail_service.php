<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    define('MAILHOST', 'smtp.gmail.com');
    define('MAILPORT', 587);
    define('USERNAME', 'address@gmail.com');
    define('PASSWORD', '123');
    define("SEND_FROM", 'address@gmail.com');
    define("SEND_FROM_NAME", "Super Kuper");
    define('SMTP_ENCRYPTION', 'tls');

    require './vendor/autoload.php';

    function send_purchase_confirmation_email($recipientEmail, $recipientName, $purchaseID, $total_cost) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = MAILHOST;
            $mail->SMTPAuth = true;
            $mail->Username = USERNAME;     
            $mail->Password = PASSWORD;     
            $mail->SMTPSecure = SMTP_ENCRYPTION;   
            $mail->Port = MAILPORT;

            $mail->setFrom(USERNAME, 'Super Kuper');   
            $mail->addAddress($recipientEmail, $recipientName);  

            $userID = $_SESSION['userID'];
            $purchaseDB = new PurchaseDB();
            $user_purchase_count = $purchaseDB->count_user_purchase($userID);
            $user_purchase_number = $user_purchase_count + 1;

            $mail->isHTML(true);
            $mail->Subject = "Purchase Confirmation #{$user_purchase_number}";
            $mail->Body = "<h1>Fala!</h1>";
            $mail->Body .= "<p>Your purchase with ID #{$user_purchase_number} has been successfully placed.</p>";
            $mail->Body .= "<p>The total amount is $" . number_format($total_cost, 2) . ".</p>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }