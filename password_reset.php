<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




include './includes/formHeader.php';
include './admin/controllers/users.php';


$errors = array();

$verification_code = "";

if (isset($_POST['reset'])) {

    if (isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];


            $user = selectOne('users', ['email' => $email]);

            if ($user) {
                require(base_app . 'PHPMailer/src/Exception.php');
                require(base_app . 'PHPMailer/src/PHPMailer.php');
                require(base_app . 'PHPMailer/src/SMTP.php');

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'oluwaseyitimm02@gmail.com';                     //SMTP username
                    $mail->Password   = 'jizdzdhkwmvfyvya';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('oluwaseyitimm02@gmail.com', 'Ekklesia');
                    $mail->addAddress($email, $user['firstname']);     //Add a recipient




                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML

                    $verification_code = md5(rand());

                    
                    $mail->Subject = 'Reset Password Notification';

                   

                    $mail->Body = "<h2>Hello, </h2>
                    <h3>You are getting this message because we received a password reset request for your account.</h3><br /><br />
                    <a href='http://localhost/sundaySchoolManual/password_change?token=$verification_code&email=$email'> Reset </a>";




                    $mail->send();
                    $content = array('verification_code' => $verification_code);

                    $id = $user['id'];


                    $user_id = update('users', $id, $content);

                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $_SESSION['message'] = $user['firstname'] . ', Reset link has been sent to your mail box';
                $_SESSION['type'] = 'success';
                $_SESSION['email_verify'] = $email;

            } else {
                array_push($errors, "User does not exist");
                $email = $_POST['email'];
            }
        } else {
            array_push($errors, "Enter Email");
            $email = $_POST['email'];
        }
    } else {
        array_push($errors, 'Something went wrong, Reload Page');
    }
}

/*
if (isset($_POST['resend'])) {


    $email = $_SESSION['email_verify'];

    $user =  selectOne('users', ['email' => $email]);
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function



    require './admin/PHPMailer/src/Exception.php';
    require './admin/PHPMailer/src/PHPMailer.php';
    require './admin/PHPMailer/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'oluwaseyitimm02@gmail.com';                     //SMTP username
        $mail->Password   = 'jizdzdhkwmvfyvya';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('oluwaseyitimm02@gmail.com', 'Ekklesia');
        $mail->addAddress($email, $user['firstname']);     //Add a recipient




        //Content
        $mail->isHTML(true);                                  //Set email format to HTML

        $verification_code = rand(100000, 999999);
        $mail->Subject = 'Email Verification';
        $mail->Body    = '<p>Your verification code is : <b style="font-size:30px;">' . $verification_code . '</b></p>';




        $mail->send();
        $content = array('verification_code' => $verification_code);

        $id = $user['id'];


        $user_id = update('users', $id, $content);

        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $_SESSION['message'] = $user['firstname'] . ', Another Verification link has been sent to your mail box';
    $_SESSION['type'] = 'success';


    header('location: ' . './email_verification');

    exit();
}

*/





?>

<div class="container form-pages">
    <div class="form">

        <h2>Email Verification</h2>
        <?php include './admin/includes/messages.php'; ?>
        <?php include './admin/helpers/formErrors.php'; ?>


        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= createToken(); ?>">
            <input type="text" name="email" value="<?= $email ?>" placeholder="Email">

            <div>
                <button type="submit" name="reset" class="btn">Reset</button>
            </div>

        </form>

        
    </div>

</div>



<script type="text/javascript">
    var timer = 29;

    var myTimer = setInterval(function() {
        document.getElementById('btn').innerHTML = "Wait for " + timer-- + " sec";
        if (timer == -1) {
            clearInterval(myTimer);
            document.getElementById('btn').innerHTML = "Resend";
            document.getElementById('btn').disabled = false;
        }
    }, 1000);
</script>

<!--links to js-->
<script src="./admin/assets/js/main.js"></script>
<script src="./admin/assets/js/theme-toggler.js"></script>
</body>

</html>