<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\Client as ResourceClient;
use App\Mail\ActiveAccount;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\MyHelper\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends ParentApi
{

    public function __construct()
    {

        $this->helper = new Helper();
        $this->guard = 'api';
        $this->model = new Client();
        $this->table = 'clients';
        $this->uniqueRow = 'phone';
        $this->sendPinCodeErrorMessage = 'رقم الهاتف غير صحيح';
    }

    //
    public function  register(Request $request){

        $rules =
            [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:clients,phone',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|confirmed',
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return $this->helper->responseJson(0, $data->errors()->first());
        }
        $request->merge(['password'=>bcrypt($request->password)]);
        $record = $this->model->create($request->all());

        $token = $record->createToken('android')->accessToken;

    

        return $this->helper->responseJson(1, 'تم الاضافه بنجاح',['token' => $token, 'user' =>  $record]);
    }

    public function login(Request $request)
    {
        $rules =
            [
                'phone' => 'required',
                'password' => 'required',
            ];


        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return $this->helper->responseJson(0, $data->errors()->first());
        }

        $user = $this->model->where(['phone' => $request->phone])->first();

        //check if user exists
        if ($user) {

//            if ($user->is_active == 0)
//            {
//                return $this->helper->responseJson(0, 'يجب تاكيد الحساب عن طريق الايميل ');
//
//            }
            if (Hash::check($request->password , $user->password))
            {
                $token = $user->createToken('android')->accessToken;
           

                return $this->helper->responseJson(1, 'تم تسجيل الدخول بنجاح', ['token' => $token, 'user' =>$user]);

            } else {

                return $this->helper->responseJson(0, 'كلمة المرور غير صحيحة');
            }


        }
        else
        {
            return $this->helper->responseJson(0, 'رقم الهاتف الذي أدخلته غير صحيح');

        }

        // send pin code to confirm phone
    }



    }
