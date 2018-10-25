<?php

namespace App\Models;

class Investor extends BaseModel
{
    public $collection = 'investors';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'data_locale' => [
            'name' => '',
            'name_ascii' => '',
            'url_alias' => '',
            'description' => '',
            'weight' => 0,
            'status' => 0,
            'meta_title' => '',
            'meta_description' => '',
            'meta_tags' => '',
            'meta_keywords' => '',
        ],
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}