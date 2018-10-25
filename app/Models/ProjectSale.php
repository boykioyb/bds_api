<?php

namespace App\Models;

class ProjectSale extends BaseModel
{
    public $collection = 'project_sales';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'investors' => null,
        'data_locale' => [
            'name' => '',
            'name_ascii' => '',
            'url_alias' => '',
            'tags' => '',
            'short_description' => '',
            'description' => '',
            'development_type' => '',
            'project_scale' => '',
            'functional_zones' => '',
            'design_consultancy' => '',
            'pm_mc' => '',
            'priority' => 0,
            'weight' => 0,
            'status' => 0,
            'meta_title' => '',
            'meta_description' => '',
            'meta_tags' => '',
            'meta_keywords' => '',
        ],
        'loc' => [
            'type' => '',
            'coordinates' => ''
        ],
        'location' => [
            'city' => '',
            'district' => '',
            'country_code' => '',
            'address' => ''
        ],
        'land_area_of_study' => 0,
        'construction_land_area' => 0,
        'construction_density' => 0,
        'files' => [
            'logo' => null,
            'image' => null,
            'video' => null
        ],
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}