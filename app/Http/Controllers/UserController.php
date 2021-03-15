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

class UserController extends Controller {
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
    public function apiGetAll() {
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
     * Return all data from users table.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiGetUserById(Request $request) {
        try {
            $modelUser = new User();
            
            if (!empty($request->user_token)) {
                $id = $request->user_token;
                $users = $modelUser->getUserById($id);
                $data = $users;

                $meta = [
                    'code' => 200,
                    'error' => false,
                    'message' => 'success'
                ];
            } else {
                $meta = [
                    'code' => 400,
                    'error' => true,
                    'message' => 'failed'
                ];
            }

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
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        //
    }
}
