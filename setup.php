<?php include './includes/formHeader.php'; ?>
    <div class="container form-pages">
        <div class="form">
            <h2>Website Setup</h2>
            
            <form action="settings.php" method="post" enctype="multipart/form-data">
                <div class="form-control">
                    <h3>User Details</h3>
                    <span class="text-muted">Note! These details will be used for managing this website</span>
                    <input name="username" value="" type="text" placeholder="Username">
                    <input name="password" value="" type="text" placeholder="Password">
                    <input name="confirmpassword" value="" type="text" placeholder="Confirm your Password">
                </div>
                
                <div class="form-control">
                    <h3>Site title</h3>
                    <input name="title" value="" type="text">
                </div>
                <div class="form-control">
                    <h3>Site logo</h3>
                    <input name="image" type="file">
                </div>
                <div class="form-control">
                <h3>Site description</h3>
                    <textarea name="description" rows="5" placeholder="site description"></textarea>
                </div>
                <div class="form-control">
                    <h3>Max-upload size</h3>
                    <select name="max_upload">
                        <option value="">Max upload size</option>
                        <option value="5000000">5mb</option>
                        <option value="10000000">10mb</option>
                        <option value="15000000">15mb</option>
                        <option value="20000000">20mb</option>
                        <option value="25000000">25mb</option>
                        <option value="30000000">30mb</option>
                    </select>
                </div>
                <div>
                    <button type="submit" name="update" class="btn">Update</button>
                </div>
            </form>
        </div>
    </div>
   
              



    <!--links to js-->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/theme-toggler.js"></script>
</body>
</html>