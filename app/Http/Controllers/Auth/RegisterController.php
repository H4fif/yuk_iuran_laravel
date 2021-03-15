<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Illuminate\Http\Request;
use Log;
use Sentinel;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function apiCreate(Request $request) {
        try {
            DB::beginTransaction();
            $modelUser = new User();
            
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users,email',
                'password' => 'required|max:255|confirmed',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'birth_date' => 'required|date_format:Y-m-d',
                'phone_number' => 'required|numeric',
                'address' => 'required',
                'area_id' => 'required|numeric',
                'photo' => 'nullable'
            ]);

            $errors = $validator->errors();

            if ($validator->fails()) {
                $meta = [
                    'code' => 400,
                    'error' => true,
                    'message' => 'failed',
                ];

                $data = $errors;
            } else {
                $result =  $modelUser->store($request);
                DB::commit();
                $data = [];

                $meta = [
                    'code' => 200,
                    'error' => false,
                    'message' => 'success'
                ];
            }

            return response()->json([
                'meta' => $meta,
                'data' => $data
            ], $meta['code']);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $data = [];

            $meta = [
                'code' => 500,
                'error' => true,
                'message' => 'Sorry to interrupt your work, our server seems to have problem, we will be right back soon (^_^)'
            ];

            return response()->json([
                'meta' => $meta,
                'data' => $data
            ], $meta['code']);
        }
    }

    public function signUpPage() {
        return view('auth.signup');
    }
}
