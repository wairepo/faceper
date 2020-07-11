<?php

namespace App\Services\Facebookapi;
use App\Models\FacebookAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class AccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        // $account = FacebookAccount::whereProvider('facebook')
        //     ->whereProviderUserId($providerUser->getId())
        //     ->first();

        // if ($account) {
        //     return $account->user;
        // } else {

            // $account = new FacebookAccount([
            //     'provider_user_id' => $providerUser->getId(),
            //     'provider' => 'facebook'
            // ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'fb_user_id' => $providerUser->getId(),
                    // 'name' => $providerUser->getName(),
                    'first_name' => $providerUser->getName(),
                    'profile_pic' => $providerUser->getAvatar(),
                    'password' => md5(rand(1,10000))
                ]);
            }

            // $account->user()->associate($user);
            // $account->save();

            return $user;
        // }
    }
}