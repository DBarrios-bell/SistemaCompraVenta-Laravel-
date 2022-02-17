<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Sistema de Ventas</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{ asset('assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
</head>

<body class="form">

    {{-- <div class="form-container">
        <div class="form-form" style="background-color: #a5c0fe; border-radius: 10%">
            <div class="form-form-wrap">

                <div class="form-content container">





                    <h1 class="text-center"><span class="brand-name"><b>LWPOS</b></span>
                    </h1>
                    <h1 class="text-center"><span class="brand-name">Sistema de
                            Ventas</span></h1>
                    <form class="text-left mt-5" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="luisfaax@gmail.com" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="field-wrapper">
                                <button type="submit" class="btn btn-dark btn-block" value="">Aceptar</button>
                            </div>


                        </div>
                    </form>
                    <p class="terms-conditions text-center">© 2021 All Rights Reserved. <a
                            href="https://www.youtube.com/playlist?list=PLJjetMSzCM-oklVD-W3yVilbEXAbOk2Ns"
                            target="_blank">LUISFAX</a> <br>versión 1.0 </p>


                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
                </form>

            </div>
        </div>
        <div class="form-image" style="padding: 2%">
            @if (Route::has('password.request'))
                <a class="btn btn-dark lg-6" style="" href="{{ route('password.request') }}">
                    {{ __('Olvidaste tu Contraseña?') }}
                </a>
            @endif
            <video class="video-fluid" autoplay loop muted>
                <source src="video/video.mp4" type="video/mp4" />
            </video>
        </div>
    </div> --}}
    @yield('content')
</body>

</html>
