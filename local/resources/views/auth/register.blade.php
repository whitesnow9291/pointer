<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title>Login Page - Ace Admin</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="{{ asset('css/ace/bootstrap.min.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="{{ asset('css/ace/font-awesome.min.css') }}" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="{{ asset('css/ace/font-awesome-ie7.min.css') }}" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- ace styles -->

		<link rel="stylesheet" href="{{ asset('css/ace/ace.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/ace/ace-rtl.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/login/login.css') }}" />
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="{{ asset('css/ace/ace-ie.min.css') }}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5 shim and Respond.js') }} IE8 support of HTML5 elements and media queries -->
		<script src="{{ asset('js/ace/jquery-2.0.3.min.js') }}"></script>
		<script src="{{ asset('js/login/validate.js') }}"></script>
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="icon-leaf green"></i>
									<span class="red">ポインタ設定</span>
									<span class="white">管理システム</span>
								</h1>
								<h4 class="blue">&copy; 江戸東京音楽芸術</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border" style="margin-top:50px">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												あなたの情報を入力してください
											</h4>

											<div class="space-6"></div>
											<form role="form" method="POST" action="{{ url('/auth/login') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="name" id="name" placeholder="User Name" />
															<i class="icon-user"></i>
														</span>
													</label>
													<div class="error_hide show_error_div block error_name input-icon input-icon-left">
															<span>The name must be at least 3 characters.</span>
															<i class="icon-ban-circle"></i>
													</div>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="kananame" id="kananame" placeholder="User Kana Name" />
															<i class="icon-user"></i>
														</span>
													</label>
													<div class="error_hide show_error_div block error_name input-icon input-icon-left">
															<span>The kana name must be at least 3 characters.</span>
															<i class="icon-ban-circle"></i>
													</div>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="email" id="email" placeholder="User Email" />
															<i class="icon-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
															<i class="icon-lock"></i>
														</span>
													</label>
											        <div class="error_hide show_error_div block error_password input-icon input-icon-left">
															<span>The password must be at least 6 characters.</span>
															<i class="icon-ban-circle"></i>
													</div>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" />
															<i class="icon-lock"></i>
														</span>
													</label>
											        <div class="error_hide show_error_div block error_password input-icon input-icon-left">
															<span>The confirm password must be at least 6 characters.</span>
															<i class="icon-ban-circle"></i>
													</div>
													<div class="space"></div>
													<div class="error_show show_error_div block input-icon input-icon-left">
													<?php 
														foreach ($errors->all() as $message) {
														    echo $message."<br>";
														}											
													?>
													</div>
													<div class="clearfix">
														<button type="submit" class="login_bt width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key"></i>
															Register
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

									
										</div><!-- /widget-main -->

									
									</div><!-- /widget-body -->
								</div><!-- /login-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->
	</body>

<!-- Mirrored from 192.69.216.111/themes/preview/ace/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 10 Dec 2013 00:49:35 GMT -->
</html>
