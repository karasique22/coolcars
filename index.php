<?php
require_once 'config.php';

if (isset($_SESSION['email'])) {
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
        $redirectUrl = 'pages/admin_cabinet.php';
    } else {
        $redirectUrl = 'pages/cabinet.php';
    }
} else {
    $redirectUrl = 'pages/auth.php';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Coolcars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="mb-5">
    <div class="loader"></div>

    <?php
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        if ($message === "success") {
            echo '<div class="alert alert-success text-center m-0">Заявка успешно отправлена. Она будет отображена в вашем личном кабинете.</div>';
        } elseif ($message === "fault") {
            echo '<div class="alert alert-danger text-center m-0">Ошибка при сохранении данных в базе данных.</div>';
        } elseif ($message === "logout") {
            echo '<div class="alert alert-info text-center m-0">Вы успешно вышли из аккаунта.</div>';
        } elseif ($message === "registered") {
            echo '<div class="alert alert-info text-center m-0">Ошибка. Пользователь с таким email уже зарегистрирован.</div>';
        }
    }
    ?>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light py-4">
            <div class="container navbar-container">
                <a class="navbar-brand" href="#">
                    <div class="logo-text fw-bold">Coolcars</div>
                </a>
                <div class="d-flex">
                    <button class="navbar-toggler navbar-toggler-button me-sm-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключатель навигации">
                        <div class="navbar-icon"><span></span><span></span><span></span><span></span></div>
                    </button>
                    <div class="person-icon d-none d-sm-block d-lg-none ps-4">
                        <a href="<?php echo $redirectUrl; ?>">
                            <img src="assets/images/person.svg" alt="Личный кабинет" width="37" height="37">
                        </a>
                    </div>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-nowrap animated-underline" href="#about">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-nowrap animated-underline" href="#catalog">Каталог</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-nowrap animated-underline" href="#testdrive">Тест-драйв</a>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link text-nowrap animated-underline" href="<?php echo $redirectUrl; ?>">Личный кабинет</a>
                        </li>
                    </ul>
                </div>
                <div class="person-icon d-none d-lg-block ps-4">
                    <a href="<?php echo $redirectUrl; ?>">
                        <img src="assets/images/person.svg" alt="Личный кабинет" width="37" height="37">
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="card m-0 p-0 border-0 text-white d-none d-md-block">
        <img src="assets/images/bentley-card1.png" class="img-fluid" alt="">
        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center col-6 offset-6 text-center">
            <p class="card-title header-card-title mb-3 mb-lg-5 display-5">Ощутите уникальный
                комфорт вождения
                с Bentley Continental</p>
            <a href="#testdrive" class="btn btn-primary btn-lg car-button">
                <img src="assets/images/car.svg" class="car-icon" alt="" width="40px">
                Записаться на тест-драйв
            </a>
        </div>
    </div>

    <div class="card m-0 p-0 border-0 text-white d-md-none" style="height: 27rem">
        <img src="assets/images/bentley-card.png" class="img-fluid header-img" alt="">
        <div class="card-img-overlay d-flex flex-column justify-content-between align-items-center text-center">
            <p class="card-title header-card-title mb-3 mb-lg-5 display-6">Ощутите уникальный комфорт вождения с Bentley Continental</p>
            <a href="#testdrive" class="btn btn-primary btn-lg mb-2 mb-sm-0" style="max-width: max-content">Записаться на тест-драйв</a>
        </div>
    </div>


    <h class="display-5 justify-content-center d-flex mt-4 header-text" id="about">О нас</h>
    <div class="container block">
        <div class="row">
            <div class="col-12 col-lg-5">
                <h1 class="text-center mt-4 mb-0 blue-text d-none d-lg-block">Воплощаем ваши</h1>
                <h1 class="text-center mb-3 blue-text d-none d-lg-block">мечты на колесах!</h1>
                <div class="about-us-text d-md-block text-justify px-4 p-md-0">
                    <div class="full-text collapse d-lg-block" id="textCollapse">
                        Наша компания находится на рынке уже много лет. За это время мы получили обширный опыт работы с различными марками автомобилей, как на местном, так и на международном уровне. Мы гордимся тем, что предлагаем только самые высококачественные автомобили, которые соответствуют самым высоким стандартам качества.
                        Наша команда состоит из профессионалов, которые всегда готовы помочь Вам выбрать автомобиль, который идеально подходит именно Вам. Мы понимаем, что покупка автомобиля - это большой шаг, поэтому мы всегда стремимся предоставить нашим клиентам максимальную поддержку и содействие на всех этапах покупки.
                    </div>
                    <button class="btn btn-outline-primary read-more-btn d-lg-none d-block mx-auto mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#textCollapse" aria-expanded="false" aria-controls="textCollapse">
                        Подробнее о компании
                        <img class="arrow-icon" src="assets/images/caret-down.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-12 col-lg-5 mt-4">
                <div class="card p-4">
                    <h4 class="text-center mb-4">Что говорят о нас?</h4>
                    <div class="container px-4">
                        <blockquote class="blockquote text-justify">
                            <p>Я очень доволен покупкой автомобиля в Coolcars! Профессиональные менеджеры помогли мне выбрать машину, и я получил отличный сервис. Спасибо!</p>
                        </blockquote>
                        <figcaption class="blockquote-footer text-center">
                            Александр Иванов, очень богатый человек
                            <hr>
                        </figcaption>
                    </div>
                    <div class="container px-4">
                        <blockquote class="blockquote text-justify">
                            <p>Огромное спасибо компании за быстрое и качественное обслуживание! Мне очень понравилось, что менеджеры нашли мне идеальную машину в соответствии с моим бюджетом и пожеланиями. Я обязательно вернусь сюда за следующим автомобилем!</p>
                        </blockquote>
                        <figcaption class="blockquote-footer text-center">
                            Елена Кузнецова, самая богатая женщина в мире
                            <hr>
                        </figcaption>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <h class="display-5 justify-content-center d-flex mt-4 header-text" id="catalog">Каталог</h>
    <div class="container block">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card text-center">
                    <img class="card-img-top" src="assets/images/Bentley.jpg" alt="Bentley">
                    <div class="card-body px-4">
                        <h4 class="card-title">Bentley</h4>
                        <p class="card-text d-none d-md-block">Купе-кабриолет, в котором сочетаются элегантный дизайн и
                            мощность. Эта модель оснащена 12-цилиндровым двигателем, который позволяет
                            развивать высокую скорость. Внутри салона Bentley вы найдете роскошные
                            материалы, удобные кресла и передовые технологии.</p>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bentleyModal">Подробнее</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card text-center">
                    <img class="card-img-top" src="assets/images/BMW.jpg" alt="BMW">
                    <div class="card-body px-4">
                        <h4 class="card-title">BMW</h4>
                        <p class="card-text d-none d-md-block">Благородный и элегантный автомобиль,
                            который сочетает в себе роскошь и передовые технологии. BMW - это искусство
                            инженерии и страсть к вождению. Сочетание мощных двигателей и изысканного дизайна
                            делает каждую поездку за рулем BMW незабываемым опытом.</p>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bmwModal">Подробнее</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card text-center">
                    <img class="card-img-top" src="assets/images/Mercedes.jpg" alt="Mercedes-Benz">
                    <div class="card-body px-4">
                        <h4 class="card-title">Mercedes-Benz</h4>
                        <p class="card-text d-none d-md-block">Флагманский автомобиль, который предлагает высочайший
                            уровень комфорта и безопасности. Mercedes оснащен передовыми
                            технологиями, например, системой Magic Body Control, которая позволяет
                            автомобилю сканировать дорогу и приспосабливаться к ней.</p>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#mercedesModal">Подробнее</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card text-center">
                    <img class="card-img-top" src="assets/images/rolls-royce.jpg" alt="Rolls-Royce">
                    <div class="card-body px-4">
                        <h4 class="card-title">Rolls-Royce</h4>
                        <p class="card-text d-none d-md-block">Престижный седан, который объединяет в себе современный
                            дизайн и традиционный роскошный стиль легендарных автомобилей Rolls-Royce. Ghost оснащен мощным
                            V12-двигателем и обеспечивает непревзойденный уровень комфорта и роскоши
                            внутри автомобиля.</p>
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#rollsRoyceModal">Подробнее</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TODO: шаблон модальных окон -->
    <!-- Модальное окно Bentley -->
    <div class="modal fade" id="bentleyModal" tabindex="-1" aria-labelledby="bentleyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bentleyModalLabel">Bentley Continental</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controllers/save_application.php" method="POST">
                    <input type="hidden" name="car_make" value="Bentley">
                    <input type="hidden" name="source" value="modal">
                    <div class="modal-body">
                        <p>Характеристики автомобиля Bentley Continental:</p>
                        <ul>
                            <li>Тип: Купе-кабриолет</li>
                            <li>Двигатель: 8-цилиндровый</li>
                            <li>Цвета: Различные варианты</li>
                        </ul>
                        <p>Выберите комплектацию и цвет автомобиля:</p>
                        <div class="mb-3">
                            <label for="bentleyConfiguration" class="form-label">Комплектация:</label>
                            <select class="form-select configuration" id="bentleyConfiguration" required name="car_configuration" onchange="fetchColors('bentley', this.value, 'modal')">
                                <option value="">Выберите комплектацию</option>
                                <?php
                                $mysqli = connect_to_db();
                                $query = "SELECT * FROM configurations 
                                WHERE id IN (SELECT DISTINCT configuration_id FROM cars WHERE make = 'Bentley')";
                                $result = $mysqli->query($query);

                                $configurations = array();
                                while ($row = $result->fetch_assoc()) {
                                    $configurations[$row['id']] = $row['name'];
                                }

                                foreach ($configurations as $id => $name) {
                                    echo '<option required value="' . $id . '">' . $name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bentleyColor" class="form-label">Цвет:</label>
                            <select class="form-select color" name="car_color" id="bentleyColor" disabled></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <button type="submit" class="btn btn-primary" name="service" value="Тест-драйв">Тест-драйв</button>
                            <button type="submit" class="btn btn-primary" name="service" value="Покупка">Купить</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary test-drive-btn" data-bs-dismiss="modal" onclick="scrollToTestDriveForm()">Тест-драйв</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="handleBuy()">Купить</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Модальное окно BMW -->
    <div class="modal fade" id="bmwModal" tabindex="-1" aria-labelledby="bmwModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bmwModalLabel">BMW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controllers/save_application.php" method="POST">
                    <input type="hidden" name="car_make" value="BMW">
                    <input type="hidden" name="source" value="modal">
                    <div class="modal-body">
                        <p>Характеристики автомобиля BMW:</p>
                        <ul>
                            <li>Тип: Благородный и элегантный автомобиль</li>
                            <li>Двигатель: 6-цилиндровый</li>
                            <li>Цвета: Различные варианты</li>
                        </ul>
                        <p>Выберите комплектацию и цвет автомобиля:</p>
                        <div class="mb-3">
                            <label for="bmwConfiguration" class="form-label">Комплектация:</label>
                            <select class="form-select configuration" id="bmwConfiguration" required name="car_configuration" onchange="fetchColors('bmw', this.value, 'modal')">
                                <option value="">Выберите комплектацию</option>
                                <?php
                                $mysqli = connect_to_db();
                                $query = "SELECT * FROM configurations 
                            WHERE id IN (SELECT DISTINCT configuration_id FROM cars WHERE make = 'BMW')";
                                $result = $mysqli->query($query);

                                $configurations = array();
                                while ($row = $result->fetch_assoc()) {
                                    $configurations[$row['id']] = $row['name'];
                                }

                                foreach ($configurations as $id => $name) {
                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bmwColor" class="form-label">Цвет:</label>
                            <select class="form-select color" name="car_color" id="bmwColor" disabled></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <button type="submit" class="btn btn-primary" name="service" value="Тест-драйв">Тест-драйв</button>
                            <button type="submit" class="btn btn-primary" name="service" value="Покупка">Купить</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="scrollToTestDriveForm()">Тест-драйв</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="handleBuy()">Купить</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Модальное окно Mercedes-Benz -->
    <div class="modal fade" id="mercedesModal" tabindex="-1" aria-labelledby="mercedesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mercedesModalLabel">Mercedes-Benz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controllers/save_application.php" method="POST">
                    <input type="hidden" name="car_make" value="Mercedes">
                    <input type="hidden" name="source" value="modal">
                    <div class="modal-body">
                        <p>Характеристики автомобиля Mercedes-Benz:</p>
                        <ul>
                            <li>Тип: Флагманский автомобиль</li>
                            <li>Двигатель: 6-цилиндровый</li>
                            <li>Цвета: Различные варианты</li>
                        </ul>
                        <p>Выберите комплектацию и цвет автомобиля:</p>
                        <div class="mb-3">
                            <label for="mercedesConfiguration" class="form-label">Комплектация:</label>
                            <select class="form-select configuration" name="car_configuration" required id="mercedesConfiguration" onchange="fetchColors('mercedes', this.value, 'modal')">
                                <option value="">Выберите комплектацию</option>
                                <?php
                                $mysqli = connect_to_db();
                                $query = "SELECT * FROM configurations 
                            WHERE id IN (SELECT DISTINCT configuration_id FROM cars WHERE make = 'mercedes')";
                                $result = $mysqli->query($query);

                                $configurations = array();
                                while ($row = $result->fetch_assoc()) {
                                    $configurations[$row['id']] = $row['name'];
                                }

                                foreach ($configurations as $id => $name) {
                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mercedesColor" class="form-label">Цвет:</label>
                            <select class="form-select color" name="car_color" id="mercedesColor" disabled></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <button type="submit" class="btn btn-primary" name="service" value="Тест-драйв">Тест-драйв</button>
                            <button type="submit" class="btn btn-primary" name="service" value="Покупка">Купить</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="scrollToTestDriveForm()">Тест-драйв</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="handleBuy()">Купить</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Модальное окно Rolls-Royce -->
    <div class="modal fade" id="rollsRoyceModal" tabindex="-1" aria-labelledby="rollsRoyceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rollsRoyceModalLabel">Rolls-Royce</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controllers/save_application.php" method="POST">
                    <input type="hidden" name="car_make" value="Rolls-Royce">
                    <input type="hidden" name="source" value="modal">
                    <div class="modal-body">
                        <p>Характеристики автомобиля Rolls-Royce:</p>
                        <ul>
                            <li>Тип: Престижный седан</li>
                            <li>Двигатель: 12-цилиндровый</li>
                            <li>Цвета: Различные варианты</li>
                        </ul>
                        <p>Выберите комплектацию и цвет автомобиля:</p>
                        <div class="mb-3">
                            <label for="rollsRoyceConfiguration" class="form-label">Комплектация:</label>
                            <select class="form-select configuration" name="car_configuration" required id="rollsRoyceConfiguration" onchange="fetchColors('rollsRoyce', this.value, 'modal')">
                                <option value="">Выберите комплектацию</option>
                                <?php
                                $mysqli = connect_to_db();
                                $query = "SELECT * FROM configurations 
                            WHERE id IN (SELECT DISTINCT configuration_id FROM cars WHERE make = 'rollsroyce')";
                                $result = $mysqli->query($query);

                                $configurations = array();
                                while ($row = $result->fetch_assoc()) {
                                    $configurations[$row['id']] = $row['name'];
                                }

                                foreach ($configurations as $id => $name) {
                                    echo '<option value="' . $id . '">' . $name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rollsRoyceColor" class="form-label">Цвет:</label>
                            <select class="form-select color" name="car_color" id="rollsRoyceColor" disabled></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <button type="submit" class="btn btn-primary" name="service" value="Тест-драйв">Тест-драйв</button>
                            <button type="submit" class="btn btn-primary" name="service" value="Покупка">Купить</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="scrollToTestDriveForm()">Тест-драйв</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="handleBuy()">Купить</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TODO: передача данных о тест драйве в форму -->
    <div class="block" id="testDriveBlock">
        <h class="display-5 justify-content-center d-flex mt-4 header-text mb-0 text-center">Запишитесь на тест драйв</h>
        <h class="display-5 justify-content-center d-flex mb-2 header-text blue-text mt-0" style="font-size: 48px;">прямо сейчас</h>

        <div class="container">
            <form class="text-center" action="controllers/save_application.php" method="POST">
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Иван">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required placeholder="+7 (905) 123-45-67" pattern="^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="ivan-ivanovich@mail.ru">
                            <small id="emailHelp" class="form-text text-muted text-break">На почту придет пароль для вашего личного кабинета.</small>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="car">Выбор автомобиля</label>
                            <select class="form-select" id="car" name="car_make" required onchange="fetchColors(this.value, this.options[this.selectedIndex].dataset.conf, 'form')">
                                <option value="">Выберите автомобиль</option>
                                <option data-conf="1" value="Bentley">Bentley (стандартная комплектация)</option>
                                <option data-conf="2" value="Bentley">Bentley (полная комплектация)</option>
                                <option data-conf="1" value="BMW">BMW (стандартная комплектация)</option>
                                <option data-conf="2" value="BMW">BMW (полная комплектация)</option>
                                <option data-conf="1" value="Mercedes">Mercedes-Benz (стандартная комплектация)</option>
                                <option data-conf="2" value="Mercedes">Mercedes-Benz (полная комплектация)</option>
                                <option data-conf="1" value="RollsRoyce">Rolls-Royce (стандартная комплектация)</option>
                                <option data-conf="2" value="RollsRoyce">Rolls-Royce (полная комплектация)</option>
                                <input type="hidden" id="car_configuration" name="car_configuration" value="">
                                <input type="hidden" name="source" value="form">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="color">Цвет автомобиля</label>
                            <select class="form-select color" id="formColor" name="car_color" required disabled></select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10 col-md-6 col-lg-4 mt-2">
                        <button type="submit" class="btn btn-primary" name="service" value="Тест-драйв">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/javascript/script.js"></script>
    <script>
        function handleBuy() {
            var isAuthenticated = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
            if (!isAuthenticated) {
                var message = encodeURIComponent('Для покупки необходимо войти в аккаунт.');
                window.location.href = 'pages/auth.php?message=' + message;
            }
        }


        function scrollToTestDriveForm() {
            var testDriveForm = document.getElementById('testDriveBlock');
            if (testDriveForm) {
                var offsetTop = testDriveForm.getBoundingClientRect().top + window.pageYOffset;
                var scrollOptions = {
                    top: offsetTop,
                    behavior: 'smooth'
                };
                testDriveForm.classList.remove('block');
                setTimeout(function() {
                    window.scrollTo(scrollOptions);
                }, 100);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const nameInput = document.querySelector("#testDriveBlock #name");
            const isLoggedIn = "<?php echo isset($_SESSION['email']); ?>";
            console.log(isLoggedIn);

            if (isLoggedIn) {
                nameInput.addEventListener("change", function(event) {
                    const confirmed = confirm("Внимание! Если вы отправите заявку, то она будет оформлена на нового пользователя. Продолжить?");
                    if (!confirmed) {
                        event.preventDefault();
                    }
                });
            }
        });
    </script>
</body>

</html>