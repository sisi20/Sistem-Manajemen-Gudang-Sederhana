<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Inventory System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

    <style>
        body.login-page {
            background-color: #121212;
            /* dark background */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .login-card {
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(71, 65, 65, 0.5);
            overflow: hidden;
            background-color: #9e9999ff;
            /* dark card */
        }

        .login-card .card-header {
            background-color: #343434ff;
            color: #fff;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .login-card .card-body {
            padding: 2rem;
        }

        .form-control {
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #fff;
        }

        .form-control:focus {
            background-color: #2c2c2c;
            color: #fff;
            border-color: #777;
            box-shadow: none;
        }

        .input-group-text {
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #fff;
        }

        .btn-login {
            background-color: #444;
            border: none;
            color: #fff;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #666;
        }

        .alert {
            font-size: 0.9rem;
            text-align: center;
            background-color: #b71c1c;
            color: #fff;
            border: none;
        }
    </style>
</head>

<body class="login-page">

    <div class="login-card card" style="width: 350px;">
        <div class="card-header">
            Inventory System
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-login btn-block">Sign In</button>
            </form>
        </div>
    </div>

    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>