$(document).ready(function(){
	$('#reader').html5_qrcode(function(data){
			 document.getElementById("example").setAttribute('value',data);
		},
		function(error){
			$('#read_error').html(error);
		}, function(videoError){
			$('#vid_error').html(videoError);
		}
	);
});
