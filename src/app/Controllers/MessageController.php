<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\User;

class MessageController extends BaseController
{
    public function getActiveUserMessages($page = 1)
    {
        $sort = $this->request->getGet('sort') ?? 'id';
        $order = $this->request->getGet('order') ?? 'asc';

        $user = new User();
        $message = new Message();

        $activeUsers = $user->where('is_active', 1)->findAll();
        $activeUserIds = array_column($activeUsers, 'id');

        $perPage = 3; // Number of comments per page
        $offset = ($page - 1) * $perPage;

        $messages = $message->select('user.username, user.userimage, message.id, message.content, message.publication_date, message.is_active')
            ->join('user', 'user.id = message.user_id')
            ->whereIn('message.user_id', $activeUserIds)
            ->where('message.is_active', 1)
            ->orderBy("message.$sort", $order)
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        $totalMessages = $message->whereIn('message.user_id', $activeUserIds)
            ->where('message.is_active', 1)
            ->countAllResults();
        $totalPages = ceil($totalMessages / $perPage);

        return view('welcome_message', [
            'messages' => $messages,
            'users' => $activeUsers,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'sort' => $sort,
            'order' => $order
        ]);
    }


    public function addMessage()
    {
        $message = new Message();

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'content' => $this->request->getPost('content'),
            'publication_date' => date('Y-m-d H:i:s')
        ];

        $message->insert($data);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteMessage($id)
    {
        $message = new Message();

        // Обновление поля is_active
        $message->update($id, ['is_active' => 0]);

        // Возвращаем JSON ответ для успешного запроса
        return $this->response->setJSON(['status' => 'success']);
    }
}

?>