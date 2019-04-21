<?php


namespace Hadesker\SocialApi\Providers;


use Hadesker\SocialApi\User;

interface ProviderInterface
{
    public function getUser() :? User;
}
