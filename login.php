<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    

        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'user_modal_register.php';?>
    
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div class="row justify-content-center">
                <div class="card w-50">
                    <div class="card-body">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-left">Login Area</h3>
                            <h6 class="text-left text-secondary">Masukkan Email dan Password kamu untuk login</h6>
                            <div class="form-group">
                                <label for="email">Email</label><br>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label><br>
                                <input type="text" name="password" id="password" class="form-control">
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
        $(document).ready(function() {

        });

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