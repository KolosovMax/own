<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
</head>

<body>
<div class="container">
    <h1 class="header" style="max-width: 90%; overflow: hidden; text-overflow: ellipsis;"><?= $folder['name'] ?></h1>

    <div id="error-message-container" class="text-bg-danger p-2 d-none">
        <p class="error-message"></p>
    </div>

    <div id="success-message-container" class="text-bg-success p-2 d-none">
        <p class="success-message">Файл(ы) успешно добавлен(ы).</p>
    </div>

    <div>
        <form id="file-load-form" name="file-load" method="post" action="/file/add" enctype="multipart/form-data"
              multiple>
            <input style="max-width: 300px" class="form-control  m-3" type="file" name="file[]" id="file" multiple
                   placeholder="Выберете файл"><br>
            <button class="btn btn-primary m-3" type="submit">Загрузить</button>
        </form>
    </div>

    <div id="file-table">
        <?php include_once 'file-table.php' ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
<script src="/js/add-file.js"></script>
</body>
</html>

