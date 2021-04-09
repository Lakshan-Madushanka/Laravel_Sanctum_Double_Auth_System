<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ApiTokenCreatedRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class APiTokenController extends ApiController
{
    public function IssueToken(ApiTokenCreatedRequest $request)
    {
        /*$this->isAuthenticated('Must Register to obtain a token');
        $this->isEmailVerified();*/

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return $this->successResponseWithData(
            'ok', 'Token Issued',
            [
                'token'   => $token,
                'token_type' => 'Bearer',
                'expires' => Config::get('sanctum.expiration', null)
            ],
            Response::HTTP_OK
        );

    }
}
