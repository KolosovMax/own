<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="width: 100%; height: 100%;">

<div class="container  d-flex flex-column justify-content-center"  style="min-height: 100vh;max-width: 500px">
    <form class="" method="post" action="/account/auth">
        <fieldset>
            <legend>Вход в аккаунт</legend>

            <div>
                <?php if (!empty($response)):?>
                    <p> Аккаунт успешно зарегестрирован</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Логин</label>
                <input class="form-control"
                       type="text"
                       id="email"
                       name="email"
                       placeholder="Введите логин">
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Пароль</label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Введите пароль">
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Вход</button>
                <a class="btn btn-primary" role="button" href="/account/registration">Зарегистрируйтесь</a>
            </div>
        </fieldset>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous">
</script>

</body>
</html>
