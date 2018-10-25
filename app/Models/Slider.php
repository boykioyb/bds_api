<?php

namespace App\Models;

class Slider extends BaseModel
{
    public $collection = 'sliders';
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
        ],
        'files' => null,
        'file_uris' => null,
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}