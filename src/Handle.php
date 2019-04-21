<?php


namespace Hadesker\SocialApi;

use Hadesker\SocialApi\Providers\Facebook;
use Hadesker\SocialApi\Providers\Google;
use Hadesker\SocialApi\Providers\Kakao;
use Hadesker\SocialApi\Providers\Naver;
use Hadesker\SocialApi\Providers\Zalo;

class Handle
{
    public static $PROVIDER_FACEBOOK = 'facebook';
    public static $PROVIDER_ZALO = 'zalo';
    public static $PROVIDER_GOOGLE = 'google';
    public static $PROVIDER_NAVER = 'naver';
    public static $PROVIDER_KAKAO = 'kakao';

    private static $instance;

    protected $provider;
    protected $accessToken;
    public function __construct($provider = null, $accessToken = null)
    {
        $this->provider = $provider;
        $this->accessToken = $accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    public static function getInstance()
    {
        if(!static::$instance){
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getUser() :? User
    {
        switch ($this->provider) {
            case static::$PROVIDER_FACEBOOK: return (new Facebook($this->accessToken))->getUser();
            case static::$PROVIDER_GOOGLE: return (new Google($this->accessToken))->getUser();
            case static::$PROVIDER_ZALO: return (new Zalo($this->accessToken))->getUser();
            case static::$PROVIDER_NAVER: return (new Naver($this->accessToken))->getUser();
            case static::$PROVIDER_KAKAO: return (new Kakao($this->accessToken))->getUser();
            default: return null;
        }
    }
}
