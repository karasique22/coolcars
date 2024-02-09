<?php
require_once '../config.php';
$mysqli = connect_to_db();

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Данные пользователя не найдены";
    header("Location: ../index.php");
    exit;
}
?>

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

    <div class="container my-5 mx-auto">
        <div class="row justify-content-center text-center mb-md-4">
            <div class="col-md-6 justify-self-center">
                <h2>Личный кабинет</h2>
            </div>
            <div class="col-md-6">
                <a class="btn text-decoration-underline" href="cabinet.php">Личные данные</a>
                <a class="btn" href="cabinet_requests.php">Мои заявки</a>
            </div>
        </div>

        <div class="alert-field">
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-center text-center px-5 px-md-0">
                    <form class="cabinet-form mx-auto" action="">
                        <div class="form-group d-flex flex-row-reverse mb-3">
                            <input type="text" class="form-control" id="name" value="<?php echo $user['first_name']; ?>">
                            <label for="name" class="align-self-end me-4">Имя (обязательно)</label>
                        </div>
                        <div class="form-group d-flex flex-row-reverse mb-3">
                            <input type="text" class="form-control" id="surname" value="<?php echo $user['last_name']; ?>">
                            <label for="surname" class="align-self-end me-4">Фамилия</label>
                        </div>
                        <div class="form-group d-flex flex-row-reverse mb-3">
                            <input type="text" class="form-control" id="patronymic" value="<?php echo $user['patronymic']; ?>">
                            <label for="patronymic" class="align-self-end me-4">Отчество</label>
                        </div>
                        <div class="form-group d-flex flex-row-reverse mb-3">
                            <input type="text" class="form-control" id="tel" value="<?php echo $user['phone']; ?>">
                            <label for="tel" class="align-self-end me-4">Телефон (обязательно)</label>
                        </div>
                        <div class="form-group d-flex flex-row-reverse">
                            <input type="date" class="form-control" id="birthday" value="<?php echo $user['birthdate']; ?>">
                            <label for="birthday" class="align-self-end me-4">Дата рождения</label>
                        </div>
                        <div class="text-muted text-center mt-3">Нажмите на любое поле для редактирования</div>
                        <button class="btn btn-danger mt-4" id="logout-btn">Выйти из аккаунта</button>
                    </form>
                </div>
                <!-- TODO: таблица с менеджерами и вывод -->
                <div class="col-12 manager-card col-md-6 d-flex justify-content-center">
                    <div class="card">
                        <p class="card-title text-center mt-4">Ваш ведущий менеджер:</p>
                        <img class="card-img-top d-sm-none mx-auto" src="../assets/images/manager.png" alt="Title" style="width: 11rem">
                        <div class="card-body d-flex">
                            <img class="card-img-top d-none d-sm-block" src="../assets/images/manager.png" alt="Title" style="width: 11rem">
                            <div class="align-self-center text-center flex-fill ms-2 ms-xl-0 p-3">
                                <p class="card-text fw-bolder m-0">Мененеджеров</p>
                                <p class="card-text m-0">Менеджер</p>
                                <p class="card-text m-0">Менеджерович</p>
                                <!-- TODO: функционал кнопки обратного звонка -->
                                <button class="btn btn-primary mt-4">Обратный звонок</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/javascript/jquery-script.js"></script>
    <script src="../assets/javascript/script.js"></script>
</body>

</html>