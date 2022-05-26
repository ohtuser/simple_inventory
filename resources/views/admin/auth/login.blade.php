<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('layouts.header_script')
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

    </style>
</head>

<body>
    {{-- <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="mt-5">
                                <h3 class="text-center">{{ getProjectName() }}</h3>
                            </div>
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form_submit" action="{{ route('login_attempt') }}">
                                        <div class="form-group">
                                            <label for="inputEmail">Email address</label>
                                            <input class="form-control" name="email" id="inputEmail" type="email"
                                                placeholder="name@example.com" />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputPassword">Password</label>
                                            <input class="form-control" name="password" id="inputPassword"
                                                type="password" placeholder="Password" />
                                        </div>
                                        {{-- <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <a class="small" href="{{ route('forgot_password') }}">Forgot
            Password?</a>
        <button class="btn btn-primary">Login</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </main>
    </div>
    </div> --}}

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container h-100" style="overflow: hidden">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <h4 class="mt-1 pb-1">Please login to your account</h4>
                                    </div>

                                    <form class="form_submit" action="{{ route('login_attempt') }}">
                                        <div class="form-outline">
                                            <input type="email" id="form2Example11" class="form-control"
                                                placeholder="Email address" name="email" />
                                            <label class="form-label" for="form2Example11">Email</label>
                                        </div>

                                        <div class="form-outline">
                                            <input type="password" name="password" id="form2Example22"
                                                class="form-control" />
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 py-1 mb-3"
                                                type="submit">Log
                                                in</button>
                                            <a class="text-muted" href="{{ route('forgot_password') }}">Forgot
                                                password?</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h3 class="text-center">{{ getProjectName() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer_script')
</body>

</html>
