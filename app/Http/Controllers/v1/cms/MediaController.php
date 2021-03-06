<?php

namespace App\Http\Controllers\v1\cms;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'file_url' => 'required'
        ]);

        $create = Slider::create($request->request->all());
        $this->responseData['data'] = $create;
        return response()->json($this->responseData);
    }

    public function update()
    {
        parent::update(); // TODO: Change the autogenerated stub
    }

    public function search()
    {
        parent::search(); // TODO: Change the autogenerated stub
    }

    public function getById()
    {
        parent::getById(); // TODO: Change the autogenerated stub
    }

    public function delete()
    {
        parent::delete(); // TODO: Change the autogenerated stub
    }

}