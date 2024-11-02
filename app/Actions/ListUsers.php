<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ListUsers
{
    use AsAction;

    public function handle()
    {
        $users = User::all();
        return $users;
    }

    public function asController(Request $request)
    {
        $users = $this->handle();
        return response()->json($users);
    }

    public function authorize(ActionRequest $request): bool
    {
        return  !empty($request->user());
    }
}
