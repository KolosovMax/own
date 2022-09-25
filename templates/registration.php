<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
<div class="container d-flex flex-column justify-content-center" style="min-height: 100vh;max-width: 500px">
    <form method="post" action="/account/add">
        <fieldset>
            <legend>Регистрация</legend>

            <div>
                <label class="form-label" for="login">Логин</label>
                <input class="form-control" type="text" id="email" name="email"
                       placeholder="Введите email">
            </div>

            <div>
                <label class="form-label" for="password">Пароль</label>
                <input class="form-control"
                       type="password"
                       id="password"
                       name="password"
                       placeholder="Введите пароль">
            </div>

            <div>
                <?php if (!empty($response)): ?><p><?= $response ?></p>

                <?php endif; ?>
            </div>

            <div>
                <button class="btn-primary btn mt-3" type="submit">Регистрация</button>
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
