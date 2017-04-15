@extends('member.admin.datatables')
@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">Manage Feeds</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Manage Feeds</li>
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
                <header class="panel-heading">
                    <h3 class="panel-title">Manage Feeds</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-hover dataTable table-striped table-responsive" id="dataTables-message">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>

                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($datas as $post)
                            <tr class="gradeX">
                                <td>{{$post->name}}</td>
                                <td>{{$post->url}}</td>
                                <td>{{$post->description}}</td>
                                <td class="actions">
                                    <form action="{{url('/admin/manage-sources')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="feed_id" value="{{$post->id}}">
                                        <input type="hidden" name="feed_status" value="{{$post->status}}">
                                        <input type="hidden" name="datasource_id" value="{{$post->datasource_id}}">
                                        @if($post->status==1)
                                            <button class="btn btn-danger" name="toggle_feed_status">Deactivate
                                            </button>
                                        @elseif($post->status==0)
                                            <button class="btn btn-success" name="toggle_feed_status">Activate
                                            </button>
                                        @endif
                                        <button class="btn btn-success" name="activate_grab">Activate Grab
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Panel Table Tools -->
            <!-- End Panel Table Add Row -->
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#dataTables-message').DataTable({
            order: [[2, 'desc']]
        });
    });
</script>
@endpush