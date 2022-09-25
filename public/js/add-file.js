'use strict';

document.getElementById('file-load-form').addEventListener('submit', function (event) {
    event.preventDefault();

    if (this.elements['file[]'].files.length === 0) {
        let container = document.getElementById('error-message-container');
        container.querySelector('.error-message').innerHTML = 'Выберете файл для загрузки';
        container.classList.remove('d-none')

        return;
    }

    let form_data = new FormData(this);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", this.action, true);
    xhr.send(form_data);

    xhr.onload = function () {
        if (xhr.status == 200) {
            let response = JSON.parse(xhr.response);
            responseHandler(response);
        }
    };

    function responseHandler(response) {
        if (response.response === 'ok') {
            let container = document.getElementById('success-message-container');
            container.classList.remove('d-none')

            setTimeout(() => {
                container.classList.add('d-none')
            }, 3000)
        } else {
            let container = document.getElementById('error-message-container');
            container.querySelector('.error-message').innerHTML = response.response;

            container.classList.remove('d-none')

            setTimeout(() => {
                container.classList.add('d-none')
                container.querySelector('.error-message').innerHTML = '';
            }, 3000)
        }

        //update table
        let table = document.getElementById('file-table');
        table.removeChild(table.firstChild)
        table.innerHTML = response.table;
    }
})