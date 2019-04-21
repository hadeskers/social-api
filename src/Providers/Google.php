<?php


namespace Hadesker\SocialApi\Providers;


use Hadesker\SocialApi\User;

class Google implements ProviderInterface
{
    protected $accessToken;
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getUser() :? User
    {
        try {
            $profile = file_get_contents("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=$this->accessToken");
            $profile = json_decode($profile);
        } catch (\Exception $exception) {
            return null;
        }
        if (!json_last_error() && ($profile->sub ?? null)) {
            $user = new User();
            $user->setId($profile->sub ?? '');
            $user->setEmail($profile->email ?? '');
            $user->setName($profile->name ?? '');
            $user->setAvatar($profile->picture ?? '');
            return $user;
        }
        return null;
    }
}
