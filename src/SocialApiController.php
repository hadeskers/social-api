<?php

namespace Hadesker\SocialApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hadesker\SocialApi\Handle;

class SocialApiController extends Controller
{
    /**
     * @param Request $request
     * @param $provider_type
     * @api Login via social api
     */
    public function loginSocial(Request $request, $provider_type)
    {
        $accessToken = $request->get('access_token');
        $provider = $request->get('provider', $provider_type); // supported providers: facebook, google, zalo, naver, kakao
        $loginSocialApi = new Handle($provider, $accessToken);
        $user = $loginSocialApi->getUser();
        if ($user) {
            $user->getId();
            $user->getName();
            $user->getPhone();
            $user->getEmail();
            $user->getGender();
            $user->getBirthday();
            $user->getAvatar();
            dd($user);
        }
        echo 'Access token invalid';
        // TODO implement something...
    }
}
