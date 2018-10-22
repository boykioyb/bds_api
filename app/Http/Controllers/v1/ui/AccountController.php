<?php

namespace pp\Http\Controllers\v1\ui;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'bail|required|unique:users',
            'password' => 'required',
        ]);
        $account = Account::where('username', $request->request->get('username'))->get();
        $password = $request->request->get('password');
        if (Hash::check($password, $account->password)) {
            return response()->json($this->responseData);
        }
        $this->responseData['success'] = false;
        $this->responseData['errorCode'] = 401;
        $this->responseData['message'] = 'login false';
        return response()->json($this->responseData);
    }

    public function detail(Request $request)
    {
        $username = $request->request->get('username');
        if (!empty($username)) {
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = STATUS_NOT_FOUND;
            $this->responseData['message'] = "username not exists.";
            return response()->json($this->responseData);
        }
        $account = Account::where('username', $request->request->get('username'))->get();
        if (empty($account)) {
            $this->responseData['message'] = "data empty.";
            return response()->json($this->responseData);
        }
        $this->responseData['data'] = $account;
        return response()->json($this->responseData);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'bail|required|unique:users',
            'password' => 'required',
        ]);
        $account = Account::create($request->request->all());
        $this->responseData['data'] = $account;
        return response()->json($this->responseData);
    }

    public function update()
    {

    }

}