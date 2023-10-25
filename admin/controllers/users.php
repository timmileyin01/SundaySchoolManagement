<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include(base_app . "database/db.php");
include(base_app . "helpers/validateUser.php");

$errors = array();

$surname = "";
$firstname = "";
$email = "";
$othernames = "";
$admin = "";
$gender = "";
$denomination = "";
$phone_number = "";
$password = "";
$passwordConf = "";
$username = "";

$table = 'users';


if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    $id = $user['id'];
    $_SESSION['use_id'] = $id;
    $surname = $user['surname'];
    $firstname = $user['firstname'];
    $email = $user['email'];
    $othernames = $user['othernames'];
    $admin = $user['admin'];
    $gender = $user['gender'];

    $id_number = $user['id_number'];
}




function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['unique_id'] = $user['unique_id'];

    if ($user['admin'] == 'church_super_admin') {
        $_SESSION['admin'] = 'church_super_admin';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'success';


        header('location: ' . './admin/');

        exit();
    } elseif ($user['admin'] == 'church_teacher') {
        $_SESSION['admin'] = 'church_teacher';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'success';


        header('location: ' . './admin/');

        exit();
    } elseif ($user['admin'] == 'church_member') {
        $_SESSION['admin'] = 'church_member';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'success';


        header('location: ' . './index');

        exit();
    }
}

function loginUserReg($user)
{





    $email = $user['email'];
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function



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

        $verification_code = rand(100000, 999999);;
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

    $_SESSION['message'] = $user['firstname'] . ', Verification code has been sent to your mail box';
    $_SESSION['type'] = 'success';
    $_SESSION['email_verify'] = $email;

    header('location: ' . './email_verification');

    exit();
}

if (isset($_POST['login-btn'])) {
    if (isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {
        $errors = validateLogin($_POST);

        if (count($errors) === 0) {
            $user = selectOne($table, ['email' => $_POST['username'], 'verified' => '1']);
            $user1 = selectOne($table, ['phone_number' => $_POST['username'], 'verified' => '1']);


            if ($user && password_verify($_POST['password'], $user['password'])) {
                loginUser($user);
            } elseif ($user1 && password_verify($_POST['password'], $user1['password'])) {
                loginUser($user1);
            } else {
                array_push($errors, 'wrong credentials or Your Account has not been verified');
            }
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
    } else {
        array_push($errors, 'Something went wrong, Reload Form');
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
}








if (isset($_POST['register'])) {
    if (isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {

        $errors = validateRegister($_POST);

        if (count($errors) === 0) {
            $user_number = $_POST['phone_number'];
            $verify =  selectOne('users', ['phone_number' => $user_number]);


            $_POST['admin'] = urlSaveDecode($_POST['admin']);


            //if the validation of the inputs is error free
            if ($verify && empty($verify['email'])) {
                //if the user has his or her number on the database but have not registered
                $formIndex = 'avatar';


                $filetype = ['jpg', 'png', 'webp', 'jpeg'];


                //$file_s = selectOne('settings', ['id' => 1]);
                // $filesize = $file_s['max_upload'];
                $filesize = 1000000;


                if (!empty($_FILES['avatar']['name'])) {
                    $file_name = time() . '_' . $_FILES['avatar']['name'];
                    $destination = "./admin/uploads/" . $file_name;
                    $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
                    if (count($errors) == 0) {



                        $id = $verify['id'];





                        $_POST['avatar'] = $file_name;

                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $_POST['unique_id'] = bin2hex(random_bytes(16));

                        unset($_POST['register'], $_POST['passwordConf'], $_POST['csrf_token']);


                        $user_id = update($table, $id, $_POST);

                        $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);
                        if ($result) {






                            $login = selectOne($table, ['id' => $id]);
                            loginUserReg($login);
                        } else {
                            array_push($errors, "Failed to Upload Image");
                            $surname = $_POST['surname'];
                            $firstname = $_POST['firstname'];
                            $email = $_POST['email'];
                            $othernames = $_POST['othernames'];
                            $gender = $_POST['gender'];
                            $denomination = $_POST['denomination'];
                            $phone_number = $_POST['phone_number'];
                            $password = $_POST['password'];
                            $passwordConf = $_POST['passwordConf'];
                        }
                    }
                } else {
                    array_push($errors, "Image Required");
                    $surname = $_POST['surname'];
                    $firstname = $_POST['firstname'];
                    $email = $_POST['email'];
                    $othernames = $_POST['othernames'];
                    $gender = $_POST['gender'];
                    $denomination = $_POST['denomination'];
                    $phone_number = $_POST['phone_number'];
                    $password = $_POST['password'];
                    $passwordConf = $_POST['passwordConf'];
                }
            } elseif ($verify && !empty($verify['email'])) {
                array_push($errors, "You have already Registered");
                $surname = $_POST['surname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $othernames = $_POST['othernames'];
                $gender = $_POST['gender'];
                $denomination = $_POST['denomination'];
                $phone_number = $_POST['phone_number'];
                $password = $_POST['password'];
                $passwordConf = $_POST['passwordConf'];
            } else {
                array_push($errors, "You are not allowed to Register");
                $surname = $_POST['surname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $othernames = $_POST['othernames'];
                $gender = $_POST['gender'];
                $denomination = $_POST['denomination'];
                $phone_number = $_POST['phone_number'];
                $password = $_POST['password'];
                $passwordConf = $_POST['passwordConf'];
            }
        } else {
            $surname = $_POST['surname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $othernames = $_POST['othernames'];
            $gender = $_POST['gender'];
            $denomination = $_POST['denomination'];
            $phone_number = $_POST['phone_number'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        }
    } else {
        array_push($errors, 'Something went wrong, Reload Form');
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $othernames = $_POST['othernames'];
        $gender = $_POST['gender'];
        $denomination = $_POST['denomination'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}
