<?php

namespace App\Actions;

use App\Jobs\deleteUser as JobsDeleteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUser
{
    use AsAction;

    public function handle(int $id)
    {

        $user = User::find($id);
        if (!$user) {
            return false;
        }
        JobsDeleteUser::dispatch($user);
    }

    public function asController(Request $request)
    {
        $result = $this->handle($request->id);
        if (!$result) {
            return response('User not found', 404);
        }
        return response('User will be deleted', 200);
    }
    public function authorize(ActionRequest $request): bool
    {
        return true;
    }
}
