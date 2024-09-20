<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
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
<?php if (!empty($messages)): ?>
    <?php foreach ($messages as $message): ?>
        <div class="message-container">
            <div class="user-info">
                <strong><?php echo $message['username']; ?></strong><br>
                <img src="<?php echo $message['userimage']; ?>" alt="User Image">
            </div>
            <div class="message-content">
                <?php echo $message['content']; ?><br>
                <em><?php echo $message['publication_date']; ?></em>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?php echo base_url('messages/' . $i); ?>" <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
<?php else: ?>
    <p>Будьте первым, кто оставит комментарий.</p>
<?php endif; ?>
<div class="form-container">
    <h2>Добавить сообщение</h2>
    <form action="/messages/add" method="post">
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
</body>
</html>