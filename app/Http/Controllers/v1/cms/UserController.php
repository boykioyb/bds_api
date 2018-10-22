<?php

namespace App\Http\Controllers\v1\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @api {get} cms/users/getAll
     * @apiName getAll
     * @apiGroup Users
     *
     * @apiSuccess {Object} all data users.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
    {
        "data": {
            "content": [
                {
                    "_id": "5bcb4546bb2c8e00075e8e32",
                    "email": "boykioyb96@gmail.com",
                    "status": 1,
                    "group_id": "1",
                    "updated_at": "2018-10-20 15:09:58",
                    "created_at": "2018-10-20 15:09:58"
                }
            ],
            "limit": 10,
            "page": 1,
            "total": 1
        },
        "success": true,
        "errorCode": 0,
        "message": "success"
    }
     * @apiError UserEmpty data empty.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getAll(Request $request)
    {
        $limit = !empty($request->request->get('limit')) ? $request->request->get('limit') : LIMIT;
        $page = !empty($request->request->get('page')) ? $request->request->get('page') : PAGE;


        $user = User::skip($page - 1)->take($limit)->get();
        $total = User::count();
        $this->responseData['data']['content'] = $user;
        $this->responseData['data']['limit'] = $limit;
        $this->responseData['data']['page'] = $page;
        $this->responseData['data']['total'] = $total;

        return response()->json($this->responseData);
    }

    /**
     * @api {post} cms/users/getById
     * @apiName getId
     * @apiGroup Users
     *
     * @apiSuccess {Object} all data users.
     * @apiParam {int} id Users unique ID
     *
     * @apiSuccess {Object} data by Id
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
    {
             "success": true,
             "errorCode": 0,
             "message": "success",
             "data": {
                "_id": "5bcb4546bb2c8e00075e8e32",
                "email": "boykioyb96@gmail.com",
                "status": 1,
                "group_id": "1",
                "updated_at": "2018-10-20 15:09:58",
                "created_at": "2018-10-20 15:09:58"
             }
     }
     * @apiError UserEmpty data empty.
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getById(Request $request)
    {
        $id = $request->request->get('id');
        if (empty($id)) {
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = STATUS_NOT_FOUND;
            $this->responseData['message'] = "Id not exists.";
            return response()->json($this->responseData);
        }
        $user = User::find($id);
        $this->responseData['data'] = $user;
        return response()->json($this->responseData);
    }

    /**
     * @api {post} cms/users/search
     * @apiName search
     * @apiGroup Users
     *
     * @apiSuccess {Object} all data users.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
    {
        "data": {
            "content": [
                    {
                        "_id": "5bcb4546bb2c8e00075e8e32",
                        "email": "boykioyb96@gmail.com",
                        "status": 1,
                        "group_id": "1",
                        "updated_at": "2018-10-20 15:09:58",
                        "created_at": "2018-10-20 15:09:58"
                    }
            ],
            "limit": 10,
            "page": 1,
            "total": 1
        },
        "success": true,
        "errorCode": 0,
        "message": "success"
    }
     * @apiError UserEmpty data empty.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function search(Request $request){
        $user = User::query();
        if(!empty($request->request->get('username'))){
            $username = $request->request->get('username');
            $user->where('username',$username);
        }
        if(!empty($request->request->get('email'))){
            $email = $request->request->get('email');
            $user->where('username',$email);
        }
        if(!empty($request->request->get('status'))){
            $status = $request->request->get('status');
            $user->where('status',$status);
        }
        if (!empty($request->request->get('group_id'))){
            $group_id = new \MongoId($request->request->get('group_id'));
            $user->where('group_id',$group_id);
        }


        $limit = !empty($request->request->get('limit')) ? $request->request->get('limit') : LIMIT;
        $page = !empty($request->request->get('page')) ? $request->request->get('page') : PAGE;
        $total = $user->count();

        $user->offset($page - 1)->limit($limit)->get();

        $this->responseData['data']['content'] = $user;
        $this->responseData['data']['limit'] = $limit;
        $this->responseData['data']['page'] = $page;
        $this->responseData['data']['total'] = $total;

        return response()->json($this->responseData);
    }

    /**
     * @api {post} cms/users/create
     * @apiName create
     * @apiGroup Users
     *
     * @apiSuccess {Object} data create.
     * @apiParam {string} username
     * @apiParam {string} password
     * @apiParam {string} email
     * @apiParam {int} status
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     * "success": true,
     * "errorCode": 0,
     * "message": "success",
     * "data": {
     * "_id": "5bcb4546bb2c8e00075e8e32",
     * "email": "boykioyb96@gmail.com",
     * "status": 1,
     * "group_id": "1",
     * "updated_at": "2018-10-20 15:09:58",
     * "created_at": "2018-10-20 15:09:58"
     * }
     * }
     * @apiError UserEmpty data empty.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
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

    /**
     * @api {post} cms/users/update
     * @apiName update
     * @apiGroup Users
     *
     * @apiParam {string} id
     * @apiParam {string} username
     * @apiParam {string} email
     * @apiParam {int} status
     *
     * @apiSuccess {Object} data update
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     * "success": true,
     * "errorCode": 0,
     * "message": "success",
     * "data": {
     * "_id": "5bcb4546bb2c8e00075e8e32",
     * "email": "boykioyb96@gmail.com",
     * "status": 1,
     * "group_id": "1",
     * "updated_at": "2018-10-20 15:09:58",
     * "created_at": "2018-10-20 15:09:58"
     * }
     * }
     * @apiError UserEmpty data empty.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'bail|required',
            'username' => 'required',
            'email' => 'required|email',
            'status' => 'required'
        ]);

        $id = $request->request->get('id');
        if (empty($id)) {
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = STATUS_NOT_FOUND;
            $this->responseData['message'] = "Id not exists.";
            return response()->json($this->responseData);
        }
        $user  = User::find($id);
        if(empty($user)){
            $this->responseData['message'] = "data empty.";
            return response()->json($this->responseData);
        }

        if (!empty($request->request->get('email'))){
            $email = trim(htmlentities(strip_tags($request->request->get('email'))));
            $user->email = $email;
        }

        if (!empty($request->request->get('status'))){
            $status = (int)trim(htmlentities(strip_tags($request->request->get('status'))));
            $user->status = $status;
        }

        if (!empty($request->request->get('group_id'))){
            $group_id = trim(htmlentities(strip_tags($request->request->get('group_id'))));
            $user->group_id = new \MongoId($group_id);
        }

        $res = $user->save();
        $this->responseData['data'] = $res;
        return response()->json($this->responseData);
    }

    /**
     * @api {post} cms/users/resetPassword
     * @apiName resetPassword
     * @apiGroup Users
     *
     * @apiSuccess {Object} update password success.
     * @apiParam {string} id
     * @apiParam {string} password
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     * "success": true,
     * "errorCode": 0,
     * "message": "success",
     * "data": {
     * "_id": "5bcb4546bb2c8e00075e8e32",
     * "email": "boykioyb96@gmail.com",
     * "status": 1,
     * "group_id": "1",
     * "updated_at": "2018-10-20 15:09:58",
     * "created_at": "2018-10-20 15:09:58"
     * }
     * }
     * @apiError UserEmpty data empty.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function resetPassword(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'password' => 'bail|required|min:6',
        ]);
        $id = $request->request->get('id');
        if (empty($id)) {
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = STATUS_NOT_FOUND;
            $this->responseData['message'] = "Id not exists.";
            return response()->json($this->responseData);
        }
        $user  = User::find($id);
        if(empty($user)){
            $this->responseData['message'] = "data empty.";
            return response()->json($this->responseData);
        }
        $password = $request->request->get('Password');

        $user->password = Hash::make($password);

        $res = $user->save();
        $this->responseData['data'] = $res;
        return response()->json($this->responseData);
    }
}