  
  $(document).ready(function() {
	$("#name").keyup( function() {
		var name=$("#name").val();
		if (name.length>2 && name.length <100){
			$(this).addClass("normal");
			$(this).removeClass("showerror");
			$(".error_name").addClass("error_hide");
			$(".error_name").removeClass("error_show");
		}else{
			$(this).addClass("showerror");
			$(this).removeClass("normal");
			$(".error_name").removeClass("error_hide");
			$(".error_name").addClass("error_show");
			$(".login_bt").disable();
		}
	});
	$("#password").keyup( function() { 
		var pass=$("#password").val();
		if (pass.length>5 && pass.length <1024){
			$(this).addClass("normal");
			$(this).removeClass("showerror");
			$(".error_password").addClass("error_hide");
			$(".error_password").removeClass("error_show");
		}else{
			$(this).addClass("showerror");
			$(this).removeClass("normal");
			$(".error_password").removeClass("error_hide");
			$(".error_password").addClass("error_show");
		}
	});
  });
