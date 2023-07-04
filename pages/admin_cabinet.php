<?php
require_once '../config.php';
$mysqli = connect_to_db();

$query = "SELECT * FROM applications ORDER BY created_at DESC";
$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $applications = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationId = $_POST['applicationId'];
    $newStatus = $_POST['status'];

    $updateQuery = "UPDATE applications SET status = '$newStatus' WHERE id = '$applicationId'";
    $updateResult = mysqli_query($mysqli, $updateQuery);

    if ($updateResult) {
        $response = "Статус заявки успешно обновлен.";
        foreach ($applications as &$application) {
            if ($application['id'] === $applicationId) {
                $application['status'] = $newStatus;
                break;
            }
        }
    } else {
        $response = "Ошибка при обновлении статуса заявки: " . mysqli_error($mysqli);
    }

    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Личный кабинет администратора</title>
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
                <a class="btn btn-outline" href="../index.php" style="font-size: 20px">
                    На главную
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2 class="text-center mt-4 mb-3">Личный кабинет администратора</h2>

        <form>
            <div class="row">
                <div class="col-4">
                    <label class="form-label" for="filter">Поиск</label>
                    <input class="form-control" type="text" id="search-input" name="search" id="">
                </div>
                <div class="col-3 offset-2">
                    <label class="form-label" for="status-filter">Фильтровать по статусу</label>
                    <select class="form-select" name="status-filter" id="status-filter">
                        <option value="" selected>Без фильтра</option>
                        <option value="На рассмотрении">На рассмотрении</option>
                        <option value="На пути в автосалон">На пути в автосалон</option>
                        <option value="Готов">Готов</option>
                    </select>
                </div>
                <div class="col-3">
                    <label class="form-label" for="service-filter">Фильтровать по услуге</label>
                    <select class="form-select" name="service-filter" id="service-filter">
                        <option value="" selected>Без фильтра</option>
                        <option value="Тест-драйв">Тест-драйв</option>
                        <option value="Покупка">Покупка</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-3">
        <div class="">
            <a class="btn btn-primary my-3" href="../controllers/export_report.php" style="font-size: 13px">
                Вывести отчет (CSV)
            </a>

            <div class="btn btn-outline-danger my-3" id="logout-btn" style="font-size: 13px">
                Выйти из аккаунта
            </div>
        </div>
        <div id="status-alert-container"></div>
        <table class="table border-top table-striped">
            <thead>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>№</th>
                    <th>Телефон</th>
                    <th>Автомобиль</th>
                    <th>Услуга</th>
                    <th>Дата оформления</th>
                    <th>Статус заявки</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $application) : ?>
                    <tr>
                        <td><?php echo $application['last_name']; ?></td>
                        <td><?php echo $application['first_name']; ?></td>
                        <td><?php echo $application['id']; ?></td>
                        <td><?php echo $application['phone']; ?></td>
                        <td><?php echo $application['car_make']; ?></td>
                        <td><?php echo $application['service']; ?></td>
                        <td><?php echo $application['created_at']; ?></td>
                        <td>
                            <form class="status-form form-group">
                                <input type="hidden" name="applicationId" value="<?php echo $application['id']; ?>">
                                <select name="status" class="form-select status-select">
                                    <option value="На рассмотрении" <?php if ($application['status'] === 'На рассмотрении') echo 'selected'; ?>>На рассмотрении</option>
                                    <option value="На пути в автосалон" <?php if ($application['status'] === 'На пути в автосалон') echo 'selected'; ?>>На пути в автосалон</option>
                                    <option value="Готов" <?php if ($application['status'] === 'Готов') echo 'selected'; ?>>Готов</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/javascript/jquery-script.js"></script>

    <script>
        $('#search-input').keypress(function(event) {
            if (event.which === 13) {
                event.preventDefault();
                filterApplications();
            }
        });

        $(document).ready(function() {
            function showAlert(message) {
                var alert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                $('#status-alert-container').empty().append(alert);
            }

            $(document).on('change', '.status-select', function() {
                var form = $(this).closest('form');
                var applicationId = form.find('input[name="applicationId"]').val();
                var newStatus = form.find('select[name="status"]').val();

                $.ajax({
                    type: 'POST',
                    url: '../controllers/update_status.php',
                    data: {
                        applicationId: applicationId,
                        status: newStatus
                    },
                    success: function(response) {
                        console.log(response);
                        showAlert(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            function filterApplications() {
                var search = $('#search-input').val();
                var statusFilter = $('#status-filter').val();
                var serviceFilter = $('#service-filter').val();

                $.ajax({
                    type: 'POST',
                    url: '../controllers/filter_applications.php',
                    data: {
                        search: search,
                        statusFilter: statusFilter,
                        serviceFilter: serviceFilter
                    },
                    success: function(response) {
                        $('tbody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }

            $('#search-input').on('input', filterApplications);
            $('#status-filter, #service-filter').change(filterApplications);
        });
    </script>
</body>

</html>