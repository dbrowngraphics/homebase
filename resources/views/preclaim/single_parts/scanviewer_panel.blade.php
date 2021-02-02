<div id="panel-scanviewer" class="panel panel-sortable">
    <div class="panel-hdr bg-primary-900">
        <h2>
            Scanviewer <span class="fw-300"><i>Panel</i></span>
        </h2>
        <div class="panel-toolbar">
<!-- 	            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
            <button class="btn btn-panel js-panel-plus" data-action="panel-plus" data-toggle="tooltip" data-offset="0,10" data-original-title="Plus"></button>
        </div>
    </div>
    <div class="panel-container show">
        <div id="" class="panel-content" style="overflow-x: scroll;">

        	<a href="http://intranet.cwibenefits.com/scanviewer2/?dcn={{ $claim->dcn }}" target="popup"
        		onclick="window.open('http://intranet.cwibenefits.com/scanviewer2/?dcn={{ $claim->dcn }}', 'popup', 'width=800,height=800'); return false;">

        	<img src="{{ asset('img/scanviewer.jpg') }}" alt="scanviewer" aria-roledescription="logo" style="max-width: 100%">
        	</a>

        </div>
    </div>
</div>