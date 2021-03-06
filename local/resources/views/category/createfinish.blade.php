@extends('app')

@section('content')
<script type="text/javascript">
    $(function() {
        $("#sidebar > ul li").removeClass('active');
        $(".master_href").addClass('open').addClass('active');
        $(".category_href").addClass('active');
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
						<li class="active">カテゴリ管理（完了）</li>
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
									<i class="icon-edit"></i> カテゴリ情報の登録が終わりました。
								</h3>
								@if ($result)
								<span>カテゴリ情報を登録しました。</span>
								@else
								<span>カテゴリ情報の登録が失敗しました。</span>
								@endif
								<form class="form-horizontal" role="form">
    								<div class="form-actions">
    									<a href="{{ url('/category/index') }}" class="btn btn-inverse"><i class="icon-table bigger-110"></i>一覧に戻る</a>&nbsp;&nbsp;&nbsp;
    									<a href="{{ url('/category/create') }}" class="btn btn-info">続けて新規登録</a>
    								</div>
								</form>
							</div>
							
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection
