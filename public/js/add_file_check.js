'use strict';

document.forms['file-load'].addEventListener('submit', function (event) {
    event.preventDefault();

    let fd = new FormData();
    let nameErrorArr = [];
    let sizeErrorArr = [];

    for (let file of this.elements['file[]'].files) {
        if (file.size >= 209715200) {
            sizeErrorArr.push(file)
            continue;
        }
        if (!file.name.trim().length) {
            nameErrorArr.push(file);
            continue;
        }
        fd.append('file[]', file);
    }

    if (nameErrorArr.length) {
        document.getElementById('name-error')
            .innerText = `Из- за ошибки в имени файла небыло отправленно ${nameErrorArr.length} 
        файлов(а)`
    }
    if (sizeErrorArr.length) {
        document.getElementById('size-error')
            .innerText = `Из - за ошибки с размером файла небыло отправленно ${sizeErrorArr.length} 
        файлов(а)`
    }

    fetch('/file/add/', {
        method: 'post',
        body: fd
    })
        .then(response => response.text())
        .then(text => {
            console.log(text);
            document.getElementById('response').innerText = text;

            //window.location.href = `http://localhost:8080/folder/detail/`;
        });
});
