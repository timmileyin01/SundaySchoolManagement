
<?php 




include './includes/formHeader.php'; 
include './admin/controllers/users.php';





?>

    <div class="container form-pages">
        <div class="form">
            <h2>Register</h2>
            <?php include './admin/helpers/formErrors.php'; ?>
            <form action="register" method="post" enctype="multipart/form-data">

                <input type="hidden" name="csrf_token" value="<?= createToken(); ?>">

            <input type="text" name="surname" value="<?= $surname ?>" placeholder="Surname">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="Firstname">
                <input type="text" name="othernames" value="<?= $othernames ?>" placeholder="Other Names">
                <select name="gender" id="sort-item">
                    <option value="">Select gender...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <input type="hidden" name="admin" value="<?php $m = 'church_member'; echo(urlSaveEncode($m)); ?>">
                
                <input type="text" name="phone_number" value="<?= $phone_number ?>" placeholder="Phone Number">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email Address">
                <input type="password" id="password" value="<?= $password ?>" name="password" placeholder="Password">
                <input type="password" id="confirmpassword" value="<?= $passwordConf ?>" name="passwordConf" placeholder="Confirm Password">

                <div class="form-control">
                    <h3>Denomination</h3>
                    <select name="denomination" id="sort-item">
                        <option value="">Select denomination...</option>
                        <option value="cradle">Cradle Rendezvous</option>
                        <option value="rehoboth">Victory Rendezvous</option>
                    </select>
                </div>
                
                <div class="form-control">
                    <h3>Add Image</h3>
                    <input type="file" name="avatar">
                </div>
                <div>
                    <button type="submit" name="register" class="btn">Register</button>
                </div>
                <div class="question" style="display: flex; flex-direction: row; gap: 1rem; align-items: center; justify-content: center;">
                    <span class="text-muted">Already Registered?</span><a href="signin">Login</a>
                </div>
            </form>
        </div>
    </div>



    <!--links to js-->
    <script src="./admin/assets/js/main.js"></script>
    <script src="./admin/assets/js/theme-toggler.js"></script>
</body>

</html>