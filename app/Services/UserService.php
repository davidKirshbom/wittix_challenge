<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function create(array $data)
    {
        $validation = self::validate($data);
        return User::create($data);
    }
    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
    public function delete(User $user)
    {
        $user->delete();
    }
    public function find(int $id)
    {
        return User::findOrFail($id);
    }
    public function all()
    {
        return User::all();
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function login(array $data)
    {
        $validation = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validation->fails()) {
            throw new \Exception($validation->errors());
        }
        if (Auth::attempt($validation->validated())) {
            return Auth::user()->load(['customers']);
        }
        throw new \Exception('Invalid credentials');
    }
    public static function validate(array $data)
    {
        $validator = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'user_identifier' => ['required', 'string', 'max:255', 'regex:/^(?!0{9})\d{8}\d$/'],
        ]);
        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
        return $validator;
    }
}
