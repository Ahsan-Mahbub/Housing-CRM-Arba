<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Arba Housing || CRM</title>

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="/asset/backend_asset/assets/media/photos/logo.jpeg">
        <link rel="icon" type="image/png" sizes="192x192" href="/asset/backend_asset/assets/media/photos/logo.jpeg">
        <link rel="apple-touch-icon" sizes="180x180" href="/asset/backend_asset/assets/media/photos/logo.jpeg">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
        <link rel="stylesheet" id="css-main" href="/asset/backend_asset/assets/css/codebase.min.css">
    </head>
    <body>

        <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-body-dark bg-pattern" style="background-color: rgb(78 19 12)!important;">
                    <div class="row mx-0 justify-content-center">
                        <div class="hero-static col-lg-6 col-xl-4">
                            <div class="content content-full overflow-hidden">
                                <!-- Header -->
                                <div class="py-30 text-center">
                                    <h1 class="h4 font-w700 mt-30 text-white mb-10">Arba Housing - CRM</h1>
                                    <h2 class="h5 font-w400 text-white mb-0">Please Enter Your E-mail & Password</h2>
                                </div>
                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-lock" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="block block-themed block-rounded block-shadow">
                                        <div class="block-content">
                                            <div class="form-group text-center">
                                                <img src="/asset/backend_asset/assets/media/photos/logo.jpeg" alt="" style="width: auto; height: 100px;">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="lock-email">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="lock-email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="info@gmail.com">
                                                    @error('email')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="lock-password">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="lock-password" name="password" required autocomplete="current-password" placeholder="*********">
                                                    @error('password')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-alt-danger">
                                                    <i class="si si-lock-open mr-10"></i> Unlock
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        <script src="/asset/backend_asset/assets/js/codebase.core.min.js"></script>
        <script src="/asset/backend_asset/assets/js/codebase.app.min.js"></script>
        <script src="/asset/backend_asset/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="/asset/backend_asset/assets/js/pages/op_auth_signin.min.js"></script>
    </body>
</html>