<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Registro;
use App\Language;
use DB;


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
        $admin = request('chkAdmin')!=null;
        $idUsuario=DB::table('users')->insertGetId([
            'name'              => request('name'),
            'email'             => request('email'),
            'locale'            => Language::ES,
            'password'          => bcrypt(request('pass')),
            'admin'             => $admin,
        ]);
        Registro::registrar(Auth::user()->id,'usuario.creado', 'El usuario ('.Auth::user()->id.') '.Auth::user()->name.' ha creado al usuario ('.$idUsuario.')'.request('name').'.');
        return redirect()->route('users.index');
    }
    public function delete(User $user)
    {
        if(Auth::user()->id==$user->id) return back();
        $user->delete();
        Registro::registrar(Auth::user()->id,'usuario.eliminado', 'El usuario ('.Auth::user()->id.') '.Auth::user()->name.' ha eliminado al usuario ('.$user->id.')'.$user->name.'.');
        return back();
    }

    public function impersonate(User $user)
    {
        Registro::registrar(Auth::user()->id,'impersonar','El usuario ('.Auth::user()->id.')'.Auth::user()->name.' ha impersonado al usuario ('.$user->id.') '.$user->name.'.');
        auth()->loginUsingId($user->id);
        return redirect()->route('tickets.index');
    }
}
