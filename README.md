Login, Register via Social for API
=======================

[![Latest Version](https://img.shields.io/github/release/namnguyen12041994/social-api.svg?style=flat-square)](https://github.com/namnguyen12041994/social-api.git)
[![Build Status](https://img.shields.io/travis/hadesker/social-api.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/hadesker/social-api.svg?style=flat-square)](https://packagist.org/packages/hadesker/social-api)

Website: http://hadesker.net - http://hadesker.uk


```
$accessToken = '....';
$provider = 'facebook'; // supported providers: facebook, google, zalo, naver, kakao

$loginSocialApi = new \Hadesker\SocialApi\Handle($provider, $accessToken);
$user = $loginSocialApi->getUser();
if ($user) {
    $user->getId();
    $user->getName();
    $user->getPhone();
    $user->getEmail();
    $user->getGender();
    $user->getBirthday();
    $user->getAvatar();
    var_dump($user);
    die;
}
echo 'Access token invalid';
```
