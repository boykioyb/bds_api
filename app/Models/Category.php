<?php

namespace App\Models;

class Category extends BaseModel
{
    public $collection = 'categories';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'code' => '',
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