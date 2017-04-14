@extends('app')
@section('content')

<link rel="stylesheet" href="{{asset('css/map_tiler/maptiler.css')}}" />

<!--<script src="{{asset('js/styler.js')}}"></script>-->
<script type="text/javascript">
    $(function() {
       $("#sidebar > ul li").removeClass('active');
        $(".master_href").removeClass('open').removeClass('active');
        $(".maptiler_href").addClass('active');
    });
</script>
<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
		try { ace.settings.check('breadcrumbs', 'fixed'); } catch (e) { }
	</script>

	<ul class="breadcrumb">
		<li class="active">マップtiler</li>
	</ul><!-- .breadcrumb -->
</div>

<div class="page-content">
						
	<div class="row maptiler_content_div">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row-fluid">
				<div class="span12">
					<div class="widget-box">
						<div class="widget-header widget-header-blue widget-header-flat">
							<h4 class="lighter">MapTiler Wizard</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
									<ul class="wizard-steps">
										<li data-target="#step1" class="active">
											<span class="step">1</span>
											<span class="title">地図画像の指定</span>
										</li>

										<li data-target="#step2">
											<span class="step">2</span>
											<span class="title">パラメータ設定</span>
										</li>

										<li data-target="#step3">
											<span class="step">3</span>
											<span class="title">地図画像の分割</span>
										</li>
									</ul>
								</div>

								<hr />
								<div class="step-content row-fluid position-relative" id="step-container">
									<div class="step-pane active" id="step1">
										<h3 class="lighter block green">地図画像を指定してください。</h3>

										<form class="form-horizontal" id="validation-form">
											<div class="widget-body">
												<div class="widget-main">
													<input type="file" id="id-input-file-2" />
													<input class="btn btn-info" type="submit" value="画像アップロド" />
												</div>
											</div>
										</form>
									</div>

									<div class="step-pane" id="step2">
										<div class="row-fluid">
											<div class="alert alert-success">
												Bounding Box、その他のパラメータを設定してください。
											</div>
											<div>
												<div id="map_param_div">
													<div>
														<strong>軽度、緯度範囲:</strong>&nbsp;&nbsp;&nbsp;
														北東
														<input type="text" id="north_east_lon" name="north_east_lon" />&nbsp;(軽度),&nbsp;&nbsp;
														<input type="text" id="north_east_lat" name="north_east_lat" />&nbsp;(緯度)
													</div>
													<div>
														南西
														<input type="text" id="south_west_lon" name="south_west_lon" />&nbsp;(軽度),&nbsp;&nbsp;
														<input type="text" id="south_west_lat" name="south_west_lat" />&nbsp;(緯度)
													</div>
													<div>
														<strong>ズーム範囲:</strong>
														<input type="text" id="min_zoom" name="min_zoom" />&nbsp;~&nbsp;
														<input type="text" id="max_zoom" name="max_zoom" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														（1-20の数値で入力してください。）
													</div>
												</div>
												<div id="map_view"></div>
												<div style="clear: both;"></div>
											</div>
											<div class="col-xs-9 col-md-10">
												<div id="eq">
													<span class="ui-slider-green">77</span>
												</div>
											</div>
										</div>
									</div>

									<div class="step-pane" id="step3">
										<div class="center">
											<h3 class="blue lighter">This is step 3</h3>
										</div>
									</div>

									<div class="step-pane" id="step4">
										<div class="center">
											<h3 class="green">Congrats!</h3>
											Your product is ready to ship! Click finish to continue!
										</div>
									</div>
								</div>

								<hr />
								<div class="row-fluid wizard-actions">
									<button class="btn btn-prev">
										<i class="icon-arrow-left"></i>
										Prev
									</button>

									<button class="btn btn-success btn-next" data-last="Finish ">
										Next
										<i class="icon-arrow-right icon-on-right"></i>
									</button>
								</div>
							</div><!-- /widget-main -->
						</div><!-- /widget-body -->
					</div>
				</div>
			</div>

			<div id="modal-wizard" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" data-target="#modal-step-contents">
							<ul class="wizard-steps">
								<li data-target="#modal-step1" class="active">
									<span class="step">1</span>
									<span class="title">Validation states</span>
								</li>

								<li data-target="#modal-step2">
									<span class="step">2</span>
									<span class="title">Alerts</span>
								</li>

								<li data-target="#modal-step3">
									<span class="step">3</span>
									<span class="title">Payment Info</span>
								</li>

								<li data-target="#modal-step4">
									<span class="step">4</span>
									<span class="title">Other Info</span>
								</li>
							</ul>
						</div>

						<div class="modal-body step-content" id="modal-step-contents">
							<div class="step-pane active" id="modal-step1">
								<div class="center">
									<h4 class="blue">Step 1</h4>
								</div>
							</div>

							<div class="step-pane" id="modal-step2">
								<div class="center">
									<h4 class="blue">Step 2</h4>
								</div>
							</div>

							<div class="step-pane" id="modal-step3">
								<div class="center">
									<h4 class="blue">Step 3</h4>
								</div>
							</div>
						</div>

						<div class="modal-footer wizard-actions">
							<button class="btn btn-sm btn-prev">
								<i class="icon-arrow-left"></i>
								Prev
							</button>

							<button class="btn btn-success btn-sm btn-next" data-last="Finish ">
								Next
								<i class="icon-arrow-right icon-on-right"></i>
							</button>

							<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
								<i class="icon-remove"></i>
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->

