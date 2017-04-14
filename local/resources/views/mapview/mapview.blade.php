@extends('app') 
@section('content')
<link rel="stylesheet" href="{{asset('css/themes/default/easyui.css')}}">

<link rel="stylesheet" href="{{asset('css/mapview/mapview.css')}}">
<link rel="stylesheet" href="{{asset('css/mapview/ol.css')}}">
<link rel="stylesheet" href="{{asset('css/mapview/jquery.fancybox.css')}}">
<link rel="stylesheet" href="{{asset('css/mapview/jquery.fancybox-buttons.css')}}">

<link rel="stylesheet" href="{{asset('css/pointer/pointer.css')}}" />
<link rel="stylesheet" href="{{asset('css/pointer/pointer_photo.css')}}" />
<link rel="stylesheet" href="{{asset('css/ace/colorbox.css')}}" />
<link rel="stylesheet" href="{{asset('pointer/uploadify.css')}}" />
<link rel="stylesheet" href="{{asset('css/ace/jquery.gritter.css')}}" />
<link rel="stylesheet" href="{{asset('css/ace/chosen.css')}}" />           

<script src="{{asset('js/openlayer/OpenLayers.js')}}"></script>
<script src="{{asset('js/openlayer/ol.js')}}"></script>
<script src="{{asset('js/mapview/mapview.js')}}"></script>
<script src="{{asset('js/ace/jquery.colorbox-min.js')}}"></script>
<script src="{{asset('js/input_mask.js')}}"></script>
<script src="{{asset('js/ace/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/mapview/jquery.fancybox.js')}}"></script>
<script src="{{asset('js/mapview/jquery.fancybox-buttons.js')}}"></script>

<script src="{{asset('js/mapview/mapcontrol.js')}}"></script> 
<script src="{{asset('js/mapview/mapview.js')}}"></script>
<script src="{{asset('js/mapview/pointer-manage.js')}}"></script>

<script src="{{asset('js/mapview/ckeditor.js')}}"></script>
<script src="{{asset('js/mapview/html_comment.js')}}"></script>
<script src="{{asset('js/manager/common.js')}}"></script>
<script src="{{asset('js/manager/messages_ja.js')}}"></script>
<script type="text/javascript">
    $(function() {
       $("#sidebar > ul li").removeClass('active');
        $(".master_href").removeClass('open').removeClass('active');
        $(".pointer_href").addClass('active');
     
    });
</script>
<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
		try { ace.settings.check('breadcrumbs', 'fixed'); } catch (e) { }
	</script>

	<ul class="breadcrumb">
		<li class="active">ポインタ管理</li>
	</ul>
	<!-- .breadcrumb -->
</div>   
		<div class="top_header">
                <div class="inline age_select_div">
                    <button type="button"  class="btn btn-primary edo_age_radio active" data-toggle="button">江戸</button>
                    <button type="button"  class="btn btn-primary meichi_age_radio" data-toggle="button">明治</button>
                    <button type="button"  class="btn btn-primary xianzai_age_radio" data-toggle="button">現代</button>
                </div>
				<button type="button" id="pointer_create_button" class="btn btn-primary" data-toggle="button">地点の追加</button>		
		</div>
		<div class="col-sm-4 widget-container-span ui-sortable right_span_div">
				<div class="widget-box">
					<ul class="right-panel-body-ul">
					<li class="right-panel-body active">
						<div class="widget-header">
							<h5>地点の情報</h5>
						</div>
		
						<div class="widget-body">
							<div class="widget-main">
								<form class="form-horizontal pointer_property_form" role="form">
									<div id="loading_status">
									<img src="{{asset('image/pointer/ajax-loader.gif')}}" width="100px" height="100px"/>
									<span>地点の情報をローディングしています。</span>
									</div>
										<div class="alert alert-danger pointer_position_alert">
											地図上で地点の座標を指定してください。
											<br>
										</div>
										
										
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_age_id">時代：</label>
											<div class="col-sm-8">      
												<select class="col-xs-10 col-sm-5" id="pointer_age_id">

                                                    <option value="1">江戸</option>
                                                    <option value="2">明治</option>
                                                    <option value="3">現代</option>

												</select>
											</div>
										</div>
										<div class="space-4"></div>
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_period_id">期間：</label>
											<div class="col-sm-8">
												<input type="text" id="pointer_period_id" maxlength="50" class="col-xs-10 col-sm-5"
												value=""	placeholder="期間" />
											</div>
										</div>
										<div class="space-4"></div>
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right"
												for="pointer_category_id">カテゴリ：</label>
											<div class="col-sm-8">
												<select class="col-xs-10 col-sm-5" id="pointer_category_id">
                                                 
                                                    
                                                    <?php foreach ($category_data as $category) { ?>
                                                    <?php
                                                        $category_id = $category ['id'];
                                                        $category_name = $category ['category_name'];
                                                        ?>
                                                    <option  value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                    <?php } ?>  
												</select>  
											</div>
										</div>
										<div class="space-4"></div>
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_name_id">ポインタ名：</label>
											<div class="col-sm-8">
												<input type="text" id="pointer_name_id" maxlength="50" class="col-xs-10 col-sm-5"
												value=""	placeholder="ポインタ名" />
											</div>
										</div>
										<div class="space-4"></div>
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_kananame_id">ポインタカナ名：</label>
											<div class="col-sm-8">
												<input type="text" id="pointer_kananame_id" maxlength="50" class="col-xs-10 col-sm-5"
												value=""	placeholder="ポインタカナ名" />
											</div>
										</div>
										<div class="space-4"></div>
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right">座標：</label>
											<div class="col-sm-8">
											<label id="pointer_position_longlatdisp_id"></label>
											<input type="hidden" id="pointer_position_latitude_id" maxlength="20" class="pointer_position"
												value=""	placeholder="" />
											<input type="hidden" id="pointer_position_longitude_id" maxlength="20" class="pointer_position"
												value=""	placeholder="" />
											</div>
										</div>
										<div class="space-4"></div>  
                        
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label no-padding-right" for="pointer_curaddress_id">当時の住所：</label>
                                            <div class="col-sm-8">
                                            <input type="text" id="pointer_address_id" maxlength="100" class="col-xs-10 col-sm-5"
                                                value=""    placeholder="" />
                                            </div>
                                        </div> 
                                        <div class="space-4"></div>
										<div class="form-group">  
                                            <label class="col-sm-4 control-label no-padding-right" for="pointer_address_id">現在の住所：</label>
											<div class="col-sm-8">
											<input type="text" id="pointer_curaddress_id" maxlength="100" class="col-xs-10 col-sm-5"
												value=""	placeholder="" />
											</div>
										</div>
										<div class="space-4"></div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right"
												for="pointer_ids_id">グループ設定：</label>
											<div class="col-sm-8">
												<select class="col-xs-10 col-sm-5 chosen-select_" id="pointer_ids_id"  data-placeholder="Choose a Pointer...">
													<option value="-1">▼選択</option>
													<?php foreach ($pointer as $value) { ?>
													<option pointer_age="<?php echo $value->pointer_age; ?>" value="<?php echo $value->group_id; ?>"><?php echo $value->pointer_name; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="space-4"></div>
										
										<div class="form-group">           
											<label class="col-sm-4 control-label no-padding-right" for="pointer_content_id">内容：</label>
											
                                            <div class="col-sm-8">                
                                                <div id="pointer_content_id">
                                                    
                                                </div>
											    <a data-toggle="modal" id="html_comment_btn" class="btn btn-minier btn-primary " role="button" ><i class="icon-edit bigger-23"></i></a>
                                            </div>
										</div>
										<div class="space-4"></div>
						
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_extra_id">備考：</label>
											<div class="col-sm-8">
												<textarea placeholder="" maxlength="500" id="pointer_extra_id"
													name="etc_content" class=""></textarea>
											</div>
										</div>
										<div class="space-4"></div>
						
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_images">関連の写真：</label>
											<div class="col-sm-8" >
											<div id="pointer_images">
												<ul>
												</ul>
											</div>
											<a data-toggle="modal" id="pointer_photo_link_id" class="btn btn-primary blue" role="button" href="#image_manage">写真の変更</a>
											
											</div>
										</div>
										<div class="space-4"></div>
							
									   <div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="pointer_display_status_id" >表示フラグ：</label>
											<div class="col-sm-8" id="pointer_display_status_id">
						                   
                                                <input type="radio" value="show" class="pointer_show_status" checked
                                                    name="pointer_show_name" id="pointer_show_id"/><label for="pointer_show_id">表示</label>
                                                <input type="radio" value="none" class="pointer_show_status" 
                                                    name="pointer_show_name" id="pointer_none_id"/><label for="pointer_none_id"> 非表示</label>

											</div>
										</div>
										<div class="space-4"></div>
										<div class="form-group">
											<button class="btn col-sm-3 btn-success" id="pointer_register_id">登録</button>
											<button class="btn col-sm-3 btn-danger" id="pointer_delete_id">地点の削除	</button>
										</div>
										<div class="space-4"></div>
									
									</form>
							</div>
						</div>
					</li>
					<li class="right-panel-handler">
						<div class="sidebar-collapse" id="right_sidebar-collapse">
							<i class="icon-double-angle-right" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
						</div>
					</li>
					</ul>
				<div style="clear:both" ></div>
				</div>
				
		</div>
		

		<div class="map_view_div" id="map">
			<div class="search_panel" >      
				<div class="form-inline"> 
                                     <label>
					                     時代：
                                     </label>
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="form-field-checkbox" value="1" type="checkbox" class="ace search_age"  id="edo_age" checked=""/>
                                                        <span class="lbl"> 江戸   </span>
                                                    </label>
                                                </div>

                                                <div class="checkbox">
                                                    <label>
                                                        <input name="form-field-checkbox"  value="2" type="checkbox" class="ace search_age" id="policy_age" checked="" />
                                                        <span class="lbl">明治    </span>
                                                    </label>
                                                </div>

                                                <div class="checkbox">
                                                    <label>
                                                        <input name="form-field-checkbox" value="3" class="ace search_age" type="checkbox"  id="present_age" checked=""/>
                                                        <span class="lbl"> 現代   </span>
                                                    </label>
                                                </div>
                     <label style="margin-left: 28px;" for="pointer_search">ポインタ名：</label> 
                        <input type="text" style="width: 100px;" id="pointer_name">
                     <label style="margin-left: 28px;">カテゴリ：</label>
                    <select id="category_search">
                        <option value="0">▼選択</option>
                        <?php foreach ($category_data as $category) {?>
                            <option value="<?php echo $category['id']?>"><?php echo $category['category_name']?></option>
                        <?php }?>
                    </select>                                                                                                   
				</div>
				<div class="space-4" style="clear:both"></div>
				<div class="form-inline">
                                <label >
                                         表示フラグ：
                                    </label>
                                    <div class="checkbox">
                                        <label>
                                            <input name="form-field-checkbox" value="1" type="checkbox" class="ace search_pointer_show"  id="pointer_show" checked=""/>
                                            <span class="lbl"> 表示 </span>
                                        </label>
                                    </div> 
                                    <div class="checkbox">
                                        <label>
                                            <input name="form-field-checkbox" value="0" type="checkbox" class="ace search_pointer_show"  id="pointer_hide" checked=""/>
                                            <span class="lbl"> 非表示 </span>
                                        </label>
                                    </div>
                    <label style="margin-left: 38px;">テキスト：</label> 
                    <input type="text"
                        style="width: 100px;" id="pointer_comment">
                    <button class="btn btn-xs" id="search_btn">検索</button>
                    <button class="btn btn-xs"
                        id="clear_search_btn">クリア</button>      
					
				</div>
                
			</div> 
            <div class="map_control_div">                                                                                       
                <div style="width: 59px; height: 59px; overflow: hidden; position: absolute;">
                    <img src="{{asset('image/map_tile/map_control.png')}}" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;">
                    <div class="left_transport" title="向左平移" style="position: absolute; left: 0px; top: 20px; width: 19.6666666666667px; height: 19.6666666666667px; cursor: pointer;"></div>
                    <div class="right_transport" title="向右平移" style="position: absolute; left: 39px; top: 20px; width: 19.6666666666667px; height: 19.6666666666667px; cursor: pointer;"></div>
                    <div class="up_transport" title="向上平移" style="position: absolute; left: 20px; top: 0px; width: 19.6666666666667px; height: 19.6666666666667px; cursor: pointer;"></div>
                    <div class="down_transport" title="向下平移" style="position: absolute; left: 20px; top: 39px; width: 19.6666666666667px; height: 19.6666666666667px; cursor: pointer;"></div>
                </div>
                <div id="zoom_slider_control"></div>
            </div>
		</div>
		
	    <div id="mouse-position"></div>
		
	<div class="col-sm-6 widget-container-span bottom_span_div">
										<div class="widget-box">
											<div class="widget-header">
												<h5 class="lighter">検索結果</h5>
												<div class="sidebar-collapse" id="bottom_sidebar-collapse">
													<i class="icon-double-angle-up" data-icon1="icon-double-angle-up" data-icon2="icon-double-angle-down"></i>
												</div>
											</div>

											<div class="widget-body">
												<div class="search_result_div">
                                                    <!--
													<div class="col-sm-6 pointer_search_extra_div">
														<label for="pointer_search_extra">フィルター ：</label> <input type="text"
															id="pointer_search_extra">
													</div>
													-->
													<div class="col-xs-12 pagination_info_div">             
															<ul class="pagination pointer_paginate_ul">
                                                                <li class="disabled first_page">
                                                                    <a>
                                                                        <i class="icon-double-angle-left"></i>
                                                                    </a>
                                                                </li>
																<li class="disabled prev_page">
																	<a>
																		<i class="icon-angle-left"></i>
																	</a>
																</li> 
                                                                <?php 
                                                                    $total_page=ceil(count($pointer)/5);
				                                                    if ($total_page>5){ 
                                                                        for($i=1;$i<$total_page+1;$i++){
                                                                        ?>
                                                                            <li number="<?php echo $i;?>"><a><?php echo $i;?></a></li>
                                                                <?php 
                                                                        }   
                                                                    }      
                                                                ?> 
                                                                  
																<li class="disabled next_page">
																	<a>
																		<i class="icon-angle-right"></i>
																	</a>
																</li>
                                                                <li class="disabled last_page">
                                                                    <a>
                                                                        <i class="icon-double-angle-right"></i>
                                                                    </a>
                                                                </li>
															</ul>   
													</div>
													<div class="col-xs-12">
                                                        <div class="table-responsive">
                                                            
													        <table aria-describedby="search_result_table_info"
														        id="search_result_table"
														        class="table table-striped table-bordered table-hover dataTable">
														        <thead>
															        <tr role="row">
																        <th class="center">No</th>
																        <th class="center">ポインタ名</th>
                                                                        <th class="center">カテゴリ</th>
                                                                        <th class="center">カテゴリ     ID</th>
                                                                        <th class="center">座標</th>
                                                                        <th class="center">現在の住所</th>
																        <th class="center">当時の住所</th>
															        </tr>
														        </thead>
																<tbody id="search_result">
														        </tbody>
													        </table>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
	</div>

<div id="image_manage" class="modal" tabindex="-1">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id="image_manage_close_id" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">画像の変更</h4>
			</div>
	
			<div class="modal-body">
				<div class="row">
	
					<div class="col-xs-12 col-sm-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="pointer_photo_table_id" class="col-xs-12 col-sm-12">
								<thead>
									<tr>
										<th class="center">
											No
										</th>
										<th>写真</th>
										<th>説明</th>
										<th>表示順</th>				
										<th></th>
									</tr>
								</thead>
	
								<tbody>     
									<tr id="new_image_tr">
										<td class="">*</td>
										<td class="">		
										<div id="new_image_upload_div">
										</div>
										</td>
										<td class="">
											
										</td>
										<td class=""></td>
										<td class="insert_new_row_bt">
											
										</td>

									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
	
				<div class="modal-footer">
					<button class="btn btn-sm backup_photo_data_btn" data-dismiss="modal">
						<i class="icon-remove"></i>
						キャンセル
					</button>
					<button type="button" class="btn btn-sm btn-primary create_new_pointer_data_btn">
						<i class="icon-ok"></i>
						保存
					</button>
				</div>
			</div>
		</div>
</div><!-- PAGE CONTENT ENDS -->
<div id="html_comment_dialog" class="" tabindex="-1" style="display: none">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">内容</h4>                                   
            </div>
             
            <div class="modal-body"> 
                <div id="pointer_comment_edit_id">
                </div>   
            </div>
    
            <div class="modal-footer">
                <button class="btn btn-sm cancel_btn" data-dismiss="modal">
                        <i class="icon-remove"></i>
                        キャンセル
                </button>
                <button type="button" class="ok_btn btn btn-sm btn-primary" data-dismiss="modal">
                        <i class="icon-ok"></i>
                        保存
                </button>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->
<div id="html_comment_div">
<?php if ($data_exist) echo $pointer[0]->pointer_comment ?>
</div>		
		<input type="hidden" id="pointer_id_value" value="<?php if ($data_exist) echo $pointer[0]->id?>" />	
		<input type="hidden" id="pointer_photo_count_value" value="" />	
		<input type="hidden" id="new_uploaded_file_name_input" value=""/>
		<input type="hidden" id="current_page_number" value="1"/>
		<input type="hidden" id="total_page_number" value="<?php echo $total_page?>"/>

        <input type="hidden" id="map_bound_minx" value="<?php echo $map_bound['minX']; ?>"/>
        <input type="hidden" id="map_bound_miny" value="<?php echo $map_bound['minY']; ?>"/>
        <input type="hidden" id="map_bound_maxx" value="<?php echo $map_bound['maxX']; ?>"/>
        <input type="hidden" id="map_bound_maxy" value="<?php echo $map_bound['maxY']; ?>"/>         
		<div id="image_update_hidden_div">
		</div>
		<div id="search_loading_status">
			<img src="{{asset('image/pointer/ajax-loader.gif')}}" width="100px" height="100px"/>
			<p> ローディング中…</p>
		</div>
@endsection



