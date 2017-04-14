   ajax_flag=false;
   var pointer_imagedata;
    function getPointerDataByAjax(pid){
          if (ajax_flag==false){
                $('#search_loading_status').show();
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
                        pointer_data=json.pointer_data;
                        pointer_imagedata=json.pointer_image_data;
                        $(".pointer_period").html(pointer_data.pointer_period);
                        $(".pointer_name").html(pointer_data.pointer_name);
                        $(".pointer_kananame").html(pointer_data.pointer_kananame);
                        $(".pointer_lonlat").html(pointer_data.pointer_longlatdisp);
                        $(".pointer_address").html(pointer_data.pointer_address);
                        $(".pointer_curaddress").html(pointer_data.pointer_curaddress);
                        $(".pointer_extra").html(pointer_data.pointer_extra);
                        $('#search_loading_status').hide();
                        html_front="";
                        if (pointer_imagedata.length>0){
                           image_file_name=json.pointer_image_data[0].photo_name;      
                           image_url="./image/pointer/uploaded_photos/"+image_file_name;
                           html_front +="<a class='btn btn-info fancybox' data-fancybox-group='gallery' href='"+image_url+"'></a>";
                           for(var i =1;i<json.pointer_image_data.length;i++){        
                                image_file_name=json.pointer_image_data[i].photo_name;      
                                image_url="./image/pointer/uploaded_photos/"+image_file_name;
                                html_front +="<a class='fancybox' data-fancybox-group='gallery' href='"+image_url+"'></a>";
                                
                           }
                           $(".pointer_image_href").removeClass('hidden'); 
                        }else{
                          image_url ="./image/pointer/uploaded_photos/no-image.png";
                          html_front +="<a class='btn btn-info fancybox' data-fancybox-group='gallery' href='"+image_url+"'></a>";  
                          $(".pointer_image_href").addClass('hidden');
                        }
                        
                        $("#pointer_image_album").html(html_front); 
                        //popupshow
                      //  var coordinate = evt.coordinate;
//                        var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(
//                                  coordinate, 'EPSG:3857', 'EPSG:4326'));
//
//                              //popupcontent.innerHTML = '<p>You clicked here:</p><code>' + hdms +
//                    //              '</code>'; 
                              refreshImageList();
                              popupoverlay.setPosition(selectedpt_coordinate);
                              
                       //               popupshowend
                    }    
                   });
            }
      }
function refreshImageList(){             
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
                buttons    : {}
            },

            afterLoad : function() {
                var id=this.index;
                if (pointer_imagedata.length>0){
                    var title=pointer_imagedata[id].photo_comment;
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
                    
                }else{
                    temp="no image";
                }        
                this.title = temp;
            }
        });   
}