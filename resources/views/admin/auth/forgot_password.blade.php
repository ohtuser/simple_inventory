<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Forgot Password</title>
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
                            <div class="mt-5">
                                <h3 class="text-center">{{ getProjectName() }}</h3>
                            </div>
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Forgot Password</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group email_form_group">
                                        <label for="inputEmail">Email address</label>
                                        <input class="form-control" name="email" id="inputEmail" type="email"
                                            placeholder="name@example.com" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary send_otp_button" type="button">Send
                                            OTP</button>
                                    </div>

                                    <div class="form-group verify_otp_group" style="display: none">
                                        <label for="verifyOtp">Verify OTP</label>
                                        <input class="form-control" id="verifyOtp" placeholder="123456" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary verify_otp_button" type="button"
                                            style="display: none">Verify OTP</button>
                                    </div>

                                    <div style="display: none" class="submitable_form">
                                        <form action="{{ route('change_password') }}" class="form_submit">
                                            <input type="hidden" name="user_id" id="user_id">
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input class="form-control" name="password" id="password"
                                                    type="password" />
                                            </div>
                                            <button type="submit" class="btn btn-success btn-sm mt-1">Update New
                                                Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('layouts.footer_script')
    @include('layouts.common');
    <script>
        var user_id = 0;
        $(document).ready(function() {
            $('.send_otp_button').click(function() {
                var email = $('#inputEmail').val();
                getLoadingStatus();
                customAjaxCall(function(res) {
                    customSweetAlert(function() {
                        console.log(res);
                        $('.email_form_group').hide();
                        $('.send_otp_button').hide();
                        user_id = res.info.id;
                        $('.verify_otp_group').show();
                        $('.verify_otp_button').show();
                    }, 'success', 'OTP Send', 'Check Your Email', false, 'center', 400);

                }, 'post', "{{ route('sent_otp') }}", {
                    email
                })
            });

            $('.verify_otp_button').click(function() {
                var otp = $('#verifyOtp').val();
                getLoadingStatus();
                customAjaxCall(function(res) {
                    customSweetAlert(function(res) {
                        $('.verify_otp_group').hide();
                        $('.verify_otp_button').hide();
                        $('#user_id').val(user_id);
                        $('.submitable_form').show();
                    }, 'success', 'OTP Matched', 'Set New Password', false, 'center', 400);

                }, 'get', "{{ route('verify_otp') }}", {
                    user_id,
                    otp
                })
            });
        });
    </script>
</body>

</html>
