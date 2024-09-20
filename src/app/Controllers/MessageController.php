<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\User;

class MessageController extends BaseController
{
    public function getActiveUserMessages($page = 1)
    {
        $user = new User();
        $message = new Message();

        $activeUsers = $user->where('is_active', 1)->findAll();
        $activeUserIds = array_column($activeUsers, 'id');

        $perPage = 3; // Number of comments per page
        $offset = ($page - 1) * $perPage;

        //echo "Page: $page, Per Page: $perPage, Offset: $offset";

        $messages = $message->select('user.username, user.userimage, message.content, message.publication_date')
            ->join('user', 'user.id = message.user_id')
            ->whereIn('message.user_id', $activeUserIds)
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        //echo $message->getLastQuery();

        $totalMessages = $message->whereIn('message.user_id', $activeUserIds)->countAllResults();
        $totalPages = ceil($totalMessages / $perPage);

        return view('welcome_message', [
            'messages' => $messages,
            'users' => $activeUsers,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function addMessage()
    {
        $messageModel = new Message();

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'content' => $this->request->getPost('content'),
            'publication_date' => date('Y-m-d H:i:s')
        ];

        $messageModel->insert($data);

        return redirect()->to('/messages/1');
    }
}
