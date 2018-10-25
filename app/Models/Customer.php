<?php

namespace App\Models;

class Customer extends BaseModel
{
    public $collection = 'customers';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'username' => '',
        'password' => '',
        'full_name' => '',
        'country' => '',
        'city' => '',
        'district' => '',
        'address' => '',
        'short_description' => '',
        'description' => '',
        'phone' => 0,
        'cmnd' => 0,
        'coin' => 0,
        'level' => 0,
        'status' => 0,
        'files' => [
          'avatar' => '',
          'before_cmt' => '',
          'after_cmt' => ''
        ],
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.full_name',
    );

}