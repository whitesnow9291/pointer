<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>地点情報</title>
        <link rel="stylesheet" href="{{asset('css/user_mapview/ol.css')}}">
        <link href="{{asset('css/ace/bootstrap.min.css')}}" rel="stylesheet" />    
        <link rel="stylesheet" href="{{asset('css/ace/font-awesome.min.css')}}" />
        <link href="{{ asset('css/ace/bootstrap-responsive.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/ace/ace.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/ace/ace-rtl.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/ace/ace-skins.min.css')}}" />

        <link rel="stylesheet" href="{{asset('css/ace/jquery-ui-1.10.3.custom.min.css')}}" />   
      
        <script src="{{asset('js/ace/ace-extra.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.min.js')}}"></script>
        <script src="{{asset('js/ace/bootstrap.min.js')}}"></script>      
        <script src="{{asset('js/ace/typeahead-bs2.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery-ui-1.10.3.custom.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.ui.touch-punch.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.easy-pie-chart.min.js')}}"></script>
        <script src="{{asset('js/ace/jquery.sparkline.min.js')}}"></script>       
        <script src="{{asset('js/ace/ace-elements.min.js')}}"></script>
        <script src="{{asset('js/ace/ace.min.js')}}"></script>        
        <script src="{{asset('js/user_mapview/jquery.fancybox.js')}}"></script>
        <script src="{{asset('js/user_mapview/jquery.fancybox-buttons.js')}}"></script>                 
      
       
    <script src="{{asset('js/openlayer/ol.js')}}"></script>  
</head>
<body>
	

	@yield('content')
    
</body>
</html>
