<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserCreatedRequest;
use App\Models\user;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ApiController
{
    use RefreshDatabase;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrRegister(UserCreatedRequest $request)
    {

        $data = $request->input();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->sendEmailVerificationNotification();
        $user->roles()->syncWithoutDetaching(2);

        return $this->successResponse(
            'created', 'User Created', Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

    public function showAuthUser(Request $request)
    {
        return response()->json($request->user());
        return $this->showOne('ok', 'Query successed', $request->user(),
            Response::HTTP_OK);
    }
}
