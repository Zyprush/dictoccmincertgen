<?php
session_start();
include('dbconfig.php');
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if(isset($_POST['signup_btn'])){
    // Check if the form is submitted

    // Validate the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform additional validation if needed

    // Check if the email already exists in the admin table
    $stmt = $conn->prepare("SELECT * FROM certgen_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, handle the error
        $_SESSION['status'] = "Email already exist";
        header('location: ../pages/signup.php');
        
        exit();
    }

    // Send confirmation email
    $verificationCode = generateVerificationCode(); // Generate a unique verification code

    // Insert the user into the admin table with the verification code
    $stmt = $conn->prepare("INSERT INTO certgen_users (name, email, password, verification_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $verificationCode);
    $stmt->execute();

    // Generate the confirmation link with the verification code and additional query parameters
    $confirmationLink = 'http://localhost/dictoccmincertgen/config/confirm_email_function.php?code=' . $verificationCode . '&fullname=' . urlencode($name) . '&password=' . urlencode($password);

    // Send the confirmation email using PHPMailer
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
        $mail->Body    = "Dear DICT,<br><br>To confirm the application of $name with an email of $email. <br>Please click the link below to approve the user:<br><a href='$confirmationLink'>$confirmationLink</a><br><br>Thank you!";

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
