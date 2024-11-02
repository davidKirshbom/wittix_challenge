<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Str;

class LoginUser
{
    use AsAction;

    public function handle($username, $password)
    {
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $userData = Auth::user();
            Auth::login($userData, true);
            return $userData;
        }
        return false;
    }

    public function asController(Request $request)
    {
        $body = $request->all();
        $userData = $this->handle($body['username'], $body['password']);
        if (!$userData) {
            return response('Invalid credentials', 400);
        }
        return response()->json($userData);
    }
}
