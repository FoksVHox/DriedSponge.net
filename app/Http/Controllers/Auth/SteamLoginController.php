<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\AbstractSteamLoginController;
use kanalumaddela\LaravelSteamLogin\SteamUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class SteamLoginController extends AbstractSteamLoginController
{
    /**
     * {@inheritdoc}
     */
    public function authenticated(Request $request, SteamUser $steamUser)
    {

        $user = User::where('steamid', $steamUser->steamId)->first();

        // if the user doesn't exist, create them
        if (!$user) {
            $steamUser->getUserInfo();
            $guarded = [];
            $user = User::create([
                'username' => $steamUser->name,
                'steamid' => $steamUser->steamId,
                'avatar' => $steamUser->avatarLarge
            ]);
            $user->assignRole('User');
//            $role = Role::create(['name'=>'Owner']);
//            $user->assignRole('Owner');
//            $permission = Permission::create(['name' => '*']);
//            $role->givePermissionTo($permission);
        }
        // login the user using the Auth facade


        Auth::login($user);

        // let the extended controller handle redirect back to the page the user was just on
    }
}
