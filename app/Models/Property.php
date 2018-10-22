<?php

namespace App\Models;

class Property extends BaseModel
{
    public $collection = 'properties';
    public $fillable = [
        'name',
        'name_ascii',
        'description',
        'location',
        'loc',
        'address',
        'detail',
        'start_date',
        'end_date',
        'file_url',
        'price',
        'order'.
        'status',
        'categories',
        'owner',
        'meta_title',
        'meta_description',
        'meta_tags',
        'meta_keywords'
        ];
}