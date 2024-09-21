<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
<h2>Авторизация</h2>
<?php if (session()->get('error')): ?>
    <p><?= session()->get('error') ?></p>
<?php endif; ?>
<form action="/login/auth" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= old('email') ?>" required>
    <br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Войти</button>
</form>
</body>
</html>

