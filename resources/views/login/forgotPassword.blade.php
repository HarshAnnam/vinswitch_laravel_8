@extends('layouts.loginLayout.main')
@section('title', 'Forgot Password')
@section('content')
					<!-- title-->
                        <h4 class="mt-0">Recover Password</h4>
                        <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
						
						@include('layouts.alertmessage')
						
                        <!-- form -->
                        <form action="{{route('SendResetPasswordLink')}}">
							@csrf	
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email">
								@error('email')<div class="validation_error">{{$message}}</div>@enderror
                            </div>

                            <div class="text-center d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit"> Reset Password </button>
                            </div>

                        </form>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">Back to <a href="{{route('login')}}" class="text-muted ms-1"><b>Log in</b></a></p>
                        </footer>
@endsection







