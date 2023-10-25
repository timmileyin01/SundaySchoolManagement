<?php





include './includes/formHeader.php';
include './admin/controllers/users.php';

$_SESSION['email'] = mysqli_real_escape_string($conn, $_GET['email']);
$_SESSION['verification_code'] = mysqli_real_escape_string($conn, $_GET['token']);



$errors = array();

$password = "";
$passwordConf = "";

if (isset($_POST['update'])) {


    if (isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {

        if (!empty($_POST['password'])) {



            if ($_POST['password'] === $_POST['passwordConf']) {

                $email = $_SESSION['email'];


                $user = selectOne('users', ['email' => $email]);

                if ($user) {

                    $verification_code = $_SESSION['verification_code'];





                    if ($verification_code === $user['verification_code']) {
                        $id = $user['id'];

                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $content = array('password' => $password, 'verification_code' => null);



                        $id = $user['id'];

                        $user_id = update('users', $id, $content);

                        unset($_SESSION['email'], $_SESSION['verification_code']);

                        $_SESSION['message'] = $user['firstname'] . ' Your Password has been changed Successfully ';
                        $_SESSION['type'] = 'success';


                        header('location: ' . './login');

                        exit();
                    } else {
                        array_push($errors, "Invalid Verification Link");
                        $password = $_POST['password'];
                        $passwordConf = $_POST['passwordConf'];
                    }
                } else {
                    array_push($errors, "No user found");
                    $password = $_POST['password'];
                    $passwordConf = $_POST['passwordConf'];
                }
            } else {
                array_push($errors, "Passwords do not match");
                $password = $_POST['password'];
                $passwordConf = $_POST['passwordConf'];
            }
        } else {
            array_push($errors, "Enter Password");
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        }
    } else {
        array_push($errors, 'Something went wrong, Reload Form');
    }
}






?>

<div class="container form-pages">
    <div class="form">

        <h2>Email Verification</h2>
        <?php include './admin/includes/messages.php'; ?>
        <?php include './admin/helpers/formErrors.php';



        ?>


        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= createToken(); ?>">
            <input type="password" name="password" value="<?= $password ?>" placeholder="New Password">
            <input type="password" name="passwordConf" value="<?= $password ?>" placeholder="Confirm Password">
            <div>
                <button type="submit" name="update" class="btn">Update</button>
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