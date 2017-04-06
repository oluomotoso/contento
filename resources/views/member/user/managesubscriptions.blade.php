@extends('member.user.datatables')
@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">Manage Subscriptions</h1>
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
                <div class="panel-title">
                    <a href="{{url('/user/create-subscription')}}">
                        <button class="btn btn-primary">NEW SUBSCRIPTION</button>
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-hover dataTable table-striped table-responsive" id="dataTables-message">
                        <thead>
                        <tr>
                            <th>DOMAINS</th>
                            <th>INVOICE</th>
                            <th>STATUS</th>
                            <th>Ends AT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>
                                    <form class="form" method="post" action="{{url('user/manage_subscriptions')}}">
                                        {{csrf_field()}}
                                        <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                        <button type="submit" id="button" class="btn btn-default"
                                                name="manage_subscription">Manage Domain
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form class="form" method="post" action="{{url('user/invoice')}}">
                                        {{csrf_field()}}
                                        <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                        <button type="submit" id="button" class="btn btn-primary pull-right"
                                                name="select">INVOICE
                                        </button>
                                    </form>
                                </td>
                                <td>@if($subscription->status == 1)<span
                                            class="btn btn-success">Approved</span>@elseif($subscription->status == 0)
                                        <span class="btn btn-danger">Pending</span>@endif
                                </td>
                                <td>{{date_format($subscription->updated_at,'d M, Y')}}</td>
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
        $('#dataTables-message').DataTable({});
    });
</script>
@endpush