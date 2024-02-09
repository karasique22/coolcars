document.querySelector('.navbar-toggler-button').addEventListener('click', function () {
    document.querySelector('.navbar-icon').classList.toggle('open');
});

document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.querySelectorAll('.read-more-btn');
    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            var arrowIcon = this.querySelector('.arrow-icon');
            arrowIcon.classList.toggle('rotate-180');
        });
    });
});

var loader = document.querySelector('.loader');

function hideLoader() {
    setTimeout(function () {
        loader.style.opacity = '0';
        setTimeout(function () {
            loader.style.display = 'none';
        }, 1000);
    }, 1000);
}

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

        if (document.querySelectorAll(".fade-in").length === blocks.length) {
            window.removeEventListener("scroll", revealBlocks);
        }
    }

    revealBlocks();
});

function fetchColors(make, configurationId, source) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './controllers/get_colors.php?make=' + make + '&configuration=' + configurationId, true);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);

            var colorSelect;
            if (source === 'form') {
                colorSelect = document.querySelector('#formColor');
            } else if (source === 'modal') {
                colorSelect = document.querySelector('#' + make + 'Modal .color');
            }

            colorSelect.innerHTML = '';

            if (make === '') {
                colorSelect.disabled = true;
            } else {
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

    xhr.onerror = function () {
        console.error('Произошла ошибка при выполнении AJAX-запроса');
    };

    xhr.send();
}

document.getElementById('car').addEventListener('change', function () {
    var carConf = this.options[this.selectedIndex].dataset.conf;
    document.getElementById('car_configuration').value = carConf;
});