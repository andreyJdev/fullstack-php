<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
<h1>Регистрация</h1>
<?php if (session()->get('errors')): ?>
    <ul>
        <?php foreach (session()->get('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<form action="/register/store" method="post">
    <label for="username">Имя пользователя:</label>
    <input type="text" name="username" id="username" value="<?= old('username') ?>"><br>

    <label for="email">Email:</label>
    <input type="text" name="email" id="email" value="<?= old('email') ?>"><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password"><br>

    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>
