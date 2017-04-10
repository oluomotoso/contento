@extends('member.user.datatables')
@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">Manage {{$subscription->domain[0]->user_domain->url}}</h1>
            @if(count($subscription->domain[0]->user_domain) ==1)
                <p class="pull-right text-success">
                    Linked
                </p>
                @else
                <p class="pull-right text-danger">
                    Not Linked
                </p>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Manage Subscriptions</li>
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
                    <h3 class="panel-title">Manage Subscriptions</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-hover dataTable table-striped table-responsive" id="dataTables-message">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Date</th>
                            <th>Action on {{$subscription->domain[0]->user_domain->url}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscription->feeds as $feeds)
                            @foreach($feeds->feed->feed as $feed)
                                <tr>
                                    <td><p>{{$feed->title}}</p><i
                                                class="text-success">{{$feed->datasources_feed->Datasource->url}}</i>
                                    </td>
                                    <td>@foreach($feed->category as $category)
                                            <p>{{$category->category->category}}</p>@endforeach</td>
                                    <td><p>{{$feed->updated_at}}</p></td>
                                    <td>
                                        <form class="form" method="post" action="{{url('user/update-blogger-domain')}}">
                                            {{csrf_field()}}
                                            <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                            <input name="domain" value="{{$subscription->domain[0]->id}}" type="hidden">
                                            <input name="feed" value="{{$feed->id}}" type="hidden">
                                            <p><button type="submit" id="button" class="btn btn-success">Publish
                                            </button></p>
                                            <p><button type="submit" id="button" class="btn btn-primary">Add to Draft
                                            </button></p>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
        $('#dataTables-message').DataTable({});
    });
</script>
@endpush