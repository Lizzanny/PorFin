$(document).on("ready", function(){
	$.ajax({
		url: 'php/consultas.php',
		type: 'POST',
		dataType: 'json'
	}).done(function(res) {
		  verificaActividad(res);
	}).fail(function() {
		    console.log("error");
	}) 
});
