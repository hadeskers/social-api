<?php


namespace Hadesker\SocialApi\Providers;


use Hadesker\SocialApi\User;

class Zalo implements ProviderInterface
{
    protected $accessToken;
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getUser() :? User
    {
        try {
            $profile = file_get_contents("https://openapi.zalo.me/v2.0/me?fields=id,name,birthday,gender,picture&access_token=$this->accessToken");
            $profile = json_decode($profile);
        } catch (\Exception $exception) {
            return null;
        }
        if (!json_last_error() && ($profile->id ?? null)) {
            $user = new User();
            $user->setId($profile->id);
            $user->setEmail($profile->email ?? '');
            $user->setName($profile->name ?? '');
            $user->setAvatar(optional(optional($profile->picture)->data)->url ?? '');
            $gender = User::$GENDER_UNKNOWN;
            switch ($profile->gender ?? ''){
                case 'male': User::$GENDER_MALE; break;
                case 'female': User::$GENDER_FEMALE; break;
                default: User::$GENDER_UNKNOWN;
            }
            $user->setGender($gender);
            return $user;
        }
        return null;
    }
}
