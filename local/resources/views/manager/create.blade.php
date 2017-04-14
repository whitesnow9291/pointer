@extends('app')
@section('content')
<link href="{{asset('css/manager/create.css')}}" rel="stylesheet" />
<script type="text/javascript">
    $(function() {
       $("#sidebar > ul li").removeClass('active');
        $(".master_href").addClass('open').addClass('active');
        $(".manager_href").addClass('active');
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
						<li class="active">運営者の新規登録</li>
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
									<i class="icon-edit"></i> 運営者情報を入力してください。
								</h3>
								<form class="form-horizontal" role="form" id="input-form" method="POST" action="{{ url('manager/createconfirm') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
    								<div class="control-group">
    									<label class="control-label" for="input-name">氏名</label>
    
    									<div class="controls">
    										<input type="text" id="input-name" name="data[name]" placeholder="氏名" value="{{{ isset($record['name']) ? $record['name'] : old('data.name') }}}" />
    										<?php g_renderError('data.name', $errors) ?>
    									</div>
    								</div>
									<div class="control-group">
    									<label class="control-label" for="input-kananame">運営者カナ名</label>
    
    									<div class="controls">
    										<input type="text" id="input-kananame" name="data[kananame]" placeholder="運営者カナ名" value="{{{ isset($record['kananame']) ? $record['kananame'] : old('data.kananame') }}}" />
    										<?php g_renderError('data.kananame', $errors) ?>
    									</div>
    								</div>
    								<div class="control-group">
    									<label class="control-label" for="input-email">メールアドレス</label>
    
    									<div class="controls">
    										<input type="text" id="input-email" name="data[email]" placeholder="メールアドレス" value="{{{ isset($record['email']) ? $record['email'] : old('data.email') }}}" />
    										<?php g_renderError('data.email', $errors) ?>
    									</div>
    								</div>

    								<div class="control-group">
    									<label class="control-label" for="input-password">パスワード</label>
    
    									<div class="controls">
    										<input type="password" id="input-password" name="data[password]" placeholder="パスワード" value="{{{ isset($record['password']) ? $record['password'] : old('data.password') }}}" />
    										<span class="help-inline">6文字以上の半角文字</span>
    										<?php g_renderError('data.password', $errors) ?>
    									</div>
    								</div>

    								<div class="control-group">
    									<label class="control-label" for="input-password_confirmation">パスワード確認</label>
    
    									<div class="controls">
    										<input type="password" id="input-password_confirmation" name="data[password_confirmation]" placeholder="パスワード確認" />
    									</div>
    								</div>
    								
    								<div class="form-actions">
    									<a href="{{ url('/manager/index') }}" class="btn btn-inverse"><i class="icon-circle-arrow-left bigger-110"></i>戻る</a>&nbsp;&nbsp;&nbsp;
    									<a href="{{ url('/manager/create') }}" class="btn" type="reset"><i class="icon-undo bigger-110"></i>リセット</a>&nbsp;&nbsp;&nbsp;
    									<button class="btn btn-info" type="submit"><i class="icon-ok bigger-110"></i>確認</button>
    								</div>    								
								</form>
							</div>
							
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection