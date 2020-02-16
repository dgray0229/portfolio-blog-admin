<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class SocialAuthLinkedinController extends Controller
{
    // This is a controller, which handles the Linkedin Authentication routes
    public function redirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function callback()
    {
        try {
            $linkdinUser = Socialite::driver('linkedin')->user();
            $existUser = User::where('email',$linkdinUser->email)->first();
            session(['user' => $linkdinUser]);
            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->name = $linkdinUser->name;
                $user->email = $linkdinUser->email;
                $user->linkedin_id = $linkdinUser->id;
                $user->password = md5(rand(1,10000));
                $user->linkedin_token = $linkdinUser->accessTokenResponseBody;
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->action('HomeController@index');
        } 
        catch (Exception $e) {
            return 'error';
        }
    }

}
