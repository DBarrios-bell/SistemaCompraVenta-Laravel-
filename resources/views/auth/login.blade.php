@extends('layouts.theme.login')
@section('content')
    <div class="form-container" style="text-align: center">
        <div class="form-form" style="background-color: #3b3f5c; border-top-right-radius: 25%">
            <div class="form-form-wrap" style="padding: 2%">
                <div class="form-content ">
                    <br>
                    <h1 class="text-center form-wrap"
                        style="color: #F7F8FF; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size: 50px""><span class="
                        "><b>Sistema de
                            Ventas</b></span></h1>
                    <form class="text-left mt-5" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form">
                            <div id="username-field" class="input mt-5">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Correo Electronico" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div id="password-field" class="input mt-5">
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="justify-content-end form-content">
                                @if (Route::has('password.request'))
                                    <a class="text-light" style="width: 60%; height: 90%"
                                        href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu Contraseña?') }}
                                    </a>
                                @endif
                            </div>
                            {{-- <div class="row mb-3"> --}}
                            <div class="mt-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-light" for="remember"
                                        style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size: 16px; ">
                                        {{ __('Recordar Credenciales') }}
                                    </label>
                                </div>
                                {{-- </div> --}}
                            </div>
                            <br><br>
                            <div class="field mt-3">
                                <button type="submit" class="btn btn-link btn-block a:link" value=""
                                    style="color: #3b3f5c; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size: 25px">Iniciar
                                    Sesion</button>
                            </div>
                        </div>
                    </form>
                    <p style="padding: 0%" class="terms-conditions text-center text-light">© 2022 All Rights Reserved. <a
                            href="#">Devinson B.</a> <br>versión 1.0</p>
                </div>
                </form>
            </div>
        </div>
        <div class="form-image justify-content-center form-container container">
            <video class="video-fluid" autoplay loop muted>
                <source src="video/video.mp4" type="video/mp4" />
            </video>
        </div>
    </div>
@endsection
