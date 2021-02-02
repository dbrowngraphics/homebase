@extends('layouts.master')

@section('css')

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="{{ asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">

@endsection

@section('content')
<main id="js-page-content" role="main" class="page-content" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h3><b>{{ $node->node }}:</b> {{ $node->node_name }}

                <button type="button" class="btn btn-primary btn-sm" 
                    style="margin-left: 10px; position: relative; top: -3px;"
                    data-toggle="modal" data-target="#formModal" data-edit="CREATE">
                        <span class="glyphicon glyphicon-plus" title="Add Form to Web" aria-hidden="true"></span>&nbsp;&nbsp;ADD ENTRY
                </button>
                <button id="syncWithLiveBtn" type="button" class="btn btn-warning btn-sm" style="position: relative; top: -3px;"
                    data-toggle="modal" data-target="#fileModal" data-edit="FILE"><span class="glyphicon glyphicon-refresh" title="SYNC WITH LIVE" aria-hidden="true"></span>&nbsp;&nbsp;SYNC WITH LIVE
                </button>

            </h3>

            <div class="ml-5 mt-3">
                <div class="key-square key_inactive"></div><div style="float:left; margin-left: 10px;">Form is inactive.</div>
                <div class="key-square key_not_exist" style="margin-left: 25px;"></div><div style="float:left; margin-left: 10px;">Form exist on the server, but no associated record.</div>
                <div class="key-square key_no_file_server" style="margin-left: 25px;"></div><div style="float:left; margin-left: 10px;">Document doesn't exsist on the server.</div>
            </div>

            <div class="py-3"></div>

            <table id="articles" class="table m-0 table-bordered table-striped table-hover table-sm no-footer" role="grid">
                <thead>
                    <tr>
                        <th class="no-border table-cell-white"></th>
                        <th>Title</th>
                        <th>Filename</th>
                        @if ($isGroupCode)
                            <th>Group</th>
                        @endif

                        <th class="text-centered">Begin Date</th>
                        <th class="text-centered">End Date</th>
                        <th class="text-centered">Category</th>
                        <th class="text-centered">Last Modified</th>
                        <th colspan="2" class="no-border"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($articleCollection as $form)
                    <tr>
                        <td class="no-border table-cell-white">
                    @if ($form->db)
                        @if ($form->active)
                            @if ($form->file)
                                
                            @else
                                <div class="key-circle key_no_file_server"></div>
                            @endif
                        @else
                            <div class="key-circle key_inactive"></div>
                        @endif
                    @else
                        <div class="key-circle key_not_exist"></div>
                    @endif
                        </td>
                        <td>{!! Str::limit($form->title, 75) !!}</td>
                        {{-- <td><a href="{!! route('displayForm', ['node' => $node->node, 'id' => $form->id]) !!}" target="_blank">{!! Str::limit($form->filename, 75) !!}</a></td> --}}

                        <td class="center">
                            <a href="{!! route('web-node.form', ['node' => $node->node, 'id' => $form->id]) !!}" target="_blank">{!! Str::limit($form->filename, 75) !!}</a>
                        </td>

                        @if ($isGroupCode)
                            <td>{!! $form->groupcd !!}</td>
                        @endif

                        <td class="text-centered">{!! $form->beginDate !!}</td>
                        <td class="text-centered">{!! $form->endDate !!}</td>
                        <td class="text-centered">{!! $form->category !!}</td>
                        <td class="text-centered">{!! $form->modified !!}</td>

                        @if (!$form->db)
                            <?php $dataLine = 'data-edit  = EDITNEW' ?>
                        @else
                            <?php $dataLine = 'data-edit  = EDIT' ?>
                        @endif

                        <td class="no-border text-centered table-cell-white">
                            <button type="button" id="edit_{{ $form->id }}" class="btn btn-primary btn-xs edit-btn"
                                data-toggle     = "modal"
                                data-target     = "#formModal"
                                data-id         = "{{ $form->id }}"
                                data-title      = "{{ $form->title }}"
                                data-text       = "{{ $form->text }}"
                                data-link       = "{{ $form->filename }}"
                                data-content    = "{{ $form->content }}"
                                data-groupcd    = "{{ $form->groupcd }}"
                                data-active     = "{{ $form->active }}"
                                data-section    = "{{ $form->section }}"
                                data-category   = "{{ $form->category }}"
                                data-categoryId = "{{ $form->categoryId }}"
                                data-beginDate  = "{{ $form->beginDate }}"
                                data-endDate    = "{{ $form->endDate }}"
                                {{ $dataLine }}
                            >
                                <span class="fal fa-edit" title="Edit" aria-hidden="true"></span><span>&nbsp;&nbsp;Edit</span>
                            </button>
                        </td>
                        <td class="no-border text-centered table-cell-white">
                        @if ($form->db)
                            <input type="checkbox" class="toggle-switch"
                                <?php
                                if($form->active) {
                                    echo "checked";
                                } else {
                                    echo "";
                                } ?>

                            data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="mini"
                                data-id      = "{{ $form->id }}"
                                data-node    = "{{ $node->node }}",
                                data-title   = "{{ $form->title }}"
                                data-text    = "{{ $form->text }}"
                                data-link    = "{{ $form->filename }}"
                                data-content = "{{ $form->content }}"
                                data-groupcd = "{{ $form->groupcd }}"
                                data-active  = "{{ $form->active }}"
                                data-section = "{{ $form->section }}">
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade formModal" id="formModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary-900">
        <h5 class="modal-title" id="formModalLabel">Add/Edit Documents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle" style="color: #ffffff"></i></span>
        </button>
      </div>
      <div class="modal-body">

        <form id="webDocs_submit" method="POST" action="{!! route('WebDocs.save') !!}" accept-charset="UTF-8" enctype="multipart/form-data">
            {!! csrf_field() !!}
        <div class="row modal-rows">
            <div class="col-md-10 col-lg-10 offset-md-1 offset-lg-1" style="">
                <label for="modal_title" class="col-form-label" style="">Title</label>
                <input type="text" name="modal_title" id="modal_title" class="form-control" value="">
            </div>

            <div class="col-md-10 col-lg-10 offset-md-1 offset-lg-1" style="">
                <div class="row">
                    <div class="col-md-11 col-lg-11">
                        <label for="modal_link" class="col-form-label" >Link</label>
                        <input type="text" name="modal_link" id="modal_link" class="form-control" value="">
                    </div>
                    <div class="col-md-1 col-lg-1">
                        <input type="file" name="getfile" id="getfile" class="inputfile hidden" />
                        <label id="labelFile" for="getfile" style="position: relative; top: 3em; left: -1em;">
                            <span id="btn" class="btn btn-default fas fa-file" title="Add a File" aria-hidden="true"></span>
                        </label>
                    </div>
                </div>
            </div>

