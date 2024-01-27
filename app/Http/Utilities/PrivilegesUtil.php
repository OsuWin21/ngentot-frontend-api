<?php
namespace App\Http\Utilities;

use Illuminate\Support\Facades\DB;

class privilegesUtil{
    public static function getUserPrivileges($userId){
        $unrestricted = 1 << 0; 
        $verified = 1 << 1;
        $whitelisted = 1 << 2;
        $supporter = 1 << 4;
        $premium = 1 << 5;
        $alumni = 1 << 7;
        $tourneyManager = 1 << 10;
        $nominator = 1 << 11;
        $moderator = 1 << 12;
        $administrator = 1 << 13;
        $developer = 1 << 14;

        $userPriv = DB::table('users')->where('id', $userId)
                                      ->value('priv');

        $privileges = [];

        $allPrivileges = [
            'Unrestricted' => $unrestricted,
            'Verified' => $verified,
            'Whitelisted' => $whitelisted,
            'Supporter' => $supporter,
            'Premium' => $premium,
            'Alumni' => $alumni,
            'Tourney Manager' => $tourneyManager,
            'Nominator' => $nominator,
            'Moderator' => $moderator,
            'Administrator' => $administrator,
            'Developer' => $developer,
        ];

        foreach ($allPrivileges as $permissionName => $value){
            if($userPriv & $value) {
                $privileges[] = $permissionName;
            }
        }

        return $privileges;
    }
}