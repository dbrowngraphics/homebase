<div id="panel-notes" class="panel panel-sortable">
    <div class="panel-hdr bg-primary-900">
        <h2>
            Notes <span class="fw-300"><i>Here</i></span>
        </h2>
        <div class="panel-toolbar">
            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
        </div>
    </div>
    <div class="panel-container show">
        <div id="" class="panel-content" style="overflow-x: scroll;">
        	<div class="row mb-3">
        		<!-- <div class="flexDisplay"> -->
        			<button class="btn btn-sm btn-success waves-effect waves-themed"><b><span class="fal fa-plus"></span>  Add</b></button>
<!-- 	        			<button class="btn btn-sm btn-secondary waves-effect waves-themed mx-3"><b><span class="fal fa-minus"></span>  Edit</b></button>
        			<button class="btn btn-sm btn-danger bg-danger-300 waves-effect waves-themed"><b><span class="fal fa-times"></span>  Delete</b></button> -->
        		<!-- </div> -->
        	</div>

        	<!-- <h2>NOTES HERE...</h2> -->
        	@foreach ($claim->notes as $note)

        		@if (! $loop->last)
        			@php
        				$hideNote = 'hidden';
        				$hideNote = '';
        				$border = 'border-bottom-custom';
        				$edit = '';
        				$lock = 'fas fa-lock';
        				$notesModal = '';
        			@endphp
        		@else
        			@php
        				$hideNote = '';
        				$border = '';
        				$edit = 'edit-btn';
        				$lock = 'fas fa-unlock';
        				$notesModal = '#notesModal';
        			@endphp
        		@endif

        	<div  id="{{ $note->note_id }}" class="row note_list mb-3 {{ $border }}" style="margin-bottom: 1rem;">
        		<div class="col-2 full-input">
        			<label for="note_id" class="{{ $hideNote }}">Id</label>
						<!-- <input type="text" name="note_id" value=""> -->
						<div id="{{ $note->note_id }}_note_id">{{ $note->note_id }}</div>
					</div>

					<div class="col-1 full-input">
        			<label for="note_by" class="{{ $hideNote }}">User</label>
						<!-- <input type="text" name="note_by" value=""> -->
						<div id="{{ $note->note_id }}_note_by">{{ $note->note_by }}</div>
					</div>

					<div class="col-2 full-input">
        			<label for="note_type" class="{{ $hideNote }}">Type</label>
						<!-- <input type="text" name="note_type" value=""> -->
						<div id="{{ $note->note_id }}_note_type">{{ $note->note_type }}</div>
					</div>

					<div class="col-2 full-input">
        			<label for="note_action" class="{{ $hideNote }}">Action</label>
						<!-- <input type="text" name="note_action" value=""> -->
						<div id="{{ $note->note_id }}_note_action">{{ $note->note_action }}</div>
					</div>

					<div class="col-2 full-input">
        			<label for="note_date" class="{{ $hideNote }}">Expiry</label>
						<!-- <input type="text" name="note_date" value=""> -->
						<div id="{{ $note->note_id }}_note_date">{{ date('m/d/Y', strtotime($note->note_date)) }}</div>
					</div>

				<div class="col-2 full-input">
        			<label for="note_date" class="{{ $hideNote }}">Priority</label>
						<!-- <input type="text" name="note_priority" value=""> -->
						<div id="{{ $note->note_id }}_note_priority">{{ $note->note_priority }}</div>
					</div>

					<div class="col-1 full-input {{ $hideNote }}">
        			<!-- <label for="note_image">Img</label> -->
						<!-- <input type="text" name="note_image" value=""> -->
						<div class="verticle-center">
							<i class="fas fa-file-image fa-3x color-info-600" style="margin-left: -0.15rem;"></i>
						</div>
					</div>

					<div class="col-10 full-input {{ $hideNote }}">
        			<label for="note_text">Note</label>
						<!-- <textarea name="note_text"></textarea> -->
						<div id="{{ $note->note_id }}_note_note">{{ $note->note }}</div>
					</div>

					<div class="col-1 full-input {{ $hideNote }}">
						<div class="verticle-center {{ $edit }}">
							<i class="{{ $lock }} fa-2x color-fusion-400" data-id="{{ $note->note_id }}" data-toggle="modal" data-target="{{ $notesModal }}"></i>
						</div>
        			<!-- <label for="note_image">Buttons</label> -->
						<!-- <input type="text" name="note_image" value=""> -->
						<!-- <div class="verticle-center edit-btn">
							<i title="Edit" class="{{ $lock }} fa-1HALFx color-primary-700 btn" data-id="{{ $note->note_id }}" data-toggle="modal" data-target="#notesModal"></i>
							 -->
							<!-- <i class="fas fa-times-hexagon fa-2x color-danger-700"></i> -->
						<!-- </div> -->

					</div>

					<div class="col-1 full-input {{ $hideNote }}">
						<div class="verticle-center">
							<!-- <i class="fas fa-lock fa-2x color-primary-700"></i>  fa-1HALFx -->
							<i title="Delete" class="fas fa-times-circle fa-2x color-danger-700"></i>
						</div>

					</div>

	        </div> <!-- End .row  -->

	        <!-- <hr class="my-1 hr-custom" /> -->
        	@endforeach
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="notesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-right modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary-900">
        <h5 class="modal-title" id="notesModalLabel">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">

		<form>
		<div class="row modal-rows">
			<div class="col-md-3 col-lg-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_id" class="col-form-label" style="text-align: right; font-weight: bold;">Id</label>
			</div>
			<div class="col-md-9 col-lg-9">
				<input type="text" name="modal_note_id" id="modal_note_id" class="form-control" value="">
			</div>

			<div class="col-md-3 col-sm-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_by" class="col-form-label" >User</label>
			</div>
			<div class="col-md-9 col-lg-9">
				<input type="text" name="modal_note_by" id="modal_note_by" class="form-control" value="">
			</div>
			<div class="col-md-3 col-sm-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_type" class="col-form-label" >Type</label>
			</div>
			<div class="col-md-9 col-sm-9">
				<input type="text" name="modal_note_type" id="modal_note_type" class="form-control" value="">
			</div>
			<div class="col-md-3 col-sm-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_action" class="col-form-label" >Action</label>
			</div>
			<div class="col-md-9 col-sm-9">
				<input type="text" name="modal_note_action" id="modal_note_action" class="form-control" value="">
			</div>
			<div class="col-md-3 col-sm-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_date" class="col-form-label" >Expiry</label>
			</div>
			<div class="col-md-9 col-sm-9">
				<input type="text" name="modal_note_date" id="modal_note_date" class="form-control" value="">
			</div>
			<div class="col-md-3 col-sm-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_priority" class="col-form-label" >Priority</label>
			</div>
			<div class="col-md-9 col-sm-9">
				<input type="text" name="modal_note_priority" id="modal_note_priority" class="form-control" value="">
			</div>
			<div class="col-md-3 col-sm-3" style="text-align: right; font-weight: bold;">
				<label for="modal_note_note" class="col-form-label" >Note</label>
			</div>
			<div class="col-md-9 col-sm-9">
				<textarea name="modal_note_note" id="modal_note_note" rows="10" class="form-control">
				
				</textarea>
			</div>
		</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@push('scripts')
<script>

$("#panel-notes").on("click", ".note_list", function() {
	$(this).children().removeClass("hidden");
	$(this).children().children().removeClass("hidden");
});

$('.verticle-center').each(function() {
	var height = $(this).height();
	var parentHeight = $(this).parent('div').height();

	var margin = (parentHeight - height) / 2;
	console.log("Height: " + margin);
});


$('.edit-btn').on('click', function() {

	var id = $(this).children('i').first().data('id');

	var modal_id = $('#' + id + '_note_id').text();
	console.log("Modal Id: " + modal_id);

	$('#modal_note_id').val($('#' + id + '_note_id').text());
	$('#modal_note_by').val($('#' + id + '_note_by').text());
	$('#modal_note_type').val($('#' + id + '_note_type').text());
	$('#modal_note_action').val($('#' + id + '_note_action').text());
	$('#modal_note_date').val($('#' + id + '_note_date').text());
	$('#modal_note_priority').val($('#' + id + '_note_priority').text());
	$('#modal_note_note').text($('#' + id + '_note_note').text());

});

</script>


@endpush