<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Language;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('teams')->paginate(25);

        return view('users.index', ['users' => $users]);
    }
    public function create(){
        return view('users.nuevo');
    }
    public function store(){
        //$this->authorize('create', User::class);
        $admin = 0;
        if(request('chkAdmin')=='on') $admin = 1;
        User::create([
            'name'              => request('name'),
            'email'             => request('email'),
            'locale'            => Language::ES,
            'password'          => bcrypt(request('pass')),
            'admin'             => $admin,
        ]);
        return redirect()->route('users.index');
    }
    public function delete(User $user)
    {
        if(Auth::user()->id==$user->id) return back();
        $user->delete();
        return back();
    }

    public function impersonate(User $user)
    {
        auth()->loginUsingId($user->id);

        return redirect()->route('tickets.index');
    }
}
