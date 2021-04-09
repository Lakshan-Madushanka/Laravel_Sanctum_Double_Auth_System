<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {

    }

    protected function allowedAdminAction()
    {
        throw_if(
            Gate::denies('admin-action'),
            new AuthorizationException('User must ba a admin')
        );
    }

    protected function isEmailVerified()
    {
        if (auth()
            ->user()
            ->hasVerifiedEmail()
        ) {
            return $this->showError(
                'error', 'Email has been already verified.',
                400
            );
        }
    }

    protected function isAuthenticated($msg = 'Login or register to verify email')
    {
        throw_unless(Auth::check(),
            new AuthenticationException($msg));
    }
}
