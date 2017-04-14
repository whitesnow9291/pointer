$(document).ready(function() {                                        
  $('.operation').css({        
                            left:0,
                            top:$(window).height()-$('.operation').outerHeight()
                        });
  $("#search_loading_status").hide();            
  //$('[data-rel=popover]').popover({html:true});
  searchByAjax('');  
  $('.edo_age_radio').click(function(e){
            e.stopImmediatePropagation();
            edo_layout.setVisible(true);
            meichi_layout.setVisible(false);
            xianzai_layout.setVisible(false);
            $('.edo_age_radio').removeClass('active');
            $('.meichi_age_radio').removeClass('active');
            $('.xianzai_age_radio').removeClass('active');
            $('.edo_age_radio').addClass('active');
        });
        $('.meichi_age_radio').click(function(e){
            e.stopImmediatePropagation();
            meichi_layout.setVisible(true);
            edo_layout.setVisible(false);
            xianzai_layout.setVisible(false);
            $('.edo_age_radio').removeClass('active');
            $('.meichi_age_radio').removeClass('active');
            $('.xianzai_age_radio').removeClass('active');
            $('.meichi_age_radio').addClass('active');
        });
        $('.xianzai_age_radio').click(function(e){
            e.stopImmediatePropagation();
            xianzai_layout.setVisible(true);
            meichi_layout.setVisible(false);
            edo_layout.setVisible(false);
            $('.edo_age_radio').removeClass('active');
            $('.meichi_age_radio').removeClass('active');
            $('.xianzai_age_radio').removeClass('active');
            $('.xianzai_age_radio').addClass('active');
        });
        $("button.search_btn").bind('click', function() {            
            condition = $("input.pointer_search_info").val();
            searchByAjax(condition);
        });
        function searchByAjax(condition){
           $("#search_loading_status").show();
            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                dataType:'json',
                data:{'condition':condition},
                url:"pointer_search",
                success:function(data) {
                    $("#search_loading_status").hide();
                    searchDataDisplay(data);
                }
            });        
        }
        function searchDataDisplay(json_data){
            var data=json_data;
            var html='';
            
            pos_handler.clear();
            for (var i=0; i<data.length; i++) { 
                var each_data = data[i];
                var search_pointer_id=each_data['id'];

                var lon=each_data['pointer_longitude'];
                var lat=each_data['pointer_latitude'];               
                var search_pointer_color = each_data['pointer_color'];
                var search_pointer_stroke='#0000FF';
                var no = i + 1;

                var width=4;                     
                var tempFeature =new ol.Feature(new ol.geom.Point([lon,lat]));
                var tempFeatureStyle= new ol.style.Style({
                     image: new ol.style.Circle({
                       radius: width * 2,
                       fill: new ol.style.Fill({
                         color: search_pointer_color
                       }),
                       stroke: new ol.style.Stroke({
                         color: search_pointer_stroke,
                         width: width / 2,
                         miterLimit:30,
                       })
                     })
                   });
                tempFeature.setStyle(tempFeatureStyle);
                tempFeature.pointer_id=search_pointer_id;
                tempFeature.selected=false;
                tempFeature.fill_color=search_pointer_color;
                tempFeature.stroke_color= search_pointer_stroke;
                pos_handler.addFeature(tempFeature);
            }                                  
            $("div#search_loading_status").hide();        
            map.renderSync();
      }
        $(".left_transport").click(function(){  
            var coor=map_view.getCenter();
            coor[0]-=2000000;
            navigateMap(coor);
        });
        $(".right_transport").click(function(){
            var coor=map_view.getCenter();
            coor[0]+=2000000;
            navigateMap(coor);
        });
        $(".up_transport").click(function(){
            var coor=map_view.getCenter();
            coor[1]+=2000000;
            navigateMap(coor);
        });
        $(".down_transport").click(function(){
            var coor=map_view.getCenter();
            coor[1]-=2000000;
            navigateMap(coor);
        });
        $(".pointer_image_href").click(function(){
            if (pointer_imagedata.length>0){
                $("a.fancybox:first").trigger("click");
            }else{
                alert("There is no images!");
            }
            
        });
});