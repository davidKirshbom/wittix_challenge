<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class deleteUser implements ShouldQueue
{
    use Queueable;
    private $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $this->user->delete();
    }
}
