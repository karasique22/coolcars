// Добавление обработчика события клика на кнопку навигации
document.querySelector('.navbar-toggler-button').addEventListener('click', function () {
    document.querySelector('.navbar-icon').classList.toggle('open');
});

document.addEventListener('DOMContentLoaded', function () {
    // Получение всех кнопок "Показать больше"
    var buttons = document.querySelectorAll('.read-more-btn');
    buttons.forEach(function (button) {
        // Добавление обработчика события клика на каждую кнопку
        button.addEventListener('click', function () {
            var arrowIcon = this.querySelector('.arrow-icon');
            arrowIcon.classList.toggle('rotate-180');
        });
    });
});

// Получение элемента загрузчика
var loader = document.querySelector('.loader');

// Функция для анимации исчезновения загрузчика с задержкой
function hideLoader() {
    setTimeout(function () {
        loader.style.opacity = '0'; // Изменяем прозрачность на 0
        setTimeout(function () {
            loader.style.display = 'none'; // Скрываем загрузчик
        }, 1000); // Дополнительная задержка перед скрытием загрузчика (1 секунда)
    }, 1000); // Задержка в 1000 миллисекунд (1 секунда)
}

// Вызов функции для скрытия загрузчика после завершения загрузки контента
window.addEventListener('load', hideLoader);

document.addEventListener("DOMContentLoaded", function () {
    var blocks = document.querySelectorAll(".block");
    var windowHeight = window.innerHeight;

    window.addEventListener("scroll", revealBlocks);

    function revealBlocks() {
        for (var i = 0; i < blocks.length; i++) {
            var blockTop = blocks[i].getBoundingClientRect().top - 50;

            if (blockTop < windowHeight && !blocks[i].classList.contains("fade-in")) {
                blocks[i].classList.add("fade-in");
            }
        }

        // Удаляем обработчик события scroll после первого показа всех блоков
        if (document.querySelectorAll(".fade-in").length === blocks.length) {
            window.removeEventListener("scroll", revealBlocks);
        }
    }

    // Вызываем функцию revealBlocks в начале для отображения блоков, которые уже видны при загрузке страницы
    revealBlocks();
});

function fetchColors(make, configurationId, source) {
    // Создание AJAX-запроса к серверу
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './controllers/get_colors.php?make=' + make + '&configuration=' + configurationId, true);

    // Обработчик события успешного получения данных
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            // Парсинг полученных данных в формат JSON
            var response = JSON.parse(xhr.responseText);

            // Обновление выпадающего списка цветов
            var colorSelect;
            if (source === 'form') {
                colorSelect = document.querySelector('#formColor');
            } else if (source === 'modal') {
                colorSelect = document.querySelector('#' + make + 'Modal .color');
            }

            colorSelect.innerHTML = ''; // Очищаем список цветов

            // Если выбрана опция "Выберите автомобиль", блокируем выпадающий список цветов
            if (make === '') {
                colorSelect.disabled = true;
            } else {
                // Иначе, обновляем список цветов и разблокируем выпадающий список цветов
                response.colors.forEach(function (color) {
                    var option = document.createElement('option');
                    option.value = color;
                    option.textContent = color;
                    colorSelect.appendChild(option);
                });
                colorSelect.disabled = false;
            }
        }
    };

    // Обработчик события ошибки
    xhr.onerror = function () {
        console.error('Произошла ошибка при выполнении AJAX-запроса');
    };

    // Отправка AJAX-запроса
    xhr.send();
}


document.getElementById('car').addEventListener('change', function () {
    var carConf = this.options[this.selectedIndex].dataset.conf;
    document.getElementById('car_configuration').value = carConf;
});