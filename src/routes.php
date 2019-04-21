<?php
use \Illuminate\Support\Facades\Route;

Route::get('social/{provider_type?}','Hadesker\SocialApi\SocialApiController@loginSocial');
