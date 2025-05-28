<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>osu!win21 - Register</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="shortcut icon"
        href="https://cdn.discordapp.com/emojis/1199139517198770206.png?size=48&quality=lossless" />
</head>

<body>
    <div class="container-scroller">
        @include('user.layouts.error')
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img
                                    src="https://cdn.discordapp.com/emojis/1199139517198770206.png?size=48&quality=lossless">
                            </div>
                            <h4>Ngentot! let's get signed up</h4>
                            <h6 class="font-weight-light">Sign up to continue.</h6>
                            <form class="pt-3" method="POST" action="{{ route('registerProcess') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="username"
                                        name="username" placeholder="Username" minlength="2" maxlength="15" pattern="^[a-zA-Z0-9_ ]+$" title="Username must be unique and contain only letters, numbers, underscores, or spaces." required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email"
                                        name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password"
                                        name="pw_bcrypt" placeholder="Password" minlength="8" maxlength="32" required>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" required>I agree to all Terms & Conditions</label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">Already have an account? <br>Yoooo stop multi-accounting dawg, go <a href="login.html" class="link link-primary">Sign In</a> or Perma'd</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/user/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/user/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/user/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/user/js/misc.js') }}"></script>
    <script src="{{ asset('assets/user/js/error.js') }}"></script>
    <!-- endinject -->
</body>

</html>