<!--             <div class="col-md-1 col-lg-1 col-sm-4">
                
            </div> -->


            <div class="col-md-5 col-lg-5 offset-md-1 offset-lg-1">
                <label for="modal_group_code" class="col-form-label" >Group Code</label>
                <input type="text" name="modal_group_code" id="modal_group_code" class="form-control" value="">
            </div>

            <div class="col-md-5 col-lg-5 form-group">
                <label for="modal_category" class="col-form-label" >Category</label>
                <!-- <input type="text" name="modal_category" id="modal_category" class="form-control" value=""> -->

                <select id="modal_category" name="modal_category" class="form-control">
                    <option value="hidden">--- Select A Category ---</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>

            </div>

            <div class="col-md-4 col-lg-4 offset-md-1 offset-lg-1">
                <label for="modal_begin_date" class="col-form-label" >Begin Date</label>
                <div class="input-group">
                    <input type="text" name="modal_begin_date" id="begin_date" class="form-control" value="">
                    <div class="input-group-append">
                        <span class="input-group-text fs-xl"><i class="fal fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <label for="modal_end_date" class="col-form-label" >End Date</label>
                <div class="input-group">
                    <input type="text" name="modal_end_date" id="end_date" class="form-control" value="">
                    <div class="input-group-append">
                        <span class="input-group-text fs-xl"><i class="fal fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2" style="position: relative;">
<!--                 <div class="custom-control custom-checkbox">
                    <label for="article_active" class="custom-control-label">Active</label>
                    <input type="checkbox" id="article_active" name="article_active" class="custom-control-input" value="Y">
                </div> -->

                <div class="custom-control custom-checkbox" style="position: absolute; bottom: 0.25rem;">
                    <input id="modal_active" name="modal_active" type="checkbox" value="Y" class="custom-control-input" />
                    <label class="custom-control-label" for="modal_active"><b>Active</b></label>
                </div>
            </div>
        </div>

            <input name="modal_node" type="hidden" value="{{ $node->node }}" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="submit_WebDocs" type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

</main>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{ asset('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

<script>
    $('#begin_date, #end_date').datepicker({
        startDate: "01/01/2019"
    });

    $('.edit-btn').on("click", function(){
        var id = $(this).data('id'),
            url_action  = '{!! route('web-node.update', $node->node) !!}';

        $('#webDocs_submit').attr('action', url_action + '/' + id);


        $('#modal_title').val($(this).data('title'));
        $('#modal_link').val($(this).data('link'));

        var patch = '<input id="patch" name="_method" type="hidden" value="PATCH">';
        $('#webDocs_submit').append(patch);

    });



    $('#getfile').on('change', function(e){
        let filename = this.files[0].name;
        let regex = /[^a-zA-Z0-9\-\_]+/gm;
        let lastPeriod = filename.lastIndexOf(".");
        let extention = filename.substring(lastPeriod, filename.length);
        let modFilename = filename.substring(0, lastPeriod);
        let removeCommas = modFilename.replace(/,/g, "");
        let modifiedFilename = removeCommas.replace(/ /g, "_");
        let regexFilename = modifiedFilename.replace( regex, '') + extention.toLowerCase();

        $('#modal_link').attr('placeholder', regexFilename);
        $('#modal_link').val(regexFilename);
    });

    $('#submit_WebDocs').on("click", function(){
        $('#webDocs_submit').submit();
    });


    $('#formModal').on('hidden.bs.modal', function(e) {
        $('#formModal').find('#modal_title').val("");
        $('#formModal').find('#modal_text').val("");
        $('#formModal').find('#modal_link').val("");
        $('#formModal').find('#modal_groupcd').val("");
        $('#formModal').find('#modal_content').val("");
        $('#formModal').find('#getfile').val("");
        $('#modal_link').attr('placeholder', "");
        $('#formModal').find('#modal_category').val("");
    });

</script>
@endpush
