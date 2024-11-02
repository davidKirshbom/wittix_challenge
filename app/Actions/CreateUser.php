<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Str;

class CreateUser
{
    use AsAction;


    public string $commandSignature = 'app:register-user {--first-name=} {--last-name=}';
    public string $commandDescription = 'Register a new user.';

    public function handle($firstName, $lastName)
    {
        $userData = [];
        $userData['firstName'] = $firstName;
        $userData['lastName'] = $lastName;
        $userData['username'] = $this->generateUniqueUsername($firstName, $lastName);
        $userData['password'] = $this->generateRandomPassword();

        $validator = $this->validate($userData);
        $this->storeUser($validator->validated());
        return $userData;
    }

    public function asCommand(Command $command)
    {
        $firstName = $command->option('first-name') ?? $command->ask('What is the user\'s first name?');
        $lastName = $command->option('last-name') ?? $command->ask('What is the user\'s last name?');
        $userData = $this->handle($firstName, $lastName);
        $command->table(['First Name', 'Last Name', 'Username', 'Password'], [array_values($userData)]);
        return 0;
    }

    public function asController(Request $request)
    {
        $body = $request->all();
        try {
            $userData = $this->handle($body['firstName'], $body['lastName']);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }

        return response($userData);
    }

    public function generateRandomPassword()
    {
        return Str::password(12);
    }
    public function generateUniqueUsername($firstName, $lastName)
    {
        $username = Str::slug($firstName . $lastName);
        $sameUsernameCount = \App\Models\User::where('username', 'like', "%$username%")->count();
        return $sameUsernameCount > 0 ? $username . $sameUsernameCount : $username;
    }

    public function storeUser($userData)
    {
        $data = [];
        foreach ($userData as $key => $value) {
            $data[Str::snake($key)] = $value;
        }
        return User::create($data);
    }
    public static function validate(array $data)
    {
        $validator = Validator::make($data, [
            'username' => ['required', 'string',  'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'firstName' => ['required', 'string', 'max:50'],
            'lastName' => ['required', 'string', 'max:50'],
        ]);
        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
        return $validator;
    }
}
