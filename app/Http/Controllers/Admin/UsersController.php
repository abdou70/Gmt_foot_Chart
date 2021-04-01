<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profil;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('bloque-users')) {
            return  view("admin.users.index");
        }
        $users = User::paginate(4);
       // $users = User::all();
        return  view("admin.users.index")->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin/users/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-users')) {
            return "/home";
        } else {

            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);

            

            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return Redirect::back()->with('success', 'utilisateur ajouter');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('manage-users')) {
            return  view("home");
        }
        $profils = Profil::all();
        return  view(
            'admin/users/edit',
            [
                'user' => $user,
                'profils' => $profils
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request->profils);
        $user->profils()->sync($request->profils);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('bloque-users')) {
            return  view("admin.users.index");
        }
        return "delete user";
    }
    public function delete($id)
    {
        if (Gate::denies('bloque-users')) {
            return  view("admin.users.index");
        }
        $user = User::find($id); //On demande au model Client de prendre les client avec les id  
        if ($user->profils()->whereIn('status',['admin'])->first()) //s'il existe des clients on fait le delete.
        {

            return Redirect::back()->with('error', 'on peut pas supprimer un administrateur');
           
        }else
        {
            $user->delete();
            return Redirect::back()->with('success', 'utilisateur supprimer');
        }

      
    }

    public function setPassword($id)
    {
        if (Gate::denies('manage-users')) {
            return  view("home");
        }
        $user = User::find($id);
    
        return  view('admin.users.changepassword')->with('user', $user);
    }

    public function updatePassword(Request $request)
    {

    
        if (strcmp($request->get('new_password'), $request->get('password_confirm')) != 0) {
            return Redirect::back()->with('errors', ['la confirmation ne correspond pas au nouveau mot de passe sont les memes']);
        }

        //Change Password
        $user =User::find($request->get('idclient'));
      //  dd($user);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();


        return Redirect::back()->with('success', 'mot de passe mise a jour');
    }
}
