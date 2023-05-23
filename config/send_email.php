<?php
    require_once('dbcon.php');
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use Dotenv\Dotenv;
    use Kreait\Firebase\Auth;

    session_start();

    // Load environment variables
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    if(isset($_POST['signup_btn'])){
        // Check if the form is submitted

        // Validate the form data
        $name = $_POST['fname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform additional validation if needed

        // Check if the email already exists in the Firebase Authentication database
        try {
            $user = $auth->getUserByEmail($email);
            // Email already exists, handle the error
            $_SESSION['status'] = 'error';
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
            exit();
        } catch (Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            // Email does not exist, continue with the sign-up process
        }

        // Send confirmation email
        $verificationCode = generateVerificationCode(); // Generate a unique verification code

        // Store the verification code in the Firebase Realtime Database
        $verificationCodesRef = $database->getReference('verification_codes');
        $newVerificationCodeRef = $verificationCodesRef->push();

        $newVerificationCodeRef->set([
            'code' => $verificationCode,
            'email' => $email,
            'verified' => false
        ]);

        $verificationCodeId = $newVerificationCodeRef->getKey();

        // Generate the confirmation link with the verification code ID and additional query parameters
        $confirmationLink = 'http://localhost/dictoccmincertgen/config/confirm_email.php?code=' . $verificationCodeId . '&fullname=' . urlencode($name) . '&password=' . urlencode($password);

        // Send the confirmation email using Gmail SMTP
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'certgendict@gmail.com'; // Replace with your Gmail email address
            $mail->Password   = $_ENV['PASS_KEY']; // Replace with your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('certgendict@gmail.com', $name); // Replace with your Gmail email address and your name
            $mail->addAddress('certgendict@gmail.com', 'DICT'); // Email and name of the recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Confirmation';
            $mail->Body    = "Dear DICT,<br><br>To confirm the application of $name with an email of $email. <br>Please click the link below to approved the user:<br><a href='$confirmationLink'>$confirmationLink</a><br><br>Thank you!";

            $mail->send();

            // Email sent successfully
            $_SESSION['status'] = 'success';
            header('location: ../pages/admin-approval.php');
            echo json_encode(['status' => 'success']);
            exit();
        } catch (Exception $e) {
            // Failed to send email
            $_SESSION['status'] = 'error';
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error']);
            exit();
        }
    }

    // Function to generate a unique verification code
    function generateVerificationCode() {
        // Generate a unique verification code using any logic you prefer (e.g., random string, token, timestamp, etc.)
        // Return the generated verification code
        $length = 8; // Length of the verification code
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $verificationCode = '';

        // Generate a random character from the available characters and append it to the verification code
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $verificationCode .= $characters[$index];
        }

        return $verificationCode;
    }
?>
