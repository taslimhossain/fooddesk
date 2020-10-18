@extends('layouts.front') @section('content')
	<!--=============================================
    =            breadcrumb area         =
    =============================================-->

    <div class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="breadcrumb-container">
						<ul>
							<li><a href="{{route('home')}}"><i class="fa fa-home"></i> {{ __('f.home') }}</a></li>
                        <li class="active" ><a href="{{route('registerUser')}}">{{__('f.signup')}}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of breadcrumb area  ======-->


	<!--=============================================
	=            Shop page container         =
	=============================================-->

<div class="page-content mb-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
					<!-- Login Form s-->
					<form method="POST" action="{{ route('signin') }}">
                        @csrf

						<div class="login-form">
							<h4 class="login-title">{{ __('f.login') }}</h4>
                            <input type="hidden" name="ref" value="{{request()->ref?request()->ref:'/'}}">
							<div class="row">
								<div class="col-md-12 col-12 mb-20">
									<input required name="email" class="mb-0" type="email" placeholder="{{ __('f.email_address') }}">
								</div>
								<div class="col-12 mb-20">
									<input required name="password" class="mb-0" type="password" placeholder="{{__('f.password')}}">
								</div>
								<div class="col-md-6">

									<div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
										<input type="checkbox" id="remember_me">
										<label for="remember_me">{{__('f.remember_me')}}</label>
									</div>

								</div>

								<div class="col-md-6 mt-10 mb-20 text-left text-md-right">
									<a href="{{ route('password.request') }}">{{__('f.forgotten_pasward')}}?</a>
								</div>

								<div class="col-md-12">
									<button class="register-button mt-0" style="float:right;">{{__('f.login')}}</button>
								</div>

							</div>
						</div>

					</form>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">
					<form action="{{ route('register') }}" method="post">
                        @csrf
						<div class="login-form">
							<h4 class="login-title">{{__('f.register')}}</h4>

							<div class="row">
								<div class="col-md-6 col-12 mb-20">
									<input value="{{ old('firstname') }}" required name="firstname" class="mb-0" type="text" placeholder="{{__('f.first_name')}}">
								</div>
								<div class="col-md-6 col-12 mb-20">
									<input value="{{ old('lastname') }}" required name="lastname" class="mb-0" type="text" placeholder="{{__('f.last_name')}}">
								</div>
								<div class="col-md-12 mb-20">
									<input value="{{ old('email') }}"  required name="email" class="mb-0" type="email" placeholder="{{__('f.email_address')}}">
								</div>

								<div class="col-12">
                                    <input value="{{ old('telephone') }}"  name="telephone" type="text" placeholder="{{__('m.phone')}}">
									<input value="{{ old('address1') }}" required name="address1" type="text" placeholder="{{__('f.address')}}">

								</div>


								<div class="col-md-6 col-12">
									<input value="{{ old('town') }}" required name="town" type="text" placeholder="{{__('f.town_city')}}">
								</div>

								<div class="col-md-6 col-12">
									<input value="{{ old('zip') }}" required name="zip" type="text" placeholder="{{__('f.zip_code')}}">
								</div>

								<div class="col-md-6 mb-20">
									<input required name="password" class="mb-0" type="password" placeholder="{{__('f.password')}}" onkeyup="confirmCheck()" id="accountPassword">
								</div>
								<div class="col-md-6 mb-20">
									<input id="cPassword" required name="password_confirmation" class="mb-0" type="password" placeholder="{{__('f.confirm_password')}}" onkeyup="confirmCheck()">
								</div>
                                <span style="display:none" id="pass_match" class="text text-danger">Password Doesn't Match</span>

                                <script>
                                    let confirmCheck=()=>{

                                                if(!document.getElementById("cPassword").value){
                                                    return;
                                                }
                                                if(document.getElementById("accountPassword").value!=document.getElementById("cPassword").value){

                                                    document.getElementById("snp").setAttribute('disabled', true)
                                           document.getElementById("pass_match").style.display = "";
                                                }
                                                else{
                                                    document.getElementById("snp").removeAttribute('disabled')
                                                    document.getElementById("pass_match").style.display = "none";
                                                }
                                            }
                                </script>
								<div class="col-12">
									<button id="snp" class="register-button mt-0" style="float:right;">{{__('f.register')}}</button>
								</div>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Shop page container  ======-->
@endsection


@section('script')
@if(request()->success)
<script>
                        toastr.success("{{__('f.signup_success')}}");

                        </script>
@endif
@if(request()->verified)
<script>
                        toastr.success("{{__('f.email_verified_successfully')}}");

                        </script>
@endif
 @error('password')
                        <script>
                        toastr.error("{{ $message }}");

                        </script>
@enderror
 @error('email')
                        <script>
                        toastr.error("{{ $message }}");

                        </script>
@enderror

@endsection
