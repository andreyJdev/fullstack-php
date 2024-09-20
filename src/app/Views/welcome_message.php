<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<style>
    .message-container {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .user-info {
        margin-right: 20px;
    }

    .user-info img {
        max-width: 50px;
        border-radius: 50%;
    }

    .message-content {
        max-width: 600px;
    }
</style>

<div class="sort-options">
    <span>Сортировка: </span>
    <a href="<?php echo base_url('messages/' . $currentPage . '?sort=id&order=' . $order); ?>">По идентификатору
        сообщения</a>
    <a href="<?php echo base_url('messages/' . $currentPage . '?sort=publication_date&order=' . $order); ?>">По дате
        публикации</a>
    <select onchange="location = this.value;">
        <option value="<?php echo base_url('messages/' . $currentPage . '?sort=' . $sort . '&order=asc'); ?>" <?php echo ($order == 'asc') ? 'selected' : ''; ?>>
            По возрастанию
        </option>
        <option value="<?php echo base_url('messages/' . $currentPage . '?sort=' . $sort . '&order=desc'); ?>" <?php echo ($order == 'desc') ? 'selected' : ''; ?>>
            По убыванию
        </option>
    </select>
</div>

<div class="pagination">
    <span>Страницы: </span>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="<?php echo base_url('messages/' . $i . '?sort=' . $sort . '&order=' . $order); ?>" <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>>
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
</div>

<?php if (!empty($messages)): ?>
    <?php foreach ($messages as $message): ?>
        <div class="message-container" id="message-<?php echo $message['id']; ?>">
            <div class="user-info">
                <strong><?php echo $message['username']; ?></strong><br>
                <img src="<?php echo $message['userimage']; ?>" alt="User Image">
            </div>
            <div class="message-content">
                <?php echo $message['content']; ?><br>
                <em><?php echo $message['publication_date']; ?></em>
                <button class="delete-button" data-id="<?php echo $message['id']; ?>">Удалить</button>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Будьте первым, кто оставит комментарий.</p>
<?php endif; ?>

<div class="form-container">
    <h2>Добавить сообщение</h2>
    <form id="messageForm">
        <label for="user_id">Пользователь:</label>
        <select name="user_id" id="user_id" required>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="content">Сообщение:</label>
        <textarea name="content" id="content" required></textarea><br><br>
        <button type="submit">Отправить</button>
    </form>
</div>

<script>
    $(document).ready(function () {

        $('#messageForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/messages/add',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.status === 'success') {
                        location.reload();
                    } else {
                        alert('Произошла ошибка при добавлении сообщения.');
                    }
                }
            });
        });


        $('.delete-button').on('click', function () {
            var messageId = $(this).data('id');

            // Запрос подтверждения у пользователя
            var userConfirmation = confirm("Вы действительно хотите удалить свой комментарий?");

            // Если пользователь подтвердил удаление
            if (userConfirmation) {
                $.ajax({
                    url: '/messages/delete/' + messageId,
                    type: 'POST',
                    success: function (response) {
                        if (response.status === 'success') {
                            // Удалить сообщение из DOM
                            $('#message-' + messageId).remove();
                        } else {
                            alert('Произошла ошибка при удалении сообщения.');
                        }
                    }
                });
            } else {
                // Если пользователь отказался от удаления
                alert('Удаление отменено.');
            }
        });
    });
</script>
</body>
</html>

