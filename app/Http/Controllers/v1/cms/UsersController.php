<?php

namespace App\Http\Controllers\v1\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller {


    public function getAll(){
        $user = User::all();
        $this->responseData['data']['content'] = $user;
        return response()->json($this->responseData);
    }
    public function getById($id){
        if (empty($id)){
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = STATUS_NOT_FOUND;
            $this->responseData['message'] = trans('id.not.exists');
            return response()->json($this->responseData);
        }
        $user = User::find($id);
        $this->responseData['data'] = $user;
        return response()->json($this->responseData);
    }
    public function create(Request $request){
        $this->validate($request,[
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email',
            'status' => 'required'
        ]);
        $formatData = $this->formatDataInput($request->request->all());
        $data = array();
        $data['username'] = $formatData['username'];
        $data['password'] = Hash::make($formatData['password']);
        $data['email'] = $formatData['email'];
        $data['status'] = (int)$formatData['status'];
        $data['group_id'] = $formatData['group_id'];

        $res = User::create($data);
        $this->responseData['data'] = $res;
        return response()->json($this->responseData);
    }

    public function update(){

    }
}