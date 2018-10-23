<?php

namespace App\Http\Controllers\v1\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{

    public function create(Request $request)
    {

        $lang_code = $this->_formatLang($request->request->get('lang_code'));
        $location = $request->request->get('location');
        $loc = $request->request->get('loc');
        $detail = $request->request->get('detail');
        $start_date = $request->request->get('start_date');
        $end_date = $request->request->get('end_date');
        $file_url = $request->request->get('file_url');
        $price = $request->request->get('price');
        $order = $request->request->get('order');
        $status = $request->request->get('status');
        $categories = $request->request->get('categories');
        $owner = $request->request->get('owner');
        $meta_title = $request->request->get('meta_title');
        $meta_description = $request->request->get('meta_description');
        $meta_tags = $request->request->get('meta_tags');
        $meta_keywords = $request->request->get('meta_keywords');

        //save data
        Property::create($request->request->all());
        return response()->json($this->responseData);

    }

    private function _formatLang($langCode = null)
    {
        if (empty($langCode)){
            return null;
        }
        $data = array();
        foreach ($langCode as $key => $val) {
            $data[$key] = $val;
        }
        return $data;
    }
}