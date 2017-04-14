$(document).ready(function(){
		$("input.rgb_number").keypress(function(e) {
			if (event.which < 48 || event.which > 57) return false;
		});
});