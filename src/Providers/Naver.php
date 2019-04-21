<?php


namespace Hadesker\SocialApi\Providers;


use Carbon\Carbon;
use Hadesker\SocialApi\User;

class Naver implements ProviderInterface
{
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getUser(): ?User
    {
        try {
            $crl = curl_init('https://openapi.naver.com/v1/nid/me');

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
        if (!json_last_error() && $profile->resultcode == '00' &&  $profile = $profile->response) {
            $user = new User();
            $user->setId($profile->id);
            $user->setEmail($profile->email ?? '');
            $user->setName($profile->name ?? '');
            $user->setAvatar($profile->profile_image ?? '');
            if (($profile->birthday ?? null))
                $user->setBirthday(Carbon::createFromFormat('d-m' , $profile->birthday));
            return $user;
        }
        return null;
    }
}
