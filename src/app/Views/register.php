<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <?php include 'Blocks/head.php'; ?>
</head>
<body>
<header>
    <?php include 'Blocks/nav.php'; ?>
</header>
<section>
    <div class="container mt-4">
        <h1>Регистрация</h1>
        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->get('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
        <form action="/register/new_user" method="post" id="registrationForm">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" name="username" id="username" value="<?= old('username') ?>"
                       class="form-control border-primary rounded-lg shadow-sm" placeholder="Введите имя" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= old('email') ?>"
                       class="form-control border-primary rounded-lg shadow-sm" placeholder="Введите Email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password"
                       class="form-control border-primary rounded-lg shadow-sm" placeholder="Введите пароль" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Повторите пароль:</label>
                <input type="password" name="confirm_password" id="confirm_password"
                       class="form-control border-primary rounded-lg shadow-sm" placeholder="Повторите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
            <p class="after-submit">Есть учетная запись? &ndash; <a href="<?= base_url('/login') ?>">Авторизация</a></p>
        </form>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#registrationForm').submit(function (event) {
            var password = $('#password').val();
            var confirmPassword = $('#confirm_password').val();
            if (password !== confirmPassword) {
                alert("Пароли не совпадают!");
                event.preventDefault();
            }
        });
    });
</script>

</body>
</html>
