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
    public function index()
    {
        $modelUser = new User();
        $users = $modelUser->getAll();

        $modelProvince = new Province();
        $provincies = $modelProvince->getAll();

        $modelRegency = new Regency();
        $regencies = $modelRegency->getAll();

        $modelDistrict = new District();
        $districts = $modelDistrict->getAll();

        $modelVillage = new Village();
        $villages = $modelVillage->getAll(10);

        $village = $modelVillage->getById('3273170004');

        // dd( $users->toArray() );

        dd( $village->toArray() );
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
                dd( $errors );
            } else {
                $result =  $modelUser->store($request);
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);

            dd( $e );
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
}
