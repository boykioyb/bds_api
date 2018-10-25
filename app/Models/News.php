<?php

namespace App\Models;

class News extends BaseModel
{
    public $collection = 'news';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'categories' => null,
        'data_locale' => [
            'name' => '',
            'name_ascii' => '',
            'url_alias' => '',
            'tags' => '',
            'short_description' => '',
            'description' => '',
            'weight' => 0,
            'status' => 0,
            'priority' => 0,
            'meta_title' => '',
            'meta_description' => '',
            'meta_tags' => '',
            'meta_keywords' => '',
        ],
        'files' => [
            'logo' => null,
            'image' => null,
            'video' => null
        ],
        'view_count' => 0,
        'schedule_post' => '',
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}