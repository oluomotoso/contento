@extends('member.user.default')
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/user/dashboard')}}">Dashboard</a></li>
                <li class="active">Finalize Order</li>
            </ol>
        </div>
        <!-- /. ROW  -->
        <div class="page-content container-fluid">

            <div class="row">
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
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session('message') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="col-md-8 col-md-offset-2">
                    <!-- Example Panel Fullscreen -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Finalize Order & Generate Invoice</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" action="{{ url('/user/user-settings') }}" method="post">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Subscription Name</label>
                                            <input class="form-control"
                                                   value="{{$subscription_name}}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Subscribed Links</label>
                                            <textarea
                                                    readonly class="form-control" rows="5"
                                                    cols="2">@foreach($sources as $source){{$source->datasource->url.','}}@endforeach</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Allowed Domains</label>
                                            <input class="form-control"
                                                   value="{{$domain_number}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Plan Name</label>
                                            <input class="form-control"
                                                   value="{{$plan->name}}" readonly>
                                        </div>
                                        {!! csrf_field() !!}

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Actual Cost</label>
                                            <input class="form-control"
                                                   value="{{$actual_cost. ' '.$currency_code}}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input class="form-control"
                                                   value="{{$total_discount.' %'}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Final Cost</label>
                                            <input class="form-control"
                                                   value="{{$final_cost. ' '.$currency_code}}" readonly>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success center-block">Create Subscription
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- End Example Panel Fullscreen -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
    <script>
        function setSelectedIndex(s, v) {

            for (var i = 0; i < s.options.length; i++) {

                if (s.options[i].text == v) {

                    s.options[i].selected = true;

                    return;

                }

            }

        }

        setSelectedIndex(document.getElementById('country'), "Nigeria");
        setSelectedIndex(document.getElementById('prefix'), "Nigeria (234)");

    </script>
@endsection