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
<form action="/register/new_user" method="post">
    <label for="username">Имя пользователя:</label>
    <input type="text" name="username" id="username" value="<?= old('username') ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= old('email') ?>" required><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required><br>

    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>
