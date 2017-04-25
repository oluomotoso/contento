@extends('member.user.datatables')
@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">Create Subscription</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/user/dashboard')}}">Dashboard</a></li>
                <li class="active">Create Subscription</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="row center-block">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-success center-block">
                        <ul>
                            <li>{{ session('message') }}</li>
                        </ul>
                    </div>
                @endif
            </div>
            <!-- Panel Table Tools -->

            <div class="panel">


                <form id="frm-example" action="{{url('/user/create-subscription')}}" method="POST">

                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>

                        <h2 class="panel-title">Select Sources</h2>
                    </header>
                    <div class="panel-body">

                        <table class="table table-bordered table-striped mb-none display"
                               id="dataTables-example"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><input name="select_all" value="1" type="checkbox"></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Website</th>
                                <th>Total Contents in (7) days</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->name}}</td>
                                    <td>{{$post->description}}</td>
                                    <td>{{$post->datasource->url}}</td>
                                    <th>{{$post->feed->count()}}</th>
                                    <th>{{$post->updated_at->diffForHumans()}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <span class="info">Please select websites above</span>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" placeholder="Name of Subscription"
                                           value="{{old('name')}}" name="name">
                                </div>
                                <input value="0" name="is_category" hidden>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="duration">Duration</label>
                                        <select class="form-control" id="duration" name="duration">
                                            @foreach($plans as $plan)
                                                <option value="{{$plan->id}}">{{$plan->name.' ('. $plan->discount .'% off )'}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="domain">Number of Allowed Domain</label>
                                        <input id="domain" class="form-control" type="number" name="number_of_domain">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                        <button type="submit" id="button" class="btn btn-primary" name="select">SUBMIT
                        </button>

                    </div>
                </form>

            </div>
            <!-- End Panel Table Tools -->
            <!-- End Panel Table Add Row -->
        </div>
    </div>

@endsection
@push('scripts')
<script>
    function updateDataTableSelectAllCtrl(table) {
        var $table = table.table().node();
        var $chkbox_all = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if ($chkbox_checked.length === 0) {
            chkbox_select_all.checked = false;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length) {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = true;
            }
        }
    }

    $(document).ready(function () {
        // Array holding selected row IDs
        var rows_selected = [];
        var table = $('#dataTables-example').DataTable({
            //'ajax': 'https://api.myjson.com/bins/1us28',
            'columnDefs': [
                {
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox">';
                    }
                },
            ],order: [[4, 'desc']],
            'rowCallback': function (row, data, dataIndex) {
                // Get row ID
                var rowId = data[0];

                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        // Handle click on checkbox
        $('#dataTables-example tbody').on('click', 'input[type="checkbox"]', function (e) {
            var $row = $(this).closest('tr');

            // Get row data
            var data = table.row($row).data();

            // Get row ID
            var rowId = data[0];

            // Determine whether row ID is in the list of selected row IDs
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle click on table cells with checkboxes
        $('#dataTables-example').on('click', 'tbody td, thead th:first-child', function (e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
            if (this.checked) {
                $('#dataTables-example tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#dataTables-example tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        table.on('draw', function () {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });

        // Handle form submission event
        $('#frm-example').on('submit', function (e) {
            var form = this;

            // Iterate over all selected checkboxes
            $.each(rows_selected, function (index, rowId) {
                // Create a hidden element
                $(form).append(
                        $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'id[]')
                                .val(rowId)
                );
            });

        });
    });
</script>
@endpush