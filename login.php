<?php include './includes/formHeader.php';
include './admin/controllers/users.php'; 






if (isset($_POST['reset'])) {
   header('location: ' . './password_reset'); 
}





?>

<div class="container form-pages">
    <div class="form">

        <h2>Login</h2>
        <?php include './admin/includes/messages.php'; ?>
        <?php include './admin/helpers/formErrors.php'; ?>


        <form action="login" method="post">
        <input type="hidden" name="csrf_token" value="<?= createToken(); ?>">


            <input type="text" name="username" value="<?= $username ?>" placeholder="Email or Phone Number">



            <input type="password" name="password" value="<?= $password ?>" placeholder="Password">


            <div>
                <button type="submit" name="login-btn" class="btn">Login</button>
            </div>

            <div class="form-control">
            <div class="question" style="display: flex; flex-direction: row; gap: 1rem; align-items: center;">
                <span class="text-muted">Not Registered?</span><a href="register" class="btn_blue">Register</a>
            </div>
            <form action="" method="post">

                <div>
                    <span class="text-muted">Forgot Password?</span>
                    <button type="submit" name="reset" class="btn_blue">Reset</button>
                </div>
            </form>

            </div>
        </form>
    </div>

</div>





<!--links to js-->
<script src="./admin/assets/js/main.js"></script>
<script src="./admin/assets/js/theme-toggler.js"></script>
</body>

</html>