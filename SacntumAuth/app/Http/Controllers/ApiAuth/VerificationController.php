<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends ApiController
{
    public function verify($id, Request $request)
    {
        $this->isAuthenticated();

        if (!hash_equals((string) $request->route('id'),
            (string) $request->user()
                ->getKey())
        ) {
            throw new AuthorizationException('Invalid User');
        }

        $this->isEmailVerified();

        if (!$request->hasValidSignature()) {
            return $this->showError(
                'error', 'Invalid or Expired URL provided.',
                Response::HTTP_BAD_REQUEST
            );
        }

        if (hash_equals((string) $request->route('hash'), sha1($request->user()
            ->getEmailForVerification()))
        ) {
            $request->user()->markEmailAsVerified();

            return $this->successResponse('ok', 'Email verified',
                Response::HTTP_OK);
        }

    }

    public function resend(Request $request)
    {
        $this->isAuthenticated();

        $this->isEmailVerified();

        $request->user()
            ->sendEmailVerificationNotification();

        return $this->successResponse(
            'ok',
            'Email verification link sent to your email'
        );
    }

}

