var map,map_target,map_layers,map_controls,
map_view,map_interactions,select_handler,selected_pointer_style
,projection,edo_layout,meichi_layout,xianzai_layout,handler_layout;
var current_feature;
var zoom_slider;
var mapMinZoom = 0;
var mapMaxZoom = 5;
var current_zoom=1;

var mapResolution = 1.000000;
var pos_handler;
var map_extent;
function elastic(t) {
  return Math.pow(2, -10 * t) * Math.sin((t - 0.075) * (2 * Math.PI) / 0.3) + 1;
}
function gotoPointer(coor){
	var pan = ol.animation.pan({
	    duration: 200,     
	    source: /** @type {ol.Coordinate} */ (map_view.getCenter())
	});
    map.beforeRender(pan);
    map_view.setCenter(coor);
}
function navigateMap(coor){
     gotoPointer(coor);
}
function transform(extent) {
  return ol.proj.transformExtent(extent, 'EPSG:4326', 'EPSG:3857');
}
function toRealCoordinate(cor){                            
    var origin=ol.proj.toLonLat(cor);
    var outx=origin[0]*(map_extent[0]-map_extent[2])/360+(map_extent[2]*179-map_extent[0])/180;
    var outy=origin[1]*(map_extent[1]-map_extent[3])/180+(map_extent[3]*89-map_extent[1])/90;
    outx=outx.toFixed(5);
    outy=outy.toFixed(5);
    var out = [outx,outy];
    return out;
}
$(document).ready(function() {     
        $(".map_view_div").css('width',$(window).width()-190-20);
		window.app = {};
		var app = window.app;
		/**
		 * @constructor
		 * @extends {ol.interaction.Pointer}
		 */
		app.Drag = function() {

		  ol.interaction.Pointer.call(this, {
		    handleDownEvent: app.Drag.prototype.handleDownEvent,
		    handleDragEvent: app.Drag.prototype.handleDragEvent,
		    handleMoveEvent: app.Drag.prototype.handleMoveEvent,
		    handleUpEvent: 	 app.Drag.prototype.handleUpEvent
		  });

		  /**
		   * @type {ol.Pixel}
		   * @private
		   */
		  this.coordinate_ = null;

		  /**
		   * @type {string|undefined}
		   * @private
		   */
		  this.cursor_ = 'pointer';

		  /**
		   * @type {ol.Feature}
		   * @private
		   */
		  this.feature_ = null;

		  /**
		   * @type {string|undefined}
		   * @private
		   */
		  this.previousCursor_ = undefined;

		};
		ol.inherits(app.Drag, ol.interaction.Pointer);


		/**
		 * @param {ol.MapBrowserEvent} evt Map browser event.
		 * @return {boolean} `true` to start the drag sequence.
		 */
		app.Drag.prototype.handleDownEvent = function(evt) {
		  var map = evt.map;
		  var feature=getAppropriateFeature(evt);
		  if (feature) {
		    this.coordinate_ = evt.coordinate;
		    this.feature_ = feature;
		  }
//		  var element = evt.map.getTargetElement();
//		  if (element.pointer_id>0){
//			  alert(element.pointer_id);
//		  }
		  return !!feature;
		};


		/**
		 * @param {ol.MapBrowserEvent} evt Map browser event.
		 */
		app.Drag.prototype.handleDragEvent = function(evt) {
		  var map = evt.map;

		  var feature=getAppropriateFeature(evt);

		  var deltaX = evt.coordinate[0] - this.coordinate_[0];
		  var deltaY = evt.coordinate[1] - this.coordinate_[1];

		  var geometry = /** @type {ol.geom.SimpleGeometry} */
		      (this.feature_.getGeometry());
		  geometry.translate(deltaX, deltaY);

		  this.coordinate_[0] = evt.coordinate[0];
		  this.coordinate_[1] = evt.coordinate[1];
		};


		/**
		 * @param {ol.MapBrowserEvent} evt Event.
		 */
		app.Drag.prototype.handleMoveEvent = function(evt) {
		  if (this.cursor_) {
		    var map = evt.map;
		    var feature=getAppropriateFeature(evt);
		    var element = evt.map.getTargetElement();
		    if (feature) {
		      if (element.style.cursor != this.cursor_) {
		        this.previousCursor_ = element.style.cursor;
		        element.style.cursor = this.cursor_;
		      }
		    } else if (this.previousCursor_ !== undefined) {
		      element.style.cursor = this.previousCursor_;
		      this.previousCursor_ = undefined;
		    }
		  }
		};


		/**
		 * @param {ol.MapBrowserEvent} evt Map browser event.
		 * @return {boolean} `false` to stop the drag sequence.
		 */
		app.Drag.prototype.handleUpEvent = function(evt) {
		  this.coordinate_ = null;
		  this.feature_ = null;
		  updateLonLatDisplay(evt);
		  return false;
		};
		/////
		pos_handler= new ol.source.Vector({
	        features: []
		});
        map_extent=[$("#map_bound_minx").val(),$("#map_bound_miny").val(),$("#map_bound_maxx").val(),$("#map_bound_maxy").val()];
        projection  = new ol.proj.Projection({
            code:'EPSG:3857',
            extent: transform([-180, -85, 180, 85]),
            units:'degrees',      
            global:false
        });
        edo_layout=new ol.layer.Tile({
                extent: projection.getExtent(),
                  source: new ol.source.OSM({
                    attributions: [
                          new ol.Attribution({
                            html: 'Tiles &copy; <a href="http://www.opencyclemap.org/">' + 'OpenCycleMap</a>'
                          }),
                          ol.source.OSM.ATTRIBUTION
                    ],
                    url: "../image/map_tile/edo/{z}/{x}/{y}.png",
                    minZoom: mapMinZoom,
                    maxZoom: mapMaxZoom
                  })
            });
        meichi_layout=new ol.layer.Tile({
                extent: projection.getExtent(),
                  source: new ol.source.OSM({
                    attributions: [
                          new ol.Attribution({
                            html: 'Tiles &copy; <a href="http://www.opencyclemap.org/">' + 'OpenCycleMap</a>'
                          }),
                          ol.source.OSM.ATTRIBUTION
                    ],
                    url: "../image/map_tile/meichi/{z}/{x}/{y}.png",
                    minZoom: mapMinZoom,
                    maxZoom: mapMaxZoom
                  })
            });
        xianzai_layout=new ol.layer.Tile({
                extent: projection.getExtent(),
                  source: new ol.source.OSM({
                    attributions: [
                          new ol.Attribution({
                            html: 'Tiles &copy; <a href="http://www.opencyclemap.org/">' + 'OpenCycleMap</a>'
                          }),
                          ol.source.OSM.ATTRIBUTION
                    ],
                    url: "../image/map_tile/current/{z}/{x}/{y}.png",
                    minZoom: mapMinZoom,
                    maxZoom: mapMaxZoom
                  })
            });
        handler_layout=new ol.layer.Vector({ 
                  extent: projection.getExtent(),           
                  source:pos_handler
                });                                                                 
		map_layers=[
	    	edo_layout,
            meichi_layout,
            xianzai_layout,
            handler_layout
	    	
	  	];
		map_target="map";
		var mousePositionControl = new ol.control.MousePosition({
              projection:projection,
			  coordinateFormat: ol.coordinate.createStringXY(5),          
			  className: 'custom-mouse-position',
			  target: document.getElementById('mouse-position'),
			  undefinedHTML: '&nbsp;'
			});
        zoom_slider=new ol.control.ZoomSlider();
        zoom_slider.setTarget('zoom_slider_control');
		map_controls = [new ol.control.Zoom({target:'zoom_slider_control'}),zoom_slider];
        var width=5;
        selected_pointer_style= new ol.style.Style({
                     image: new ol.style.Circle({
                       radius: width * 2,
                       fill: new ol.style.Fill({
                         color: [255,255,255,1]
                       }),
                       stroke: new ol.style.Stroke({
                         color: [255,0,0,1],
                         width: width / 2
                       })
                     }),          
                   });
		select_handler = new ol.interaction.Select({
          style: selected_pointer_style
        });
		map_view= new ol.View({
              center: [0, 0],
              projection: projection,
              extent: projection.getExtent(),
              zoom:2,
		      minZoom: mapMinZoom,
	       	  maxZoom: mapMaxZoom
		  }); 
		function getAppropriateFeature(evt){
            var feature;
			 if ($("#pointer_create_button").hasClass('active')){
				  feature = current_feature;
			  }else{
				  feature = map.forEachFeatureAtPixel(evt.pixel,
				      function(feature, layer) {
				        return feature;
				      });
			  }
			 return feature;
		}
		function updateLonLatDisplay(evt){
            var coor=evt.coordinate;
            var out=toRealCoordinate(coor);
			var pos_lon=coor[0];
			var pos_lat=coor[1];
			$("#pointer_position_longlatdisp_id").text(out[0]+"｜"+out[1]);				
			$("#pointer_position_longitude_id").val(pos_lon);
			$("#pointer_position_latitude_id").val(pos_lat);
		}
		select_handler.on('select', function(e) {
			if ($("#pointer_create_button").hasClass('active')){
				return;
			}
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
			var features=e.selected;
            
			if (features.length>0){
                features[0].setStyle(selected_pointer_style);
                features[0].selected=true;
                current_feature=features[0];
				search_table_row(features[0].pointer_id);
				getPointerDataByAjax(features[0].pointer_id);
			}
			console.log( e.target.getFeatures().getLength() +
			          ' selected features (last operation selected ' + e.selected.length +
			          ' and deselected ' + e.deselected.length + ' features)');
		});
        
		function map_init() {                                          
			  map = new ol.Map({                                                                                                             
				  interactions: ol.interaction.defaults().extend([select_handler,new app.Drag()]),
				  layers : map_layers,
				  target: map_target,
				  controls: map_controls,          
				  view:map_view
			});            
            meichi_layout.setVisible(false);
            xianzai_layout.setVisible(false); 
           // console.log(map_view.getProjection());                                                         
		}                                           
        
		map_init();
		map.on('postrender', function(evt) {
            //alert('a');
        });
		map.on('singleclick', function(evt) {
            //toRealCoordiate                                 
			if($(".pointer_position_alert").css('display')!='none'){
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
				var tempFeature =new ol.Feature(new ol.geom.Point(evt.coordinate));
				tempFeature.pointer_id='new';
                tempFeature.setStyle(selected_pointer_style);
				pos_handler.addFeature(tempFeature);
                current_feature=tempFeature;
                current_feature.selected=true;
				var pos_lon=evt.coordinate[0];
				var pos_lat=evt.coordinate[1];
				$("#pointer_id_value").val('');
	 			$("#pointer_period_id").val('');
				$("#pointer_name_id").val('');
				$("#pointer_kananame_id").val('');
				
				$("#pointer_address_id").val('');
                $("#pointer_curaddress_id").val('');
				$("#pointer_content_id").html('');
				$("#pointer_extra_id").val('');
				$("#pointer_images ul").empty();
				$('#pointer_photo_table_id tr[pos]').empty();
				$('#pointer_photo_table_id tr[pos]').remove();
				var out=toRealCoordinate([pos_lon,pos_lat])
				$("#pointer_position_longlatdisp_id").text(out[0]+"｜"+out[1]);				
				$("#pointer_position_longitude_id").val(pos_lon);
				$("#pointer_position_latitude_id").val(pos_lat);
				
				$(".pointer_position_alert").hide();
				$("#pointer_period_id").focus();
                $(".pointer_property_form *").attr('disabled',false);
			}
            // if(current_feature){
                // animate_right_handler('hide');
            // }
		});
	});
