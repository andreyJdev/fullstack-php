<?php

namespace App\Models;

use CodeIgniter\Model;


class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $allowedFields = ['content', 'publication_date', 'is_active', 'user_id'];
}