<?php include './includes/formHeader.php'; ?>
    <div class="container form-pages">
        <div class="form">
            
            <h2>Login</h2>


            <form action="signin.php" method="post">
                <input type="text" name="id_number" value="" placeholder="Phone Number or Email">
                <input type="password" name="password"  value="" placeholder="Password">
                <div>
                    <button type="submit" name="login-btn" class="btn">Login</button>
                </div>
                <div class="question" style="display: flex; flex-direction: row; gap: 1rem; align-items: center; justify-content: center;">
                    <span class="text-muted">Not Registered?</span><a href="register.php">Register</a>
                </div>
            </form>
        </div>
        
    </div>
   
              



    <!--links to js-->
    <script src="./admin/assets/js/main.js"></script>
    <script src="./admin/assets/js/theme-toggler.js"></script>
</body>
</html>