<script src="{{asset('js/openlayer/OpenLayers.js')}}"></script>

<script type="text/javascript">

	jQuery(function($) {
	
		$("div#sidebar > ul.nav nav-list > li:nth-child(2)").addClass('active');
		/*
		$('[data-rel=tooltip]').tooltip();
	
		// $(".select2").css('width','200px').select2({allowClear:true})
		// .on('change', function(){
			// $(this).closest('form').validate().element($(this));
		// }); 
	
	
		var $validation = false;
		$('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
			if (info.step == 1 && $validation) {
				if (!$('#validation-form').valid()) return false;
			}
		}).on('finished', function(e) {
			bootbox.dialog({
				message: "Thank you! Your information was successfully saved!", 
				buttons: {
					"success" : {
						"label" : "OK",
						"className" : "btn-sm btn-primary"
					}
				}
			});
		}).on('stepclick', function(e){
			//return false;//prevent clicking on steps
		});
	
		$.mask.definitions['~']='[+-]';
		$('#phone').mask('(999) 999-9999');
	
		jQuery.validator.addMethod("phone", function (value, element) {
			return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
		}, "Enter a valid phone number.");
	
		$('#id-input-file-1 , #id-input-file-2').ace_file_input({
			no_file: 'No File ...',
			btn_choose: 'Choose',
			btn_change: 'Change',
			droppable: false,
			onchange: null,
			thumbnail: false
		});
	
		$("#eq > span").css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
			// read initial values from markup and remove that
			var value = parseInt( $( this ).text(), 10 );
			$( this ).empty().slider({
				value: value,
				range: "min",
				animate: true
				
			});
		});
		
		$('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			rules: {
				email: {
					required: true,
					email:true
				},
				password: {
					required: true,
					minlength: 5
				},
				password2: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				name: {
					required: true
				},
				phone: {
					required: true,
					phone: 'required'
				},
				url: {
					required: true,
					url: true
				},
				comment: {
					required: true
				},
				state: {
					required: true
				},
				platform: {
					required: true
				},
				subscription: {
					required: true
				},
				gender: 'required',
				agree: 'required'
			},
	
			messages: {
				email: {
					required: "Please provide a valid email.",
					email: "Please provide a valid email."
				},
				password: {
					required: "Please specify a password.",
					minlength: "Please specify a secure password."
				},
				subscription: "Please choose at least one option",
				gender: "Please choose gender",
				agree: "Please accept our policy"
			},
	
			invalidHandler: function (event, validator) { //display error alert on form submit   
				$('.alert-danger', $('.login-form')).show();
			},
	
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
	
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
	
			errorPlacement: function (error, element) {
				if(element.is(':checkbox') || element.is(':radio')) {
					var controls = element.closest('div[class*="col-"]');
					if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
					else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
				} else if(element.is('.select2')) {
					error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
				} else if(element.is('.chosen-select')) {
					error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
				}
				else error.insertAfter(element.parent());
			},
	
			submitHandler: function (form) {
			},
			invalidHandler: function (form) {
			}
		});
		
		$('#modal-wizard .modal-header').ace_wizard();
		$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
		*/
	})

</script>
@endsection



