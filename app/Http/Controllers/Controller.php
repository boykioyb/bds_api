<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public $responseData = array(
        'success' => true,
        'errorCode' => STATUS_CODE_SUCCESS,
        'message' => 'success'
    );

    public function formatDataInput($data = null)
    {
        if (empty($data)) {
            return null;
        }
        return trim(htmlentities(strip_tags($data)));
    }


}
