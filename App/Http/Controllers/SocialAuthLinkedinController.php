<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
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
            $role = Role::where('name','=','admin')->first();
            session(['user' => $linkdinUser]);
            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $admin = new User;
                $admin->name = $linkdinUser->name;
                $admin->email = $linkdinUser->email;
                $admin->linkedin_id = $linkdinUser->id;
                $admin->linkedin_access_token = $linkdinUser->token;
                $admin->password = md5(rand(1,10000));
                $admin->save();
                Auth::loginUsingId($admin->id);
                $admin->roles()->attach($role);
            }
            return redirect()->action('HomeController@index');
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
