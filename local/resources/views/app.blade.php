<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>地点情報管理システム</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- basic styles -->

		<link href="{{asset('css/ace/bootstrap.min.css')}}" rel="stylesheet" />	
		<link rel="stylesheet" href="{{asset('css/ace/font-awesome.min.css')}}" />
		<link href="{{ asset('css/ace/bootstrap-responsive.min.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('css/ace/ace.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace/ace-rtl.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace/ace-skins.min.css')}}" />

		<link rel="stylesheet" href="{{asset('css/ace/jquery-ui-1.10.3.custom.min.css')}}" />
		
		
		<link rel="stylesheet" href="{{asset('css/ace/chosen.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace/datepicker.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace/bootstrap-timepicker.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace/daterangepicker.css')}}" />
		<link rel="stylesheet" href="{{asset('css/ace/select2.css')}}" />
		<link rel="stylesheet" href="{{asset('css/common.css')}}" />
		@yield('header-style')
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

	
		<!-- ace settings handler -->
		
		<!-- basic scripts -->

		<!--[if !IE]> -->
		@yield('header-script')
		<script src="{{asset('js/ace/ace-extra.min.js')}}"></script>
		<script src="{{asset('js/ace/jquery.min.js')}}"></script>
		<script src="{{asset('js/ace/bootstrap.min.js')}}"></script>      
        <script src="{{asset('js/ace/typeahead-bs2.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery-ui-1.10.3.custom.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.ui.touch-punch.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.easy-pie-chart.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.sparkline.min.js')}}"></script>
        
        

        
		<script src="{{asset('js/navbar.js')}}"></script>
		<script src="{{asset('js/ace/ace-elements.min.js')}}"></script>
        <script src="{{asset('js/ace/ace.min.js')}}"></script>
		<script src="{{asset('pointer/jquery.uploadify-3.1.js')}}"></script>
        <script src="{{asset('pointer/jquery.deleteupload.js')}}"></script>
        <script src="{{asset('pointer/jquery.updateupload.js')}}"></script>
		
		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		
		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='js/ace/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		
		
		<script src="{{asset('js/ace/jquery.gritter.min.js')}}"></script>
		<script src="{{asset('js/ace/spin.min.js')}}"></script>
		
		<script src="{{asset('js/validation.js')}}"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
		
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed');}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							地点情報管理システム
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								
								<span class="user-info">				
									{{ Auth::user()->name }}
									<small>さん：</small>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="{{ url('/manager/edit?id=' . Auth::user()->id) }}">
										<i class="icon-user"></i>
										情報変更
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{ url('/auth/logout') }}">
										<i class="icon-off"></i>
										ログアウト
									</a>
								</li>
							</ul>
					</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed');}catch(e){}
			</script>

			<div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>
				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed');}catch(e){}
					</script>
					<script type="text/javascript">
						$("ul.nav nav-list > li").toggleClass('active');
					</script>
					<ul class="nav nav-list">

						<li class="pointer_href">
							<a href="{{url('pointer/index')}}">
								<i class="icon-tag"></i>
								<span class="menu-text">ポインタ管理</span>
							</a>
						</li>
						<li class="active master_href">
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text">マスター管理</span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li class="manager_href">
									<a href="{{url('manager/index')}}">
										<i class="icon-double-angle-right"></i>
										運営者管理
									</a>
								</li>

								<li class="category_href">
									<a href="{{url('category/index')}}">
										<i class="icon-double-angle-right"></i>
										カテゴリ管理
									</a>
								</li>
							</ul>
						</li>  <!--
						<li class="maptiler_href">
							<a href="{{url('maptiler')}}" class="dropdown-toggle">
								<i class="icon-list-alt"></i>
								<span class="menu-text">マップtiler</span>
							</a>
						</li>      -->
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed');}catch(e){}
					</script>
				</div>
				
				<div class="main-content" style="height: 100%;">
					
					@yield("content")
					
				</div><!-- /.main-content -->
				
			</div><!-- /.main-container-inner -->

		</div><!-- /.main-container -->
		
		<script src="{{asset('js/ace/bootbox.min.js')}}"></script>
		

		

		
		
		
		@yield('bottom-script')
		
		
	</body>


</html>
