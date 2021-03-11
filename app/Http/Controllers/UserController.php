<?php

namespace App\Http\Controllers;

use App\District;
use App\Province;
use App\Regency;
use App\User;
use App\Village;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Log;
use Sentinel;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     * Return all data from users table.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll() {
        try {
            $modelUser = new User();
            $users = $modelUser->getAll();
            $data = $users;

            $meta = [
                'code' => 200,
                'error' => false,
                'message' => 'success'
            ];

            return response()->json([
                'meta' => $meta,
                'data' => $data
            ], $meta['code']);
        } catch (Exception $e) {
            Log::error($e);
            $data = $e;

            $meta = [
                'code' => 500,
                'error' => true,
                'message' => 'failed'
            ];

            return response()->json([
                'meta' => $meta,
                'data' => $data
            ], $meta['code']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function signUpPage() {
        return view('auth.signup');
    }
}
