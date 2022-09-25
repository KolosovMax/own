<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
<div class="container ">
    <h1 class="text-center header">Добро пожаловать на вашу помойку</h1>
    <div class="mt-3 mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить папку
        </button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить папку</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="form">
                        <form name="folder_add" method="post" action="/folder/add">
                            <label for="folder">Folder name</label>
                            <input class="form-control" type="text" name="folder" id="folder"
                                   placeholder="Folder..."><br>
                            <button class="btn btn-primary" type="submit">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <?php if (!empty($response)): ?>
            <div class="text-bg-danger p-2">
                <p><?= $response ?></p>
            </div>
        <?php endif; ?>

        <div class="row align-items-center">
            <?php if (!empty($folders)): ?>
                <ul>
                    <?php foreach ($folders as $folder): ?>
                        <li style='list-style: none;
                           background: url("img/icon.png") no-repeat 0 4px;
                           padding-left: 48px;'>
                            <a style="padding-top: 18px; position:absolute; max-width: 120px;
                              white-space: nowrap; overflow: hidden; text-overflow: clip;
                              display: block; text-decoration: none;"
                               href="/folder/detail/<?= $folder['id'] ?>"><?= $folder['name'] ?></a>
                            <br>
                            <a href="/folder/delete/<?= $folder['id'] ?>">x</a>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php else: ?>
                <div>Пусто</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>
