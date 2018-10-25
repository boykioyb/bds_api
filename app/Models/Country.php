<?php

namespace App\Models;

class Country extends BaseModel
{
    public $collection = 'countries';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'code' => '',
        'name' => '',
        'cities' => '',
        'status' => 0,
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}