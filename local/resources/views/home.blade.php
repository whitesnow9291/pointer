@extends('user_app')

@section('content')
<script src="{{asset('js/user_mapview/mapinit.js')}}"></script> 
<script src="{{asset('js/user_mapview/pointer-manage.js')}}"></script> 
<script src="{{asset('js/user_mapview/mapview.js')}}"></script>


<link href="{{asset('css/user_mapview/mapview.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/user_mapview/jquery.fancybox.css')}}">
<link rel="stylesheet" href="{{asset('css/user_mapview/jquery.fancybox-buttons.css')}}">
<link rel="stylesheet" href="{{asset('css/user_mapview/popup.css')}}">
    <div id="map">
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
    <div class="operation">
       <div class="float_left">
           <button type="button"  class="btn btn-primary edo_age_radio active" data-toggle="button">江戸時代</button>
           <button type="button"  class="btn btn-primary meichi_age_radio" data-toggle="button">明治時代</button>
           <button type="button"  class="btn btn-primary xianzai_age_radio" data-toggle="button">現代時代</button>
       </div>
       
       <div class="float_right">           
            <input type="text" class="pointer_search_info">
            <button class="btn btn-white search_btn">検索</button>
       </div>
       <div class="spacer"></div>
    </div>   
    <div id="search_loading_status">
        <img src="{{asset('image/pointer/ajax-loader.gif')}}" width="100px" height="100px"/>
        <p> ローディング中…</p>
    </div>
    
    <div id="popup" class="ol-popup">                               
     <div class="profile-user-info profile-user-info-striped" id="popup-content">
        <div class="profile-info-row">
            <div class="profile-info-name"> 期間： </div>
            <div class="profile-info-value">
                <span class="pointer_period" >alexdoe</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> ポインタ名： </div>
            <div class="profile-info-value">
                <span class="pointer_name" >alexdoe</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> ポインタカナ名： </div>
            <div class="profile-info-value">
                <span class="pointer_kananame" >alexdoe</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> 座標： </div>
            <div class="profile-info-value">
                <span class="pointer_lonlat" >alexdoe</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> 当時の住所： </div>
            <div class="profile-info-value">
                <span class="pointer_address" >alexdoe</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> 現在の住所： </div>
            <div class="profile-info-value">
                <span class="pointer_curaddress" >alexdoe</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> 備考： </div>
            <div class="profile-info-value">
                <span class="pointer_extra" >alexdoe</span>
            </div>
        </div>
         <div class="pointer_images_div">
                <button class='btn btn-info pointer_image_href' >写真を見る</button>
         </div>
     </div> 
    </div>    
    <div id="pointer_image_album">
    </div> 
@endsection
