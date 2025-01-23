<?php include 'load_header.php';
$done = 0;
if (!empty($_GET['err'])) {

    $done = $_GET['err'];
}
?>

<body class="bg-blue">
    <div id="appCapsule" class="pt-0">
        <div class="login-form mt-1">
            <div class="section">
                <img src="assets/img/design.png" alt="image" class="w-100">
            </div>
            <div class="section mt-1">
                <img src="assets/img/logo.png" alt="image">
                <h3 class="text-white mt-5">Sign In</h3>
            </div>
            <div class="section mt-1 mb-5">
                <form name="Login" id="Login" method="POST" action="auth.php" onsubmit="return validateForm()">
                    <p id="LBL_INFO" style="text-align:center; color:red; font-weight:bold;"></p>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label text-white" for="name1">username</label>
                            <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Username">
                            <span id="validationUsername" style="font-weight:bold; color:red; display:none;">Enter Username</span>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label text-white" for="name1">Password</label>
                            <input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="Password">
                            <span id="validationPassword" style="font-weight:bold; color:red; display:none;">Enter Password</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">NEXT</button>

                </form>
            </div>
        </div>
    </div>
    <?php include 'load_footer.php'; ?>

    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/common.js"></script>
    <script src="scripts/md5.js"></script>
    <script>
        function validateForm() {
            var isValid = true;
            var username = document.getElementById("txtusername").value;
            var password = document.getElementById("txtpassword").value;

            if (username === "") {
                document.getElementById("validationUsername").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("validationUsername").style.display = "none";
            }

            if (password === "") {
                document.getElementById("validationPassword").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("validationPassword").style.display = "none";
            }

            return isValid;
        }
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            $('#txtusername').focus();
            done = "<?php echo $done; ?>";

            if (done == '4')
                $('#LBL_INFO').html(NotifyThis('Invalid Username or Password', 'error'));

            if (done == '6')
                $('#LBL_INFO').html(NotifyThis('Session Expired, Please login again', 'error'));

        });
        $('#Login').submit(function() {
            err = 0;
            ret_val = true;

            var u = $('#txtusername');
            if ($.trim(u.val()) == '') {
                //ShowError( u, "Username cannot be empty");
                err++;
            }

            var p = $('#txtpassword');
            if ($.trim(p.val()) == '') {
                //ShowError( p, "Password cannot be empty");
                err++;
            }
            if (err > 0) {
                ret_val = false;
            } else {
                p_str = b64_md5(p.val());
                p.val(p_str);
            }

            return ret_val;
        });
    </script>
</body>

</html>