$(document).ready(function() {
		var totalPointers;
		var pointersPerPage = 20;
		var currentPage = 1;
		var data_length = 0;
        $("#search_loading_status").hide();
		$('#loading_status').hide();	
		$(".pointer_position_alert").hide();
		$("input#pointer_search").val("");
		$("input#comment").val("");
		$(".bottom_span_div").css("top",$(window).height()-$(".bottom_span_div .widget-header").height()-$("#navbar").height());
	 	$(".right_span_div").css("height",$(window).height()-$(".bottom_span_div .widget-header").height()-$("#navbar").height()-$("#breadcrumbs").height()-$(".top_header").height());
		$("#right_sidebar-collapse").css('top',$(".right-panel-handler").height()/2-10);
		$("#bottom_sidebar-collapse").css('left',$(".bottom_span_div .widget-header").width()/2-$(".bottom_span_div .widget-header h5").width()-10);
		$(".search_panel").css('top',$(".map_view_div").height()-$(".search_panel").height()-100);
		animate_right_handler('hide');
        search_result_paginationrefresh();
        search_result_tablerefresh();
        $("#map_control_slider_vertical a.ui-slider-handle").title='拖动以缩放';     
        refreshDomTree();
		function refreshDomTree() {
			$("button#clear_search_btn").click(function(e) {
				$("input#pointer_name").val("");
				$("input#pointer_comment").val("");
			});			
		}
		$("button#search_btn").bind('click', function() {
			var condition=new Object();
            var age=new Array();
            var show_cond=new Array();
            $(".search_age").each(function(i){
                if (this.checked==true){
                       age.push($(this).val());
                }
            });
            $(".search_pointer_show").each(function(i){
                if (this.checked==true){
                       show_cond.push($(this).val());
                }
            });
			condition.pointer_name = $("input#pointer_name").val();
			condition.pointer_age = age;
            condition.pointer_show = show_cond;
			condition.pointer_comment = $("input#pointer_comment").val();
			condition.category = $("select#category_search").val();
			condition.sortby =   'asc'  //$("input#pointer_comment").val();
			condition.sortcolumn ='pointer.pointer_name' //$("select#category_search").val();
			searchByAjax(condition);
		});
		//rgb
		var photo=new Array();
		var photo_content= new Array();
		var backup_photo;
		ajax_flag=false;
		$("#pointer_delete_id").click(function(e){
			e.preventDefault();
			bootbox.confirm("選択した項目を削除します。よろしいですか？", function(result) {
				if(result) {
					var pointer_id=$("#pointer_id_value").val();
					if (pointer_id==""){
						$.gritter.add({
							// (string | mandatory) the heading of the notification
							title: '',
							// (string | mandatory) the text inside the notification
							text:'削除しようとするグループ設定を入力してください。!',
							class_name: 'gritter-success'
						});
					}else{
						if (ajax_flag==false){
							$('#loading_status').show();
							ajax_flag=true;
							$.ajax({
							  	headers: {
						              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						        },
						        type:"post",
								url: "delete_pointer",
				          		dataType: 'json',
								data: {
									'pointer_id':pointer_id,
									},
								success: function(other_pointer_id) {	
									ajax_flag=false;
									$("#pointer_id_value").val("");
									$('#loading_status').hide();	
									$.gritter.add({
										// (string | mandatory) the heading of the notification
										title: '',
										// (string | mandatory) the text inside the notification
										text:'削除成功!',
										class_name: 'gritter-success'
									});
						 			$("#pointer_period_id").val('');
									$("#pointer_name_id").val('');
									$("#pointer_kananame_id").val('');
									$("#pointer_position_latitude_id").val('');
									$("#pointer_position_longitude_id").val('');
									$("#pointer_position_longlatdisp_id").val('');
									$("#pointer_position_longlatdisp_id").text('');
									$("#pointer_address_id").val('');
									$("#pointer_content_id").html('');
									$("#pointer_extra_id").val('');
									$("#pointer_images > ul").empty();
									$('#pointer_photo_table_id tr[pos]').empty();
									$('#pointer_photo_table_id tr[pos]').remove();
									//$('#pointer_id_value').val(other_pointer_id);
									//pointer delete on map
									
                                    pos_handler.removeFeature(current_feature);
                                    current_feature=null;
                                    map.renderSync();
									//end pointer delete on map 
									pagination($("#current_page_number").val());
								}	
					   		});
						}
					}
				}
			});
		});
		$("#pointer_register_id").click(function(e){
			e.preventDefault();
			init_variable();
			if (ajax_flag==false){
				var mode="";
				var pointer_id=$("#pointer_id_value").val();
				var flag=$("#pointer_create_button").hasClass('active');
				if (flag){
					mode='create';
				}else{
					mode='update';
				}
	 			var pointer_age=$("#pointer_age_id").val();
	 			var pointer_period=$("#pointer_period_id").val();
				var pointer_category=$("#pointer_category_id").val();
				var pointer_name=$("#pointer_name_id").val();
				var pointer_kananame=$("#pointer_kananame_id").val();
				var pointer_position_latitude=$("#pointer_position_latitude_id").val();
				var pointer_position_longitude=$("#pointer_position_longitude_id").val();
				var pointer_position_longlat=$("#pointer_position_longlatdisp_id").text();
				var pointer_address=$("#pointer_address_id").val();
                var pointer_curaddress=$("#pointer_curaddress_id").val();
				var pointer_content=$("#pointer_content_id").html();
				var pointer_extra=$("#pointer_extra_id").val();
				var pointer_ids_id=$("#pointer_ids_id").val();
				var display = $('[name="pointer_show_name"]:checked').val();
				if (pointer_input_validate()==true){
					$('#loading_status').show();
					ajax_flag=true;
					$.ajax({
					  	headers: {
				              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				        type:"post",
						url: "save_pointer_image",
		          		dataType: 'json',
						data: { 'photo' : photo,
							'content':photo_content,
							'mode':mode,
							'pointer_id':pointer_id,
							'pointer_age':pointer_age,
							'pointer_period':pointer_period,
							'pointer_category':pointer_category,
							'pointer_name':pointer_name,
							'pointer_kananame':pointer_kananame,
							'pointer_position_latitude':pointer_position_latitude,
							'pointer_position_longitude':pointer_position_longitude,
							'pointer_position_longlatdisp':pointer_position_longlat,
							'pointer_address':pointer_address,
                            'pointer_curaddress':pointer_curaddress,
							'pointer_group':pointer_ids_id,
							'pointer_content':pointer_content,
							'pointer_extra':pointer_extra,
							'pointer_display':display
							},
						success: function(pointer_data) {	
							ajax_flag=false;
							$('#loading_status').hide();	
							var status;
                            pointer_id=pointer_data.pointer_id;
                            pointer_color=pointer_data.color;
                            pointer_stroke_color=pointer_data.pointer_show>0?'#0000FF':'#FFFFFF';      
							if (pointer_id==0){
								status=" 同じだグループ設定がすでに存在しきます。"; 	
								classname="gritter-error";							
							}else{
								if (mode=="create"){
									status="登録完了!"; 
									// change pointer id  on map
									 current_feature.pointer_id=pointer_id;
									 $("#pointer_id_value").val(pointer_id);
								}else{
									status="更新成功!"; 	
								}
                                
                                current_feature.fill_color=pointer_color;
                                current_feature.stroke_color= pointer_stroke_color;	
                                pagination($("#current_page_number").val());		
								classname="gritter-success";	
							}
                            $('#pointer_delete_id').attr('disabled',false);
							$("#pointer_create_button").removeClass('active')
							$.gritter.add({
								// (string | mandatory) the heading of the notification
								title: '',
								// (string | mandatory) the text inside the notification
								text:status,
								class_name: classname
							});
							
						}
							
			   		});
				}else{
				}
			}
			
		});
		function pointer_input_validate(){
			var pointer_age=$.trim($("#pointer_age_id").val());
 			var pointer_period=$.trim($("#pointer_period_id").val());
			var pointer_name=$.trim($("#pointer_name_id").val());
			var pointer_kananame=$.trim($("#pointer_kananame_id").val());
			var pointer_position_latitude=$.trim($("#pointer_position_latitude_id").val());
			var pointer_position_longitude=$.trim($("#pointer_position_longitude_id").val());
			var pointer_address=$.trim($("#pointer_address_id").val());
			var pointer_cur_address=$.trim($("#pointer_curaddress_id").val());
			var errors="";
			var flag=true;
			if (pointer_age==""){
				errors=errors+"グループ設定時代を入力してください。!<br>";flag=false;
			}
			if (pointer_period==""){
				errors=errors+"期間を入力してください。!<br>";flag=false;
			}
			if (pointer_name==""){
				errors=errors+" グループ設定名を入力してください。!<br>";flag=false;
			}
			if (pointer_kananame==""){
				errors=errors+"グループ設定カナ名を入力してください。!<br>";flag=false;
			}
			if (pointer_position_latitude=="" || pointer_position_longitude==""){
				errors=errors+"座標を地図上で指定してください。!<br>";flag=false;
			}
			if (pointer_address==""){
				errors=errors+"当時の住所を入力してください。!<br>";flag=false;
			}
			if (pointer_cur_address==""){
				errors=errors+"現在の住所を入力してください。!<br>";flag=false;
			}
			if (flag==false){
				$.gritter.add({
					// (string | mandatory) the heading of the notification
					title: '',
					// (string | mandatory) the text inside the notification
					text:errors,
					class_name: 'gritter-error'
				});
			}
			return flag;
		}
		$("#pointer_position_latitude_id")[0].disabled=true;
		$("#pointer_position_longitude_id")[0].disabled=true;
		$("#gritter-light").click(function(){
			$(this).toggleClass("disabled_on");
			if($("#gritter-light").hasClass('disabled_on')==true){
				$("#pointer_period_id")[0].disabled=true;
				$("#pointer_category_id")[0].disabled=true;
				$("#pointer_name_id")[0].disabled=true;
				$("#pointer_kananame_id")[0].disabled=true;
				$("#pointer_address_id")[0].disabled=true;  
				$("#pointer_extra_id")[0].disabled=true;
				$("#pointer_ids_id")[0].disabled=true;
				$('.pointer_show_status')[0].disabled=true;
				$('.pointer_show_status')[1].disabled=true;
				$("#pointer_photo_link_id")[0].disabled=true;
				$("#pointer_register_id")[0].disabled=true;
				$("#pointer_delete_id")[0].disabled=true;
			}else{
				$("#pointer_period_id")[0].disabled=false;
				$("#pointer_category_id")[0].disabled=false;
				$("#pointer_name_id")[0].disabled=false;
				$("#pointer_kananame_id")[0].disabled=false;
				$("#pointer_address_id")[0].disabled=false;      
				$("#pointer_extra_id")[0].disabled=false;
				$("#pointer_ids_id")[0].disabled=false;
				$('.pointer_show_status')[0].disabled=false;
				$('.pointer_show_status')[1].disabled=false;
				$("#pointer_photo_link_id")[0].disabled=false;
				$("#pointer_register_id")[0].disabled=false;
				$("#pointer_delete_id")[0].disabled=false;
			}
		});
		
		photo_count=$("#pointer_photo_count_value").val();
	
		refreshObject();
		$(".create_new_pointer_data_btn").click(function(e){
			e.preventDefault();
			var flag=true;
			$.each($('#pointer_photo_table_id tr[pos]'), function(index, item) {
                var imageObject=$(item).find('td:nth-child(2) ul li img ');
				if (imageObject.length==0){
					flag=false;
				}
		    });
		    if(flag==true){
			init_variable();
			$("#image_manage").modal('hide');
		    }else{
		    	$.gritter.add({
					// (string | mandatory) the heading of the notification
					title: '',
					// (string | mandatory) the text inside the notification
					text:'グループ設定イメジを入力してください。!',
					class_name: 'gritter-error'
				});
		    }
		});
		//init_variable();
	    function init_variable(){
	    	photo=null;
			photo_content=null;
			photo=new Array();
			photo_content=new Array();
			var gallery_content="";
			$.each($('#pointer_photo_table_id tr[pos]'), function(index, item) {
				var content_temp=$(item).find('textarea').val();
                photo_content.push(content_temp);
                var imageObject = $(item).find('td:nth-child(2) ul li img ');
				var photo_temp = imageObject.attr('alt');
				var photo_url = imageObject.attr('src');
				gallery_content += "<li><a class='fancybox' data-fancybox-group='gallery' href='"+photo_url+"'><img alt='"+photo_temp+"' src='"+photo_url+"'></a></li>";
				photo.push(photo_temp);
		    });
		    
			$("#pointer_images  ul").empty();
		    $("#pointer_images  ul").append(gallery_content);
	    }
	  $("#pointer_photo_link_id").click(function(){
	  		// var photo_count=0;
	  		// $.each($('#pointer_photo_table_id tr[pos]'), function(index, item) {
				// photo_count++;
		    // });
	  		// if (photo_count==0) {
		    	// return false;
		    // };
		    // return true;
	  });                               
                                    
	  $('div#new_image_upload_div').uploadify({
		  
	  });
	  $("#image_update_hidden_div").updateuploadify({
			
	  });
	  $(".backup_photo_data_btn").click(function(){
		  $("#pointer_photo_table_id").html(backup_photo);
		  refreshObject();
	  });
	  $("#image_manage_close_id").click(function(){
		  $("#pointer_photo_table_id").html(backup_photo);
		  refreshObject();
	  });
	  $("#pointer_photo_link_id").click(function(){
		  backup_photo=$("#pointer_photo_table_id").html();
	  });
	  $("#pointer_create_button").click(function(){
		  if ($(this).hasClass('active')){
			  $(".pointer_position_alert").hide();
              $(".pointer_property_form *").attr('disabled',false);
              $("#pointer_delete_id").attr('disabled',true);
			  pos_handler.removeFeature(current_feature);
              current_feature=null; 
		  }else{
                $(".pointer_property_form *").attr('disabled',true); 
                $("#pointer_id_value").val('');
                $("#pointer_period_id").val('');
                $("#pointer_name_id").val('');
                $("#pointer_kananame_id").val('');
                html_comment_handler.document.getBody().setHtml('');
                                       
                $("#pointer_address_id").val('');
                $("#pointer_curaddress_id").val('');
                $("#pointer_content_id").html('');
                $("#pointer_extra_id").val('');
                $("#pointer_images ul").empty();
                $('#pointer_photo_table_id tr[pos]').empty();
                $('#pointer_photo_table_id tr[pos]').remove();
                
                $("#pointer_position_longlatdisp_id").text('');                
                $("#pointer_position_longitude_id").val('');
                $("#pointer_position_latitude_id").val('');
                
                $('#pointer_register_id').text('登録');
		  	    $(".pointer_position_alert").show();
			animate_right_handler('show');
		  }
	  });
	  $(".chosen-select").chosen(); 
	  //$('.right_span_div,.bottom_span_div').sortable({
//	        connectWith: '.widget-container-span-none',
//			items:'> .widget-box',
//			opacity:0.8,
//			revert:true,
//			forceHelperSize:true,
//			placeholder: 'widget-placeholder',
//			forcePlaceholderSize:true,
//			tolerance:'pointer'
//	    });
		
	  $(".right-panel-handler").click(function(e){
		  e.preventDefault();
		  e.stopPropagation();
		  animate_right_handler('toggle');
	  });
	  
	  $(".right-panel-handler").mousedown(function(e){
		  e.stopImmediatePropagation();
		  e.stopPropagation();	
	  });
	  $(".right-panel-handler").mousemove(function(e){
		  e.stopImmediatePropagation();
		  e.stopPropagation();	
	  });
	  $(".bottom_span_div .widget-header").mousedown(function(e){
		  e.stopImmediatePropagation();
		  e.stopPropagation();	
	  });
	  $(".bottom_span_div .widget-header").mousemove(function(e){
		  e.stopImmediatePropagation();
		  e.stopPropagation();	
	  });
	  
	  $(".bottom_span_div .widget-header").click(function(){
		  $(this).toggleClass('updown');
		  var origin_top=$(window).height()-$(".bottom_span_div .widget-header").height()-$("#navbar").height();
		  if ($(this).hasClass('updown')){
			  $(".bottom_span_div").animate({
			  top:  origin_top-$(".bottom_span_div .widget-body").height()
		  	  }, "fast");
		  	  $("#bottom_sidebar-collapse i").removeClass('icon-double-angle-up').addClass('icon-double-angle-down');
		  }else{
			  $(".bottom_span_div").animate({
				  top:  origin_top
			  }, "fast");
			  $("#bottom_sidebar-collapse i").removeClass('icon-double-angle-down').addClass('icon-double-angle-up');
			  
		  }
		  
	  });
	  $('.fancybox').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',

			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,

			helpers : {
				title : {
					type : 'over'
				},
				buttons	: {}
			},

			afterLoad : function() {
				var id=this.index+1;
				var title=$("#pointer_photo_table_id tbody tr[pos]:nth-child("+id+") td textarea").val();
				title=title.replace('<',"&lt;");
				title=title.replace('>',"&gt;");
                temp ='';
                for (i=0;i<title.length;i++){ 
                   if (title[i]=='\n'){
                     temp+="<br>"; 
                     continue;    
                   }
                   if(title.charCodeAt(i)==32){
                     temp+="&nbsp";
                       continue; 
                   }
                   temp+=title[i];
               }                                              
				this.title = temp;
			}
		});
        var condition=new Object();
            condition.pointer_name = '';
            condition.pointer_age = new Array(1,2,3);
            condition.pointer_show = new Array(0,1);
            condition.pointer_comment = '';
            condition.category = 0;
            condition.sortby =   'asc';  //$("input#pointer_comment").val();
            condition.sortcolumn ='pointer.pointer_name'; //$("select#category_search").val();
        searchByAjax(condition);
        $("#html_comment_dialog .modal-dialog .modal-footer .ok_btn").click(function(){
            var html=html_comment_handler.document.getBody().getHtml();
            $("#pointer_content_id").html(html);
            $("#html_comment_dialog").hide();
        });
        $("#html_comment_dialog .modal-dialog .modal-footer .cancel_btn").click(function(){
            var html=$("#pointer_content_id").html();
            html_comment_handler.document.getBody().setHtml(html);
        });
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
        slider_handler=$( "#map_control_slider_vertical" ).slider({
            orientation: "vertical",
            range: "max",
            min: 0,
            max: 5,
            step: 1,
            value: 1,
            slide: function( event, ui ) {
                current_zoom=ui.value;
                map_view.setZoom(current_zoom);
            }
        });
        $(".zoom_plus_control").click(function(){
           current_zoom=current_zoom==5?5:current_zoom+1;
           slider_handler.slider( "value", current_zoom);  
           map_view.setZoom(current_zoom);
        });
        $(".zoom_minus_control").click(function(){
           current_zoom=current_zoom==0?0:current_zoom-1;
           slider_handler.slider( "value", current_zoom);  
           map_view.setZoom(current_zoom); 
        });
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
        $("#html_comment_btn").click(function(){
        	$("#html_comment_dialog").show();
        });
        $("#html_comment_dialog button.close,#html_comment_dialog button.cancel_btn").click(function(){
        	$("#html_comment_dialog").hide();
        });
});