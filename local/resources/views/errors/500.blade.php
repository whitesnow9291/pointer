@extends('app')

@section('content')
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="{{url('/')}}">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li class="active">500エラー</li>
					</ul><!--.breadcrumb-->

					<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="icon-search nav-search-icon"></i>
							</span>
						</form>
					</div><!--#nav-search-->
				</div>

				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<div class="error-container">
								<div class="well">
									<h1 class="grey lighter smaller">
										<span class="blue bigger-125">
											<i class="icon-random"></i>
											500
										</span>
										アプリケーションエラーが発生しました。
									</h1>
									詳細： {{ $e->getMessage() }}

									<hr />
									<h3 class="lighter smaller">
										お迷惑をおかけしまして、申し訳ありません。今も更新
										<i class="icon-wrench icon-animated-wrench bigger-125"></i>
										中です。
									</h3>

									<div class="space"></div>

									<div>
										<h4 class="lighter smaller">その間に下記の操作を試してみてください：</h4>

										<ul class="unstyled spaced inline bigger-110">
											<li>
												<i class="icon-hand-right blue"></i>
												よくある質問（FAQ）を確認する
											</li>

											<li>
												<i class="icon-hand-right blue"></i>
												どのようにエラーが発生したか運営者に連絡する
											</li>
										</ul>
									</div>

									<hr />
									<div class="space"></div>

									<div class="row-fluid">
										<div class="center">
											<a href="javascript:history.back();" class="btn btn-grey">
												<i class="icon-arrow-left"></i>
												戻る
											</a>

											<a href="{{url('/')}}" class="btn btn-primary">
												<i class="icon-dashboard"></i>
												ホームに遷移する
											</a>
										</div>
									</div>
								</div>
							</div>

							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection
