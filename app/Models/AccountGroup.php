<?php

namespace App\Models;

class AccountGroup extends BaseModel{
    public $collection = 'account_groups';
    public $fillable = ['code','name','module','status','permission'];
}