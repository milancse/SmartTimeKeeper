$(document).ready(function(){
	$.ajaxSetup({
	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
	var root_url = "<?php echo Request::root(); ?>/";
});

function addNewOption(markup_id, append_area){
	var element_id = Math.floor(Date.now() / 1000);
	$("#"+append_area).append(
			"<div id='"+element_id+"'>"+
			"<div class='row'>"+$("#"+markup_id).html()+"</div>"+
			"<div class='row'><div class='col-md-12'><a class='pull-right' href='javascript:removeElement("+element_id+");'>remove</a></div></div>"+
			"</div>"
			);
}

function removeElement(id){
	$("#"+id).remove();
}

function showConfirmationBox(message){
	$("#modal_confirmation .modal-body").html(message);
	$("#modal_confirmation").modal('show');
	setTimeout(function(){
		$("#modal_confirmation").modal('hide');;
	}, 5000);
}