$(function () {
    function showNotification(message, type) {
        var notification = $('<div class="alert text-center"></div>');
        notification.addClass('alert-' + type);
        notification.text(message);

        $('.alert-field').prepend(notification);

        // Плавное появление алерта
        notification.css('opacity', 0).animate({ opacity: 1 }, 500);

        // Автоматическое закрытие уведомления через 3 секунды
        setTimeout(function () {
            notification.fadeOut(500, function () {
                $(this).remove();
            });
        }, 3000);
    }


    var prevFirstName = $('#name').val();
    var prevPhone = $('#tel').val();
    $('.cabinet-form input').on('change', function () {
        var firstName = $('#name').val();
        var lastName = $('#surname').val();
        var patronymic = $('#patronymic').val();
        var phone = $('#tel').val();
        var birthdate = $('#birthday').val();

        console.log(prevFirstName);
        console.log(prevPhone);
        // Проверка на пустое значение поля имени
        if (firstName.trim() === '') {
            $('#name').val(prevFirstName); // Восстановление предыдущего значения
            showNotification('Поле "Имя" не может быть пустым', 'danger');
            return;
        }

        // Проверка на пустое значение поля телефона
        if (phone.trim() === '') {
            $('#tel').val(prevPhone); // Восстановление предыдущего значения
            showNotification('Поле "Телефон" не может быть пустым', 'danger');
            return;
        }

        var phonePattern = /^\+\d{1,3}\s?\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/;
        if (!phonePattern.test(phone)) {
            $('#tel').val(prevPhone); // Восстановление предыдущего значения
            showNotification('Введите номер телефона в правильном формате', 'danger');
            return; // Прекратить выполнение кода, если формат неверный
        }

        // Отправка AJAX-запроса
        $.ajax({
            url: '../controllers/update_profile.php',
            type: 'POST',
            data: {
                firstName: firstName,
                lastName: lastName,
                patronymic: patronymic,
                phone: phone,
                birthdate: birthdate
            },
            success: function (response) {
                if (response === 'success') {
                    // Обновление успешно выполнено
                    console.log('Данные успешно обновлены');
                    showNotification('Данные успешно обновлены', 'success');
                    prevFirstName = firstName;
                    prevPhone = phone;
                } else {
                    // Произошла ошибка при обновлении данных
                    console.log('Ошибка при обновлении данных');
                    showNotification('Ошибка при обновлении данных', 'error');
                }
            },
            error: function () {
                console.log('Произошла ошибка');
                showNotification('Произошла ошибка', 'error');
            }
        });
    });
});

document.getElementById('logout-btn').addEventListener('click', function() {
    if (confirm("Вы действительно хотите выйти из аккаунта?")) {
        // Отправка POST-запроса для выхода из аккаунта
        fetch('../controllers/logout.php', {
            method: 'POST'
        })
        .then(function(response) {
            if (response.ok) {
                console.log('Выход из аккаунта выполнен успешно');
                // Перенаправление на страницу авторизации с параметром message=logout
                window.location.href = '../index.php?message=logout';
            } else {
                console.log('Ошибка при выходе из аккаунта');
            }
        })
        .catch(function(error) {
            console.log('Произошла ошибка');
        });
    }
});
