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
        'order' .
        'status',
        'categories',
        'owner',
        'meta_title',
        'meta_description',
        'meta_tags',
        'meta_keywords'
    ];


    public $customSchema = array(
        'id' => null,
        'location' => array(
            '_id' => null,
            'country_code' => '',

        ),
        'loc' => array(
            'type' => '',
            'coordinates' => '',
        ),
        'data_locale' => [
            'name' => '',
            'name_ascii' => '',
            'url_alias' => '',
            'description' => '',
            'meta_tags' => [],
            'meta_title' => '',
            'meta_description' => '',
            'meta_tags' => '',
            'meta_keywords' => '',
            'weight' => 0,
            'status' => 0,
            'owner' => '',
        ],
        'detail' => array(
            'beds' => 0, // số phòng ngủ
            'baths' => 0, // số phòng tắm
            'acreage' => 0, //diện tích,
            'garages' => 0, // gara ô tô
            'kitchen' => 0, //phòng bếp
            'balcony' => 0, // ban công
        ),
        'start_date' => '',
        'end_date' => '',
        'price' => 0,
        'categories' => null,
        'files' => null,
        'file_uris' => null,
        'user' => null,
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
        'data_locale.tags',
    );

}