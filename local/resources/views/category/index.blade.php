@extends('app')

@section('header-style')
<style type="text/css">
ul.pagination {margin:0;}
form {margin: 0 0 5px;}
.table {margin-bottom: 5px;}
</style>
@endsection
@section('bottom-script')

<script type="text/javascript">
    $(function() {
        $("a[href*='/delete/']").click(function() {
            if (confirm(MSG_COMMON_DEL_CONFIRM)) {
                return true;
            }
            return false;
        });
        $("#sidebar > ul li").removeClass('active');
        $(".master_href").addClass('open').addClass('active');
        $(".category_href").addClass('active');
        var navbar_h=$("#navbar").height();
        var homebar_h=$("#breadcrumbs").height();
        $(".page-content").height($(window).height()-navbar_h-homebar_h-50).css('overflow-x','auto');
    });
</script>
@endsection

@section('content')
<link href="{{asset('css/category/index.css')}}" rel="stylesheet" />
<script src="{{asset('js/manager/common.js')}}"></script>

<script src="{{asset('js/manager/messages_ja.js')}}"></script>     
<?php
//     /print_r2($delete_result);die();
 ?> 
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
									<i class="icon-search"></i> 検索条件
								</h3>
								<form class="form-search-box" id="condition-form" method="post" action="?search">
								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />     
								<div class="row-fluid">
								    <div class="span12"> 
								        <div class="span3">
        									<label class="control-label" for="condition-category_name">カテゴリ：</label>
                                            <input type="text" id="condition-category_name" name="condition[category_name]" class="input-medium" placeholder="カテゴリ" value="{{ $condition['category_name'] }}" />
        								</div>
                                                                                
                                        <div class="span3">
										<button class="btn btn-small btn-primary" type="submit">
											<i class="icon-search"></i> 検索  
										</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button id="condition-reset" class="btn btn-small" type="button">  クリア  </button>
                                        </div>
									</div>
								    
								</form>
							</div>
							
							<div class="row-fluid">
								<h3 class="header smaller lighter blue">
								    <i class="icon-table"> 
								    @if ($records->count() == 0)検索結果が見つかりませんでした。
								    @else <?php
								        $firstRecordNo = $records->perPage() * ($records->currentPage()-1) + 1;
								        $lastRecordNo  = $records->perPage() * $records->currentPage();
								        if ($lastRecordNo > $records->count()) {
								            $lastRecordNo = $records->count();
								        }
								    ?>検索結果:　{{ $total }}件中、{{ $records->count() }}件が見つかりました。 ( {{ $firstRecordNo }} ～ {{ $lastRecordNo }} )
								    @endif 
								    </i>
								</h3>
								
							</div>
						
						    <div class="row-fluid" style="padding:5px;">
						        <div class="span6">
									<a class="btn btn-small btn-success" href="{{ url('/category/create') }}"><i class="icon-asterisk"></i>新規追加</a>&nbsp;&nbsp;&nbsp;
									<button class="btn btn-small btn-danger delete-multiple" type="button"><i class="icon-trash"></i>一括削除</button>
						        </div>
						        <div class="span6 align-right">
									<div class="pagination" style="margin:0;line-height:20px;">
										<?php ob_start(); ?>
										{!! $records->render() !!}
										<?php
										$strPagenavi = ob_get_clean();
										echo $strPagenavi;
										?>
									</div>
						        </div>
						    </div>
						   @if(isset($delete_result))
                                
                                    @if ($delete_result['result']=='success')
                                        <div class="alert alert-info">
                                            <p>削除成功!</p>
                                        </div>
                                    @endif
                                    @if ($delete_result['result']=='error')
                                        <div class="alert alert-danger">
                                        <p>1件以上の地点が登録されているカテゴリは削除できません。    ({{$delete_result['categories']}})</p>
                                        </div>
                                    @endif  
                                
                           @endif
							<div class="row-fluid">
								<div class="span12">
								  <form id="list-form" method="post" action="?delete">
								    <input type="hidden" name="_method" value="DELETE" />
								    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
								    <input type="hidden" name="_requestTime" value="{{ time() }}" />
									<table id="table-record-list" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="center">
													<label>
														<input type="checkbox" class="ace" />
														<span class="lbl"></span>
													</label>
												</th>
												<th>ID</th>
												<th>
													<a href="{{ url('/category/index?sort=category_name&requestTime=' . time()) }}">カテゴリ</a>
													<?php g_AdminSortIcon($sort, 'category_name', $sortOrder); ?>	
												</th> 
                                                <th>
                                                    <a href="{{ url('/category/index?sort=pointer_color&requestTime=' . time()) }}">ポインタ設定色</a>
                                                    <?php g_AdminSortIcon($sort, 'pointer_color', $sortOrder); ?>    
                                                </th>
												
												<th class="hidden-480">
													<a href="{{ url('/category/index?sort=created_at&requestTime=' . time()) }}">
														<i class="icon-time bigger-110 hidden-phone"></i>登録日時
													</a>
													<?php g_AdminSortIcon($sort, 'created_at', $sortOrder); ?>
												</th>
												<th class="hidden-phone">
													<a href="{{ url('/category/index?sort=updated_at&requestTime=' . time()) }}">
														<i class="icon-time bigger-110 hidden-phone"></i>更新日時
													</a>
													<?php g_AdminSortIcon($sort, 'updated_at', $sortOrder); ?>
												</th>
									
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										@foreach($records as $record)
											<tr>
												<td class="center">
													<label>
														<input type="checkbox" class="ace" name="chk[{{{ $record->id }}}]" />
														<span class="lbl"></span>
													</label>
												</td>
												<td>{{{ $record->id }}}</td>
												<td>{{{ $record->category_name }}}</td>  
                                                <td><img style="background:{{{ $record->pointer_color }}};width:20px;height:20px;display: -moz-box;"/></td>
												<td class="hidden-480">{{{ $record->created_at }}}</td>
												<td class="hidden-phone">{{{ $record->updated_at }}}</td>

												

												<td>
													<div class="hidden-phone visible-desktop btn-group">
														<a class="btn btn-small btn-info" href="{{ url('/category/edit?id=' . $record->id) }}">
															<i class="icon-edit bigger-140 icon-only"></i>
														</a>

														<a class="btn btn-small btn-danger" href="{{ url('/category/delete/' . $record->id) }}">
															<i class="icon-trash bigger-140 icon-only"></i>
														</a>
													</div>

													<div class="hidden-desktop visible-phone">
														<div class="inline position-relative">
															<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
																<i class="icon-cog icon-only bigger-130"></i>
															</button>

															<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
																<li>
																	<a href="{{ url('/category/edit?id=' . $record->id) }}" class="tooltip-success" data-rel="tooltip" title="編集">
																		<span class="green">
																			<i class="icon-edit bigger-140"></i>
																		</span>
																	</a>
																</li>

																<li>
																	<a href="{{ url('/category/delete/' . $record->id) }}" class="tooltip-error" data-rel="tooltip" title="削除">
																		<span class="red">
																			<i class="icon-trash bigger-140"></i>
																		</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</td>
											</tr>
										@endforeach
										<?php if ($records->count() == 0): ?>
											<tr>
												<td class="center" colspan="100">
													検索結果が見つかりませんでした。
												</td>
											</tr>
										<?php endif;?>
										</tbody>
									</table>
								  </form>
								</div><!--/span-->
							</div><!--/row-->
							
							<div class="row-fluid" style="padding:5px;">
						        <div class="span6">
									<a class="btn btn-small btn-success" href="{{ url('/category/create') }}"><i class="icon-asterisk"></i>新規追加</a>&nbsp;&nbsp;&nbsp;
									<button class="btn btn-small btn-danger delete-multiple" type="button"><i class="icon-trash"></i>一括削除</button>
						        </div>
						        <div class="span6 align-right">
									<div class="pagination" style="margin:5px;line-height:20px;">
										<?php echo $strPagenavi; ?>
									</div>
						        </div>
						    </div>

						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
@endsection