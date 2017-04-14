@extends('app')
@section('content')
<link href="{{asset('css/manager/create.css')}}" rel="stylesheet" />
<link href="{{asset('css/ace/colorpicker.css')}}" rel="stylesheet" />
<link href="{{asset('css/category/create.css')}}" rel="stylesheet" />
<link href="{{asset('css/ace/font-awesome.min.css')}}" rel="stylesheet" />  

<script src="{{asset('js/ace/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('js/color/jqColorPicker.min.js')}}"> </script>
<script type="text/javascript">    
    $(function() {
        $("#sidebar > ul li").removeClass('active');
        $(".master_href").addClass('open').addClass('active');
        $(".category_href").addClass('active');
        var color="<?php echo isset($record['pointer_color']) ? $record['pointer_color'] : old('data.pointer_color'); ?>";
        $("#pointer_color_id").val(color);
        $('.colorpicker').colorPicker(); 
    });
</script>
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="{{ url('/') }}">ホーム</a>

						</li>

						<li>マスタ管理
						</li>
						<li class="active">カテゴリ管理</li>
					</ul><!--.breadcrumb-->
				</div>

				<div class="page-content">
					<!-- <div class="page-header position-relative">
						<h1>
							運営者一覧
						</h1>
					</div> --><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
							
							<div class="row-fluid">
								<h3 class="header smaller lighter blue">
									<i class="icon-edit"></i> カテゴリ情報を入力してください。
								</h3>
								<form class="form-horizontal" role="form" id="input-form" method="POST" action="{{ url('category/createconfirm') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
    								<div class="control-group">
    									<label class="control-label" for="input-category_name">カテゴリ</label>
    
    									<div class="controls">
    										<input type="text" id="input-category_name" name="data[category_name]" placeholder="カテゴリ" value="{{{ isset($record['category_name']) ? $record['category_name'] : old('data.category_name') }}}" />
    										<?php g_renderError('data.category_name', $errors) ?>
    									</div> 
    								</div>

                                    <div class="control-group pointer_color_div">
									   <label class="control-label" for="pointer_color_id">ポインタ設定色</label>
                                           <input id="pointer_color_id" value="#FFFFFF"class="colorpicker" name="data[pointer_color]" />				
                                    </div>				
    								<div class="form-actions">
    									<a href="{{ url('/category/index') }}" class="btn btn-inverse"><i class="icon-circle-arrow-left bigger-110"></i>戻る</a>&nbsp;&nbsp;&nbsp;
    									<a href="{{ url('/category/create') }}" class="btn" type="reset"><i class="icon-undo bigger-110"></i>リセット</a>&nbsp;&nbsp;&nbsp;
    									<button class="btn btn-info" type="submit"><i class="icon-ok bigger-110"></i>確認</button>
    								</div>    								
								</form>
							</div>
							
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection