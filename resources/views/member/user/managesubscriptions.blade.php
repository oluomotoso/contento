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
                            <th>Name</th>
                            <th>DOMAINS</th>
                            <th>INVOICE</th>
                            <th>STATUS</th>
                            <th>Ends AT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{$subscription->name}}</td>
                                @if($subscription->status == 1)
                                    <td>
                                        @if(count($subscription->domain)==0)
                                            <p>No domain added yet</p>
                                            <form class="form" method="post" action="{{url('user/manage-domains')}}">
                                                {{csrf_field()}}
                                                <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                                <button type="submit" id="button" class="btn btn-default">Add Domain
                                                </button>
                                            </form>
                                        @elseif(count($subscription->domain)== $subscription->number_of_domains)
                                            <p>Maximum ({{$subscription->number_of_domains}}) domains added</p>
                                        <!--form class="form" method="post" action="{{url('user/manage-domains')}}">
                                                {{csrf_field()}}
                                                <label>
                                                    <select name="domain" class="form-control">
                                                        @foreach($subscription->domain as $domain)
                                            <option value="{{$domain->id}}">{{$domain->user_domain->url}}</option>
                                                        @endforeach
                                                </select>
                                            </label>

                                            <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                                <button type="submit" id="button" class="btn btn-default"
                                                        name="manage_domain">Manage Domain
                                                </button>
                                            </form-->
                                            @foreach($subscription->domain as $domain)
                                                <p>
                                                    <a href="{{url('user/manage-domain/'.$subscription->id.'/d/'.$domain->id)}}">{{$domain->user_domain->url}}</a>
                                                </p>
                                            @endforeach
                                        @elseif(count($subscription->domain)< $subscription->number_of_domains)
                                            <p>({{count($subscription->domain)}}) domains added</p>
                                            @foreach($subscription->domain as $domain)
                                                <p>
                                                    <a href="{{url('user/manage-domain/'.$subscription->id.'/d/'.$domain->id)}}">{{$domain->user_domain->url}}</a>
                                                </p>
                                            @endforeach

                                            <form class="form" method="post" action="{{url('user/manage-domains')}}">
                                                {{csrf_field()}}
                                                <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                                <button type="submit" id="button" class="btn btn-default">Add Domain
                                                </button>
                                            </form>
                                        @endif

                                    </td>

                                    <td>
                                        <span>PAID</span>
                                    </td>

                                    <td><span class="btn btn-success">Approved</span>
                                    </td>
                                    <td>{{date_format($subscription->ends_at,'d M, Y')}}</td>
                                @else
                                    <td>Pay to add domain</td>
                                    <td>
                                        <form class="form" method="post" action="{{url('user/invoice')}}">
                                            {{csrf_field()}}
                                            <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                            <button type="submit" id="button" class="btn btn-primary"
                                                    name="select">Make Payment
                                            </button>
                                        </form>
                                    </td>
                                    <td><span class="btn btn-danger">Pending</span>
                                    </td>
                                    <td>N/A</td>

                                @endif
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