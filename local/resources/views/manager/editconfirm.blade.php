@extends('app')

@section('content')
<link href="{{asset('css/manager/create.css')}}" rel="stylesheet" />
<script src="{{asset('js/manager/common.js')}}"></script>

<script src="{{asset('js/manager/messages_ja.js')}}"></script>
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
						<li class="active">運営者の情報変更（確認）</li>
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
									<i class="icon-edit"></i> 運営者の変更情報を確認してください。
								</h3>
								<form class="form-horizontal" role="form" id="input-form" method="POST" action="{{ url('manager/editfinish') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="_requestTime" value="{{ time() }}" />
    								<div class="control-group">
    									<label class="control-label" for="input-name">氏名</label>
    
    									<div class="controls">
    										{{{ $record['name'] }}}
    									</div>
    								</div>
									<div class="control-group">
    									<label class="control-label" for="input-kananame">運営者カナ名</label>
    
    									<div class="controls">
    										{{{ $record['kananame'] }}}
    									</div>
    								</div>
    								
    								<div class="control-group">
    									<label class="control-label" for="input-email">メールアドレス</label>
    
    									<div class="controls">
    										{{{ $record['email'] }}}
    									</div>
    								</div>

    								<div class="control-group">
    									<label class="control-label" for="input-password">パスワード</label>
    
    									<div class="controls">
    										{{{ empty($record['password']) ? '変更しない' : str_repeat('●', strlen($record['password'])) }}}
    									</div>
    								</div>
    								
    								@foreach($record as $field => $value)
    								<input type="hidden" name="data[{{ $field }}]" value="{{ $value }}" />
    								@endforeach

    								<div class="form-actions">
    									<button class="btn btn-inverse" type="button" onclick="javascript:submitForm('#input-form', '{{ url('/manager/edit') }}');"><i class="icon-circle-arrow-left bigger-110"></i>戻る</button>&nbsp;&nbsp;&nbsp;
    									<button class="btn btn-info" type="submit"><i class="icon-ok bigger-110"></i>変更</button>
    								</div>
								</form>
							</div>
							
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection