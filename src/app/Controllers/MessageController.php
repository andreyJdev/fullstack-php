<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\User;

class MessageController extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function getActiveUserMessages($page = 1)
    {
        $sort = $this->request->getGet('sort') ?? 'publication_date';
        $order = $this->request->getGet('order') ?? 'desc';

        if ($this->request->getGet('sort') === null || $this->request->getGet('order') === null) {
            return redirect()->to("/messages/{$page}?sort=publication_date&order=desc");
        }

        $user = new User();
        $message = new Message();

        $activeUsers = $user->where('is_active', 1)->findAll();
        $activeUserIds = array_column($activeUsers, 'id');

        $perPage = 3;
        $offset = ($page - 1) * $perPage;

        $messages = $message->select('user.username, user.userimage, message.user_id, message.id, message.content, message.publication_date, message.is_active')
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

        $currentUser = $this->session->get('user');

        return view('comments', [
            'messages' => $messages,
            'users' => $activeUsers,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'sort' => $sort,
            'order' => $order,
            'currentUser' => $currentUser
        ]);
    }

    public function checkAuth()
    {
        $session = session();

        if ($session->has('user')) {
            return $this->response->setJSON(['status' => 'authorized']);
        } else {
            return $this->response->setJSON(['status' => 'unauthorized']);
        }
    }

    public function addMessage()
    {
        $session = session();
        $currentUser = $session->get('user');

        if (!$currentUser) {
            return $this->response->setJSON(['status' => 'unauthorized']);
        }

        $message = new Message();

        $data = [
            'user_id' => $currentUser['id'],
            'content' => $this->request->getPost('content'),
            'publication_date' => date('Y-m-d H:i:s')
        ];

        $message->insert($data);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteMessage($id)
    {
        $message = new Message();

        $message->update($id, ['is_active' => 0]);

        return $this->response->setJSON(['status' => 'success']);
    }
}

?>