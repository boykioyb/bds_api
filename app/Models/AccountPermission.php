<?php

namespace App\Models;

class AccountPermission extends BaseModel{
    public $collection = 'account_permissions';
    public $fillable = ['code','name','module','status'];
}