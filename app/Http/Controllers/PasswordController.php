<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use Illuminate\Support\Facades\Redirect;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setPassword()
    {
        return  view('updatePassword');
    }

    public function updatePassword(Request $request)
    {

        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return Redirect::back()->with('errors', ['Votre mot de passe actuel ne correspond pas au mot de passe que vous avez fourni. Veuillez réessayer.']);
        }

        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            return Redirect::back()->with('errors', ['l\'ancien et le nouveau mot de passe sont les memes']);
        }
        if (strcmp($request->get('new_password'), $request->get('password_confirm')) != 0) {
            return Redirect::back()->with('errors', ['la confirmation ne correspond pas au nouveau mot de passe sont les memes']);
        }

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();


        return Redirect::back()->with('success', 'mot de passe mise a jour');
    }
}
