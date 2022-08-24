
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<style>
		.validation_error {
    color: red;
}
		</style>
        @include('layouts.loginLayout.loginCss')

    </head>

    <body class="loading auth-fluid-pages pb-0">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <div class="auth-logo">
                                <a href="#" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('')}}assets/images/logo-dark.png" alt="" height="22">
                                    </span>
                                </a>
            
                                <a href="#" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('')}}assets/images/logo-light.png" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                        </div>
						
                        @yield('content')

                        

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">I love the Vinswitch!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - Vinswitch ( Admin User)
                    </h5>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->
		@include('layouts.loginLayout.loginJs')
       
        
    </body>
</html>