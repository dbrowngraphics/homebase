<div id="panel-scanviewer" class="panel panel-sortable">
    <div class="panel-hdr bg-danger-700">
        <h2>
            Errors <span class="fw-300"><i>Panel</i></span>
        </h2>
        <div class="panel-toolbar">
            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
        </div>
    </div>
    <div class="panel-container show">
        <div id="" class="panel-content" style="overflow-x: scroll;">

        	<div class="row">
	        	<table class="table table-sm table-striped table-bordered">
	        		<thead>
	        			<tr>
	        				<th>Line Id</th>
	        				<th>Error Type</th>
	        				<th>Description</th>
	        			</tr>
	        		</thead>

	        		<tbody>
	        		@foreach ($claim->errors as $error)
	        			
	        			<tr>
	        				<td>{{ $error->line_id }}</td>
	        				<td>{{ $error->error_type }}</td>
	        				<td>{{ $error->description }}</td>
	        			</tr>

	        		@endforeach
	        		</tbody>
	        	</table>
	        </div>
        </div>
    </div>
</div>