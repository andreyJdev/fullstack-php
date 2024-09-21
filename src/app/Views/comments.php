<!DOCTYPE html>
<html lang="en">
<head>
    <title>Комментарии</title>
    <?php include 'Blocks/head.php'; ?>
</head>
<body>
<?php include 'Blocks/nav.php'; ?>
<header class="header">

</header>
<section class="container mt-4">
    <h1>Комментарии</h1>
    <div class="border rounded p-3">
        <div class="sort-options">
            <div class="row">
                <div class="col-7">
                    <span class="mr-2">Сортировка: </span>
                    <a class="btn btn-link text-nowrap" href="<?php echo base_url('messages/' . $currentPage . '?sort=id&order=' . $order); ?>">По
                        идентификатору
                        сообщения</a>
                    <a class="btn btn-link text-nowrap" href="<?php echo base_url('messages/' . $currentPage . '?sort=publication_date&order=' . $order); ?>">По
                        дате публикации</a>
                </div>
                <div class="col-5">
                    <select class="custom-select ml-2" onchange="location = this.value;">
                        <option value="<?php echo base_url('messages/' . $currentPage . '?sort=' . $sort . '&order=desc'); ?>" <?php echo ($order == 'desc') ? 'selected' : ''; ?>>
                            Сначала новые
                        </option>
                        <option value="<?php echo base_url('messages/' . $currentPage . '?sort=' . $sort . '&order=asc'); ?>" <?php echo ($order == 'asc') ? 'selected' : ''; ?>>
                            Сначала старые
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="sort-links">
            <span class="mr-2">Страницы: </span>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a class="btn btn-link" href="<?php echo base_url('messages/' . $i . '?sort=' . $sort . '&order=' . $order); ?>" <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>>
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>

        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <div class="mt-4" id="message-<?php echo $message['id']; ?>">
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= base_url('images/default-image.webp') ?>" alt="..."
                                 class="img-thumbnail user-img"> <br>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-8">
                                    <strong><?php echo $message['username']; ?></strong> <span
                                            class="text-muted text-nowrap"><?php echo $message['publication_date']; ?></span>
                                </div>
                                <div class="col-4 text-right">
                                    <?php if ($message['user_id'] == $currentUser['id'] || $currentUser['perm_level'] > 5): ?>
                                        <button class="delete-button btn btn-link text-secondary p-0"
                                                data-id="<?php echo $message['id']; ?>">Удалить комментарий
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12">
                                    <p><?php echo $message['content']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Будьте первым, кто оставит комментарий.</p>
        <?php endif; ?>

        <div class="add-message-form mt-2">
            <form id="messageForm">
                <div class="form-group">
                    <label for="content" class="font-weight-bold">Добавить комментарий</label>
                    <textarea name="content" id="content" class="form-control border-primary rounded-lg shadow-sm"
                              rows="5"
                              placeholder="Введите ваш комментарий..."></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Оставить комментарий</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $('#content').on('focus', function () {
            $.ajax({
                url: '/messages/check_auth',
                type: 'GET',
                success: function (response) {
                    if (response.status === 'unauthorized') {
                        window.location.href = '/login';
                    }
                }
            });
        });

        $('#messageForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/messages/add',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.status === 'success') {
                        var currentUrl = new URL(window.location.href);
                        currentUrl.pathname = '/messages/1';
                        window.location.href = currentUrl.toString();
                    } else if (response.status === 'unauthorized') {
                        window.location.href = '/login';
                    } else {
                        alert('Произошла ошибка при добавлении сообщения.');
                    }
                }
            });
        });


        $('.delete-button').on('click', function () {
            var messageId = $(this).data('id');

            var userConfirmation = confirm("Вы действительно хотите удалить свой комментарий?");

            if (userConfirmation) {
                $.ajax({
                    url: '/messages/delete/' + messageId,
                    type: 'POST',
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#message-' + messageId).remove();
                        } else {
                            alert('Произошла ошибка при удалении сообщения.');
                        }
                    }
                });
            } else {
                alert('Удаление отменено.');
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>
</html>