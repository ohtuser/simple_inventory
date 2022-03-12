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
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="mt-5"><h3 class="text-center">{{getProjectName()}}</h3></div>
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form class="form_submit" action="{{route('login_attempt')}}">
                                            <div class="form-group">
                                                <label for="inputEmail">Email address</label>
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="inputPassword">Password</label>
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            </div>
                                            {{-- <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div> --}}
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
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
        </div>
        @include('layouts.footer_script')
    </body>
</html>
