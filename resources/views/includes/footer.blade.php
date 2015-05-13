<div id="modal_punchin_comment" class="modal fade">
	<div class="modal-dialog">
    	<div class="modal-content">
    		{!! Form::open(array('url' => 'attendance/punchin')) !!}
		      	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">    
					
					<div class="form-group">
						{!! Form::label('Comment', 'Comment')!!}
						{!! Form::textarea('comment', null, array('placeholder'=>'Write your comments','class' => 'form-control')) !!}
					</div>
				</div>
				<div class="modal-footer">
      				<input name="hdn_action" id="hdn_action" type="hidden" value="">
      				<input name="hdn_gid" id="hdn_gid" type="hidden" value="">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			<button type="submit" name="save_btn" class="btn btn-primary"><i class='fa fa-save'></i> Save</button></a>
      			</div>
			{!! Form::close() !!}
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('bootstrap-3.3.4/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>


<!-- AdminLTE App -->
<script src="{{ URL::asset('js/AdminLTE/app.js') }}" type="text/javascript"></script>

@yield('custom_script')

<script src="{{ URL::asset('js/custom_script.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('#comment').click(function(){
		$("#modal_punchin_comment .modal-title").html('Write your comment');
		$("#hdn_action").val('add');
		$("#modal_punchin_comment").modal("show");	
	});
});
</script>