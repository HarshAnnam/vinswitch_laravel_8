@extends('layouts.loginLayout.main')
@section('title', 'Sign Up')
@section('content')
					<!-- title-->
                        <h4 class="mt-0">Sign Up</h4>
                        <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute</p>
						@include('layouts.alertmessage')
                        <!-- form -->
                        <form action="#">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" required placeholder="Enter your email" value="{{old('email')}}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" placeholder="Enter your password" >
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signup" >
                                    <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="text-center d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit"> Sign Up </button>
                            </div>
                           
                        </form>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">Already have account? <a href="{{route('login')}}" class="text-muted ms-1"><b>Log In</b></a></p>
                        </footer>
@endsection