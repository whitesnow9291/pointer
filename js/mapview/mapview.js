var searchPaginationPerPage = 5;
var ajax_flag;
var deletenewId=0;
var photo_count=0;
	function refreshObject() {
		$('img.up_bt').bind('click',function (e) {
			pos = $(this).parents('tr').attr('pos');
			var current=$('#pointer_photo_table_id tr[pos='+pos+']').find('td:nth-child(2) ul li img ');
            var target=$('#pointer_photo_table_id tr[pos='+pos+']').prev().find('td:nth-child(2) ul li img ');
				if (target.length>0 && current.length>0){
					 swap(pos, 1);
				}	
		});

		$('img.down_bt').bind('click',function (e) {
			pos = $(this).parents('tr').attr('pos');
			var current=$('#pointer_photo_table_id tr[pos='+pos+']').find('td:nth-child(2) ul li img ');
			var target=$('#pointer_photo_table_id tr[pos='+pos+']').next().find('td:nth-child(2) ul li img ');
				if (target.length>0 && current.length>0){
					 swap(pos, 0);
				}	
		});
		$('.delete_row_bt').bind('click',function (e) {
            if (confirm(MSG_COMMON_DEL_CONFIRM) == false)
            return false;
			pos = $(this).parents('tr').attr('pos'); 
            current = $("div .modal-body tr[pos="+pos+"]");
            $(current).empty();
            $(current).remove();
            reorder(); 
		}); 
		 $(".image_delete_icon").bind('click',function(e){
			 e.preventDefault();
			 var date=new Date();
			 var newId=date.getTime().toString();
			 $(this).parents('ul').attr('id',newId);
			 $(this).parents('ul').empty();
			 $("#"+newId).deleteuploadify({
			 });
		 });
		 $(".image_update_icon").bind('click',function(e){
			 e.preventDefault();
			$("#image_update_hidden_div object").trigger('click');
		 });
	}
	
	function getPointerDataByAjax(pid){
		  if (ajax_flag==false){
				$('#loading_status').show();
				ajax_flag=true;
				$.ajax({
				  	headers: {
			              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
			        type:"post",
					url: "getpointerdatabyajax",
	          		dataType: 'json',
					data: {
						'pointer_id':pid,
						},
					success: function(json) {	
						ajax_flag=false;
						$('#loading_status').hide();
						var pointer_age=json.pointer_data.pointer_age;
						var pointer_age_name="";
						$("#pointer_age_id option").each(function(item){
							if($(this).val()==pointer_age){
								$(this).attr('selected','');
								return;
							}
						});	
						$("#pointer_period_id").val(json.pointer_data.pointer_period);
						$("#pointer_category_id option").each(function(item){
							if($(this).val()==json.pointer_data.category_id){
								$(this).attr('selected','');
								return;
							}
						});
						$("#pointer_ids_id option").each(function(item){
							if($(this).val()==json.pointer_data.group_id){
								$(this).attr('selected','');
							}
							if($(this).attr('pointer_age')==json.pointer_data.pointer_age){
								$(this).css({'display':'none'});
							}else{
								$(this).css({'display':'block'});
							}
						});
						$("#pointer_name_id").val(json.pointer_data.pointer_name);
						$("#pointer_kananame_id").val(json.pointer_data.pointer_kananame);  
                        var lon= json.pointer_data.pointer_longitude;
                        var lat= json.pointer_data.pointer_latitude;                               
						
						$("#pointer_position_longitude_id").val(lon);
                        $("#pointer_position_latitude_id").val(lat);
                        gotoPointer([lon,lat]);
						$("#pointer_position_longlatdisp_id").text(json.pointer_data.pointer_longlatdisp);
						$("#pointer_address_id").val(json.pointer_data.pointer_address);
                        $("#pointer_curaddress_id").val(json.pointer_data.pointer_curaddress);
						$("#pointer_content_id").html(json.pointer_data.pointer_comment);
						$("#pointer_extra_id").val(json.pointer_data.pointer_extra); 
                        var html=$("#pointer_content_id").html();
                        html_comment_handler.document.getBody().setHtml(html);     
                        $('#pointer_show_id')[0].checked=false;
                        $('#pointer_none_id')[0].checked=false;
						if(json.pointer_data.pointer_show>0){
							$('#pointer_show_id')[0].checked=true;
						}else{
							$('#pointer_none_id')[0].checked=true;
						}
						$("#pointer_images > ul").empty();
						$('#pointer_photo_table_id tr[pos]').empty();
						$('#pointer_photo_table_id tr[pos]').remove();
						var html_front='';
						var html_modal='';                        
                        
							for(var i in json.pointer_image_data){        
								image_file_name=json.pointer_image_data[i].photo_name;      
                                image_url="../image/pointer/uploaded_photos/"+image_file_name;
	 	 						html_front += "<li>"+
		 	 							"<a class='fancybox' data-fancybox-group='gallery' href='"+image_url+"'>" + 
		 	 	 							"<img alt='"+image_file_name+"'" +
		 	 	 							"src='"+image_url+"' >" +
		 	 	 						"</a>" + 
	 	 	 						"</li>";
	 	 						html_modal=html_modal+"<tr pos="+i+">"+
	 	 						"<td class='index_td'>"+(parseInt(i)+1)+
	 	 						"</td>"+
	 	 						"<td class='image_td'>"+
	 	 							"<ul class='ace-thumbnails'>"+
	 	 								"<li>"+
	 	 									"<a data-rel='colorbox' class='cboxElement'>"+
	 	 										"<img src='"+"../image/pointer/uploaded_photos/"+image_file_name+
	 	 										"' class='col-xs-12 pointer_image_class' alt='"+image_file_name+"'/>"+
	 	 									"</a>"+

	 	 									"<div class='tools tools-bottom'>"+//
//	 	 										"<a href='#'>"+
//	 	 											"<i class='icon-pencil'></i>"+
//	 	 										"</a>"+
	 	 										"<a href='#'>"+
	 	 											"<i class='image_delete_icon icon-remove red'></i>"+
	 	 										"</a>"+
	 	 									"</div>"+
	 	 								"</li>"+
	 	 							"</ul>"+
	 	 						"</td>"+
	 	 						"<td class='col-sm-10'>"+
	 	 							"<textarea class='photo_comment  col-xs-12' >"+json.pointer_image_data[i].photo_comment+"</textarea>"+
	 	 						"</td>"+
	 	 						"<td  class='col-sm-2'>"+
	 	 							"<img alt='up' src="+"'../image/map_tile/up.png'"+" class='up_bt' >"+
	 	 							"<img alt='down' src="+"'../image/map_tile/down.png'"+" class='down_bt'></td>"+
	 	 						"<td class=''>"+
	 	 							"<button data-toggle='modal' href='#delete-pointer-image-bt' class='btn btn-sm btn-danger delete_row_bt' type='button'>削除</button>"+
	 	 						"</td>"+
	 	 					"</tr>";
	 						};
	 						$('#new_image_tr').before(html_modal);
	 						$("#pointer_images > ul").append(html_front);
						
						refreshObject();
                        $('#pointer_delete_id').attr('disabled',false);
                        $('#pointer_register_id').text('変更');
                        animate_right_handler('show');
					}	
		   		});
			}
	  }
	function search_result_tablerefresh(){
		$("table tbody#search_result tr[pointer_id]").bind('click', function(e) {
 			var pointer_id=$(this).attr('pointer_id');
            search_table_row(pointer_id);
            var width=4;
            if(current_feature){
                var tempFeatureStyle= new ol.style.Style({
                         image: new ol.style.Circle({
                           radius: width * 2,
                           fill: new ol.style.Fill({
                             color: current_feature.fill_color
                           }),
                           stroke: new ol.style.Stroke({
                             color: current_feature.stroke_color,
                             width: width / 2
                           })
                         })
                       });
                current_feature.setStyle(tempFeatureStyle);
                current_feature.selected=false;
            }
            var features=pos_handler.getFeatures();
              for (i=0;i<features.length;i++){
                  if (features[i].pointer_id==pointer_id){
                      features[i].setStyle(selected_pointer_style);
                      current_feature=features[i];
                      break;
                  }
              }
			getPointerDataByAjax(pointer_id);
			
	    });
	};
    function search_table_row(pointer_id){
             $("table tbody#search_result tr:nth-child(even) td").css("background", "#F1F1F1");
             $("table tbody#search_result tr:nth-child(odd) td").css("background", "#F9F9F9");
             
            $("table tbody#search_result tr[pointer_id="+pointer_id+"]").children('td').css({
                "background-color": "rgb(56, 199, 255)"
            });
            
            $("#pointer_id_value").val(pointer_id);
            $('#pointer_delete_id').attr('disabled',false);
    }
	function search_result_paginationrefresh(){
        cur_page=$("#current_page_number").val();
        var last_page = $("#total_page_number").val();
        if (cur_page>1){
            $(".pointer_paginate_ul li.prev_page").removeClass('disabled');
            $(".pointer_paginate_ul li.first_page").removeClass('disabled');
        }
            
        if (cur_page==1){
            $(".pointer_paginate_ul li.prev_page").addClass('disabled');
            $(".pointer_paginate_ul li.first_page").addClass('disabled');
        }
                
            
        if (cur_page!=last_page){
            $(".pointer_paginate_ul li.next_page").removeClass('disabled');
            $(".pointer_paginate_ul li.last_page").removeClass('disabled');
        }
               
        if (cur_page==last_page){
           $(".pointer_paginate_ul li.next_page").addClass('disabled');
           $(".pointer_paginate_ul li.last_page").addClass('disabled'); 
        }
                

        $(".pointer_paginate_ul li[number]").removeClass('active');
        $(".pointer_paginate_ul li[number="+cur_page+"]").addClass('active');
        
        $(".pointer_paginate_ul li[number="+cur_page+"]").addClass('active');
		$(".pointer_paginate_ul li[number]").bind("click",function(){
			var cur_page=$(this).attr('number');
			pagination(cur_page);
		});
		$(".pointer_paginate_ul li.prev_page").bind("click",function(){
			var cur_page=$("#current_page_number").val();
			if (!$(this).hasClass('disabled')){
				cur_page--;
				pagination(cur_page);
			}
		});
		$(".pointer_paginate_ul li.next_page").bind("click",function(){
			var cur_page=$("#current_page_number").val();
			if (!$(this).hasClass('disabled')){
				cur_page++;
				pagination(cur_page);
			}
		});
        $(".pointer_paginate_ul li.first_page").bind("click",function(){
            if (!$(this).hasClass('disabled')){
                pagination(1);
            }
        });
        $(".pointer_paginate_ul li.last_page").bind("click",function(){
            if (!$(this).hasClass('disabled')){
                cur_page=$("#total_page_number").val();
                pagination(cur_page);
            }
        });
	}	
	function pagination(cur_page){
		$("#current_page_number").val(cur_page);
		$("#search_loading_status").show();
		$.ajax({
			headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
			type:'post',
			dataType:'json',
			data:{'page':cur_page},
			url:"pt_pagination",
			success:function(data) {
				$("#search_loading_status").hide();
				searchPaginationDataDisplay(data);
			}
		});

		var origin_top=$(window).height()-$(".bottom_span_div .widget-header").height()-$("#navbar").height();

		  $(".bottom_span_div").animate({
		  top:  origin_top-$(".bottom_span_div .widget-body").height()
	  	  }, "fast");
		  $("#bottom_sidebar-collapse i").removeClass('icon-double-angle-up').addClass('icon-double-angle-down');
	}
	
	function errorHandler(transaction, error) {
			alert('Oops. Error was '+error.message+' (Code '+error.code+')');
			return true;
	}
	
	function reorder() {
		$.each($('#pointer_photo_table_id tr[pos]'), function(index, item) {
				$(item).children('.index_td').text(parseInt(index+1));
		});
	}
	
	function swap(pos,direction) {
		  current=$("tr[pos="+pos+"]");
		  if (direction==0){//down
			  target=$(current).next("tr[pos]");
		  }else{			//up
			  if (pos==0){
				  return;
			  }
			  target=$(current).prev("tr[pos]");
		  }
		  comment_current=$(current).find('textarea').val();
		  comment_target=$(target).find('textarea').val();
		  
		  temp=current.html();
		  current.html(target.html());
		  $(current).find('textarea').val(comment_target);
		  target.html(temp);
		  $(target).find('textarea').val(comment_current);
		  reorder();
		  refreshObject();  
	  }
	  function searchByAjax(condition){
		  $("#search_loading_status").show();
			$.ajax({
				headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
				type:'post',
				dataType:'json',
				data:{'condition':condition},
				url:"pt_search",
				success:function(data) {
					$("#search_loading_status").hide();
					searchDataDisplay(data);
				}
			});		
		}
      function searchPaginationDataDisplay(json_data){
          var data=json_data['data'];
          var html='';
          var cur_page=$("#current_page_number").val();
          var data_length= json_data['per_page']>data.length?data.length:json_data['per_page'];
          for (var i=0; i<data_length; i++) {
                var each_data = data[i];
                var search_pointer_id=each_data['id'];
                
                var search_pointer_name = each_data['pointer_name'];
                var search_category_name = each_data['category_name'];
                var search_category_id = each_data['category_id']; 
                var lon=each_data['pointer_longitude'];
                var lat=each_data['pointer_latitude'];
                var lonlatdisp=each_data['pointer_longlatdisp'];
                var search_pointer_ex_address = each_data['pointer_address'];
                var search_pointer_curaddress = each_data['pointer_curaddress'];
                var search_pointer_show=each_data['pointer_show'];
                var search_pointer_color = each_data['pointer_color'];
                var search_pointer_stroke=search_pointer_show>0?'#0000FF':'#FFFFFF';
                var no = (cur_page-1)*json_data['per_page']+i + 1;
                html += "<tr pointer_id='"+search_pointer_id+"'>";
                html += "<td class='center'>"+no+"</td>";
                html += "<td class='center'>"+search_pointer_name+"</td>";
                html += "<td class='center'>"+search_category_name+"</td>";
                html += "<td class='center'>"+search_category_id+"</td>";
                html += "<td class='center'>"+lonlatdisp+"</td>";
                html += "<td class='center'>"+search_pointer_ex_address+"</td>";
                html += "<td class='center'>"+search_pointer_curaddress+"</td>";
                html += "</tr>";
            }
            if (json_data.total_count==0){
                html = "<tr><td class='center' colspan='7'>検索結果が見つかりませんでした。</td></tr>";
            }
            $('table#search_result_table tbody#search_result').html(html);
            $("table tbody#search_result tr:nth-child(even) td").css("background", "#F1F1F1");
            $("table tbody#search_result tr:nth-child(odd) td").css("background", "#F9F9F9");
            var page_length = Math.ceil(json_data.total_count/searchPaginationPerPage)+1; 
            $(".pointer_paginate_ul li").remove();
            if (json_data.total_count>searchPaginationPerPage){
                var html="<li class='disabled first_page'>"+
                            "<a>"+
                                "<i class='icon-double-angle-left'></i>"+
                            "</a>"+
                        "</li>"+
                        "<li class='disabled prev_page'>"+
                            "<a>"+
                                "<i class='icon-angle-left'></i>"+
                            "</a>"+
                        "</li>"+
                        "<li class='disabled next_page'>"+
                            "<a>"+
                                "<i class='icon-angle-right'></i>"+
                            "</a>"+
                        "</li>"+
                        "<li class='disabled last_page'>"+
                            "<a>"+
                                "<i class='icon-double-angle-right'></i>"+
                            "</a>"+
                        "</li>";
                    $(".pointer_paginate_ul").append(html);
                for (i=1;i<page_length;i++){    
                    html="<li number="+i+"><a>"+i+"</a></li>";
                    $(".pointer_paginate_ul li.next_page").before(html);
                }
                search_result_paginationrefresh();
            }
            
            $("#total_page_number").val(page_length-1);
            var origin_top=$(window).height()-$(".bottom_span_div .widget-header").height()-$("#navbar").height();
             $(".bottom_span_div .widget-header").addClass('updown');
                  $(".bottom_span_div").animate({
                  top:  origin_top-$(".bottom_span_div .widget-body").height()
                    }, "fast");
            $("#bottom_sidebar-collapse i").removeClass('icon-double-angle-up').addClass('icon-double-angle-down');      
            search_result_tablerefresh();
      }
	  function searchDataDisplay(json_data){
		    var data=json_data['data'];
			var html='';
			
			pos_handler.clear();
			for (var i=0; i<data.length; i++) { 
				var each_data = data[i];
				var search_pointer_id=each_data['id'];

                var lon=each_data['pointer_longitude'];
                var lat=each_data['pointer_latitude'];                         
                var search_pointer_show=each_data['pointer_show'];
                var search_pointer_color = each_data['pointer_color'];
				var search_pointer_stroke=search_pointer_show>0?'#0000FF':'#FFFFFF';
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
                         width: width / 2
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
            searchPaginationDataDisplay(json_data)       
			map.renderSync();
	  }
      function animate_right_handler(mode){
          var animate_handler=$(".right-panel-body");
          var animate_width=$('.right-panel-body').width();
          if (mode=='show'){
              if (!animate_handler.hasClass('active')){
              animate_handler.animate({
                 left: 0
                }, 100);
              $(".right-panel-body").show();
              animate_handler.addClass('active');
              }
              $("#right_sidebar-collapse i").removeClass("icon-double-angle-left").addClass("icon-double-angle-right");
          }else if(mode=='toggle'){
              if (animate_handler.hasClass('active')){
                  animate_handler.animate({
                 left: animate_width
                }, 300,function(){
                    $(".right-panel-body").hide();
                });
                $(".right_span_div").width(20);
                $("#right_sidebar-collapse i").removeClass("icon-double-angle-right").addClass("icon-double-angle-left");
              }else{
                  animate_handler.animate({
                 left: 0
                }, 100);
                $(".right-panel-body").show();
                $("#right_sidebar-collapse i").removeClass("icon-double-angle-left").addClass("icon-double-angle-right");
              }
              animate_handler.toggleClass('active');
            
          }else if(mode=='hide'){
                  animate_handler.animate({
                     left: animate_width
                    }, 0);
                  $(".right-panel-body").show();
                  animate_handler.removeClass('active');
              $("#right_sidebar-collapse i").removeClass("icon-double-angle-right").addClass("icon-double-angle-left");
          }
          
      }