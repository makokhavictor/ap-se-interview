<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetupUserRoleOnRegistration
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $role = Role::where('slug', 'investor')->first();
        UserRole::create([
            'user_id' => $event->user->id,
            'role_id' => $role->id
        ]);
    }
}
