<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




 include './includes/formHeader.php';
include './admin/controllers/users.php';


$errors = array();

$verification_code = "";

if (isset($_POST['verify-btn'])) {

    if (isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {

    if (!empty($_POST['verification_code'])) {
        $email = $_POST['email'];


        $user = selectOne('users', ['email' => $email]);

        if ($_POST['verification_code'] === $user['verification_code']) {
            $id = $user['id'];

            $content = array('verified' => 1, 'verification_code' => null);

            $id = $user['id'];

            $user_id = update('users', $id, $content);
            
            unset($_SESSION['email_verify']);

            $_SESSION['message'] = $user['firstname'] . ' You have been Verified, Kindly Login ';
            $_SESSION['type'] = 'success';


            header('location: ' . './login');

            exit();
        } else {
            array_push($errors, "Invalid Verification Code");
            $verification_code = $_POST['verification_code'];
        }
    } else {
        array_push($errors, "Enter Verification Code");
        $verification_code = $_POST['verification_code'];
    }
}else{
    array_push($errors, 'Something went wrong, Reload Form');
}
}


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

    $_SESSION['message'] = $user['firstname'] . ', Another Verification code has been sent to your mail box';
    $_SESSION['type'] = 'success';
    

    header('location: ' . './email_verification');

    exit();
}





?>

<div class="container form-pages">
    <div class="form">

        <h2>Email Verification</h2>
        <?php include './admin/includes/messages.php'; ?>
        <?php include './admin/helpers/formErrors.php'; ?>


        <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?= createToken(); ?>">
            <input type="hidden" name="email" value="<?php if (isset($_SESSION['email_verify'])) {
                                                            echo $_SESSION['email_verify'];
                                                        } ?>" placeholder="Phone Number or Email">
            <input type="text" name="verification_code" value="<?= $verification_code ?>" placeholder="Verification Code">
            <div>
                <button type="submit" name="verify-btn" class="btn">Verify</button>
            </div>
            
        </form>

        <form action="" method="post">

           
            <div>
            <span class="text-muted">Did not receive code?</span>
                <button type="submit" name="resend" id="btn" disabled="true" class="btn_blue">Wait for 30 sec</button>
            </div>
        </form>
    </div>

</div>



<script type="text/javascript">

var timer = 29;

var myTimer = setInterval(function(){
    document.getElementById('btn').innerHTML = "Wait for "+timer--+" sec";
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