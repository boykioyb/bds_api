<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public $responseData = array(
        'success' => true,
        'errorCode' => 0,
        'message' => 'success'
    );

    public function formatDataInput($data = array()){
        if (empty($data)){
            return null;
        }
        $formatData = array();
        foreach ($data as $k => $v){
            $formatData[$k] = trim(htmlentities(strip_tags($v)));
        }
        return $formatData;
    }
}
