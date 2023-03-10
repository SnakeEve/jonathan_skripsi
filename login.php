<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="admin/plugins/jquery/jquery.min.js"></script>
        <script src="admin/plugins/popper/umd/popper.min.js"></script>
        <script src="admin/plugins/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'user_modal_register.php';?>
    
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div class="row justify-content-center">
                <div class="card w-50">
                    <div class="card-body">
                        <form id="login-form" class="form" action="api/login_mahasiswa.php" method="post">
                            <h3 class="text-left">Login Area</h3>
                            <h6 class="text-left text-secondary">Masukkan Email dan Password kamu untuk login</h6>
                            <div class="form-group">
                                <label for="email">Email</label><br>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary btn-md w-100" value="Login">
                            </div>
                            <div id="register-link" class="text-center">
                                OR<br>
                                Kamu tidak memiliki akun? Daftar <a href="javascript:modal_register();">disini</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function modal_register() {
            $("#user_modal").show();
            $('.nav-tabs a[href="#biodata"]').tab('show');
        }

        function closeUserModal() {
            $("#user_modal").hide();
        }
    </script>
</body>
</html>