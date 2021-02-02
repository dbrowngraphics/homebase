<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\UserPermissions;
use App\LogLogin;

class UserHasLoggedInListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // // get Permissions
        // $permissions = UserPermissions::all();

        // $keyed = $permissions->mapWithKeys(function ($item) {

        //     return [strtolower($item['permission_code']) => $item['permission_value']];
        // });

        // session()->put('permissions', $keyed);

        new LogLogin($event->id);
    }
}
