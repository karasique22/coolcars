<!DOCTYPE html>
<html>

<head>
    <title>Личный кабинет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    $message = $_GET['message'] ?? '';
    if (!empty($message)) {
        echo '<div class="alert m-0 text-center alert-warning alert-dismissible fade show" role="alert">';
        echo $message;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    ?>


    <header>
        <nav class="navbar navbar-expand-lg navbar-light py-4">
            <div class="container navbar-container">
                <a class="navbar-brand" href="#">
                    <div class="logo-text fw-bold">Coolcars</div>
                </a>
                <a class="btn btn-outline animated-underline" href="../index.php" style="font-size: 20px">
                    На главную
                </a>
            </div>
        </nav>
    </header>

    <div class="container my-5">
        <form action="../controllers/auth_process.php" method="POST">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <h6 class="text-center" style="font-weight: 400; font-size: 36px">Вход</h6>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Пароль</label>
                        <input type="password" class="form-control" id="phone" name="password">
                        <small id="lastName" class="form-text text-muted">Пароль придет к вам на почту, которую вы указывали</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4 mb-3">Войти</button>
                    </div>
                    <div class="text-center">
                        <a href="register.php" type="button" class="btn btn-outline-primary">Регистрация</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/javascript/script.js"></script>
</body>

</html>