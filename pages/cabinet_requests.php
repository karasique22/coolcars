<?php
require_once '../config.php';
$mysqli = connect_to_db();

$email = $_SESSION['email'];
$query = "SELECT * FROM applications WHERE email = '$email' ORDER BY created_at DESC";
$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <a class="btn" href="cabinet.php">Личные данные</a>
                <a class="btn text-decoration-underline" href="cabinet_requests.php">Мои заявки</a>
            </div>
            <div class="col-12 col-lg-9">
                <?php foreach ($applications as $application) : ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?php echo $application['car_make']; ?></h5>
                            <div class="row">
                                <div class="col-md-4 text-center text-md-start align-self-center ms-md-5">
                                    <p class="card-text mb-4">Цвет автомобиля: <span class="text-muted"><?php echo $application['car_color']; ?></span></p>
                                    <p class="card-text mb-4">Комплектация: <span class="text-muted"><?php echo $application['car_configuration']; ?></span></p>
                                    <p class="card-text mb-4">Дата заявки: <span class="text-muted"><?php echo $application['created_at']; ?></span></p>
                                    <p class="card-text">Статус: <span class="text-<?php echo ($application['status'] === 'На рассмотрении') ? 'warning' : (($application['status'] === 'Готов к тест-драйву') ? 'success' : 'primary'); ?>"><?php echo $application['status']; ?></span></p>
                                </div>
                                <div class="col">
                                    <img src="../assets/images/<?php echo strtolower($application['car_make']); ?>.jpg" alt="Car" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/javascript/script.js"></script>
</body>

</html>
