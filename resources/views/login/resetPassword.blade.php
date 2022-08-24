@extends('layouts.loginLayout.main')
@section('title', 'Reset Password')
@section('content')
					<!-- title-->
                        <h4 class="mt-0">Recover Password</h4>
                        <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
						
						@include('layouts.alertmessage')
						
                        <!-- form -->
                        <form action="{{route('resetPassword')}}" method="post">
							@csrf	
                            <div class="mb-3">
							
								<input type="hidden" value="{{$id}}" name="user_id">
								<div class="mb-3 mt-3">
									<label class="form-label">New Password</label>
									<input class="form-control" name="password" type="password" id="username" placeholder="Enter new password">
									@error('password')<div class="validation_error">{{$message}}</div>@enderror
								</div>
								
								<div class="mb-3 mt-3">
									<label for="cpassword" class="form-label">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter confirm password">
                                </div>
                                @error('cpassword')<div class="validation_error">{{$message}}</div>@enderror
								</div>
                               
								
                            </div>

                            <div class="text-center d-grid">
								<button class="btn btn-primary waves-effect waves-light" type="submit"> Reset Password </button>
                            </div>

                        </form>
                        <!-- end form-->

                        
@endsection
