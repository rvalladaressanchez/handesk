@extends('layouts.app')
@section('content')
<div class="description">
        <a href="{{ url()->previous() }}">Usuarios</a>
    </div>
    <div class="comment description actions mb4">
        <h3>Nuevo usuario</h3>
    </div>
    {{ Form::open(["url" => route('users.store')]) }}
    <table class="w50">
        <tr><td>Nombre: </td><td><input autofocus required class="w100" name="name"></td></tr>
        <tr><td>Email: </td><td><input required  type="email" class="w100" name="email"></td></tr>
        <tr><td>Clave: </td><td><input required type="password" class="w100" name="pass"></td></tr>
        <tr><td><input  type="checkbox" name="chkAdmin" id="chkAdmin"><label for="chkAdmin">Admin?</label></td></tr>
        <tr><td colspan="2"> <button class="ph4 uppercase">@icon(plus) Crear</button></td></tr>
    </table>
    {{ Form::close() }}
@endsection
