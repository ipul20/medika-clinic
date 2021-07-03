
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title>Login</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="{{ asset('css/login-4.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<link rel="shortcut icon" href="{{asset('icon/icon.ico')}}" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
				<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset('bg-3.jpg') }});">
					<div class="login-form text-center p-7 position-relative overflow-hidden">
						<!--begin::Login Header-->
						<div class="d-flex flex-center mb-5">
							<a href="#">
								<img src="{{ asset('log.png') }}" class="" width="40%" alt="" />
							</a>
						</div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin mb-30">
							<div class="mb-20">
								<h3>Sign In To Admin</h3>
								<div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
							</div>
							<form class="kt_login_signin_form user" method="POST" action="{{route('login')}}">
								@csrf
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="email" autocomplete="off" />
									@error('username')
										<div class="text-danger align-items-left">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
									@error('password')
										<div class="text-danger align-items-left">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group d-flex flex-wrap justify-content-between align-items-center">
									<div class="checkbox-inline">
										<label class="checkbox m-0 text-muted">
										<input type="checkbox" name="remember" />
										<span></span>Remember me</label>
									</div>
								</div>
								<button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
	</body>
	<!--end::Body-->
</html>