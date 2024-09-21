<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Авторизация</title>
    <?php include 'Blocks/head.php'; ?>
</head>
<body>
<header>
    <?php include 'Blocks/nav.php'; ?>
</header>
<section>
    <div class="container mt-4">
        <h1>Авторизация</h1>
        <?php if (session()->get('error')): ?>
            <div class="alert alert-danger">
                <p><?= session()->get('error') ?></p>
            </div>
        <?php endif; ?>

        <form action="/login/auth" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= old('email') ?>"
                       class="form-control border-primary rounded-lg shadow-sm" placeholder="Введите Email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password"
                       class="form-control border-primary rounded-lg shadow-sm" placeholder="Введите Пароль" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
            <p class="after-submit">Нет учетной записи? &ndash; <a href="<?= base_url('/register') ?>">Регистрация</a></p>
        </form>
    </div>
</section>
</body>
</html>

