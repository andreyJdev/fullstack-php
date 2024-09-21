<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container user-info">
        <a class="navbar-brand text-white" href="<?= base_url('/messages/1') ?>">Комментарии</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($currentUser) && !empty($currentUser)): ?>
                    <li class="nav-item">
                        <span class="navbar-text mr-3">Вы вошли как: <strong><?= $currentUser['username'] ?></strong></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/logout') ?>">Выйти</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login') ?>">Войти</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

