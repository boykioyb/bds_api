<?php

namespace App\Models;

class Media extends BaseModel
{
    public $collection = 'medias';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'date' => null,
        'file_url' => '',
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}