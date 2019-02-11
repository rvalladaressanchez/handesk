@extends('auth.layout')

@section('content')
    <div class="center text-center mt5" style="max-width:300px">
            <img src="{{url("images/handesk_full.png")}}" class="w80">
            <p class="uppercase">Sistema de mesa de ayuda</p>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="m3">
                    <input id="email" placeholder="Email" type="email" class="w80" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <br>
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="m3">
                    <input id="password" placeholder="Contraseña" type="password" class="w80" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mh3 mb2">
                    <button type="submit" class="uppercase ph5 w80">Iniciar sesion</button>
                </div>
                <div class="mb3">
                    <input type="checkbox" class="" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Recuerdame
                </div>

                <div>
                    <a class="btn btn-link" href="{{ route('password.request') }}"> Olvide mi contraseña </a>
                </div>
            </form>
    </div>
@endsection
