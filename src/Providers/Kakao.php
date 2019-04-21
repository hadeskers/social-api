<?php


namespace Hadesker\SocialApi\Providers;


use Carbon\Carbon;
use Hadesker\SocialApi\User;

class Kakao implements ProviderInterface
{
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getUser(): ?User
    {
        try {
            $crl = curl_init('https://kapi.kakao.com/v1/user/me');

            $header = array();
            $header[] = 'Content-length: 0';
            $header[] = 'Content-type: application/json';
            $header[] = "Authorization: Bearer $this->accessToken";

            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_POST, true);
            $rest = curl_exec($crl);
            curl_close($crl);
            $profile = json_decode($rest);
        } catch (\Exception $exception) {
            return null;
        }
        if (!json_last_error() && $profile->id ?? null) {
            $user = new User();
            $user->setId($profile->id);
            $user->setEmail($profile->kaccount_email ?? '');
            $user->setName(optional($profile->properties)->nickname ?? '');
            $user->setAvatar(optional($profile->properties)->profile_image ?? '');
            return $user;
        }
        return null;
    }
}
