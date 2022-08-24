@extends('layouts.loginLayout.main')
@section('title', 'Login')
@section('content')
					<!-- title-->
                        <h4 class="mt-0">Sign In</h4>
                        <p class="text-muted mb-4">Enter your email address and password to access account.</p>

						@include('layouts.alertmessage')
                        <!-- form -->
                        <form action="{{route('login_auth')}}" method="post">
						@csrf
                            <div class="mb-3">
                                <label for="forusername" class="form-label">Email address</label>
                                <input class="form-control" type="text" name="email" id="username" required="" placeholder="Enter your username" value="{{old('email')}}">
								@error('email')<div class="validation_error">{{$message}}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <a href="{{route('forgotPassword')}}" class="text-muted float-end"><small>Forgot your password?</small></a>
                                <label for="forpassword" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
								@error('password')<div class="validation_error">{{$message}}</div>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit">Log In </button>
                            </div>
                           
                        </form>
                        <!-- end form-->
						<!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">Don't have an account? <a href="{{route('signup')}}" class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </footer>
@endsection