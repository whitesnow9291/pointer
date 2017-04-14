@extends('app')

@section('content')
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="{{url('/')}}">ホーム</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li class="active">404エラー</li>
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
											<i class="icon-sitemap"></i>
											404
										</span>
										ページが見つかりませんでした。
									</h1>

									<hr />
									<h3 class="lighter smaller">ページURL:　{{ $_SERVER['REQUEST_URI'] }}</h3>

									<div>
										<form class="form-search">
											<span class="input-icon">
												<i class="icon-search"></i>

												<input type="text" class="input-medium search-query" placeholder="Give it a search..." />
											</span>
											<button class="btn btn-small" onclick="return false;">Go!</button>
										</form>

										<div class="space"></div>
										<h4 class="smaller">下記の操作を試してみてください：</h4>

										<ul class="unstyled spaced inline bigger-110">
											<li>
												<i class="icon-hand-right blue"></i>
												URLを正しく入力したか再度確認する
											</li>

											<li>
												<i class="icon-hand-right blue"></i>
												よくある質問（FAQ）を確認する
											</li>

											<li>
												<i class="icon-hand-right blue"></i>
												このエラーに対して運営者に連絡する
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
							</div><!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection
