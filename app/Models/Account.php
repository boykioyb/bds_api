<?php

namespace App\Models;

class Account extends BaseModel
{
    public $collection = 'accounts';
    public $fillable = ['username', 'password', 'full_name', 'email', 'phone', 'status', 'coins', 'levels', 'image_url', 'group_id'];
}