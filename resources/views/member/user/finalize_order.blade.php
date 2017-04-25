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
                                <form role="form" action="{{ url('/user/finalize-subscription') }}" method="post">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Subscription Name</label>
                                            <input class="form-control"
                                                   value="{{$subscription_name}}" readonly name="subscription_name">
                                        </div>

                                        <div class="form-group">
                                            <label>Subscribed Links</label>
                                            <textarea readonly class="form-control" rows="5"
                                                      cols="2">@foreach($sources as $source) @if($is_category == 0){{$source->datasource->url.','}}@else{{$source->category.','}}@endif @endforeach</textarea>
                                            @foreach($feeds as $feed)
                                                <input name="feeds[]" type="hidden" value="{{$feed}}">
                                            @endforeach
                                            <input name="currency" type="hidden" value="{{$currency}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Allowed Domains</label>
                                            <input class="form-control"
                                                   value="{{$domain_number}}" readonly name="allowed_domains">
                                        </div>
                                        <input value="{{$is_category}}" name="is_category" hidden>

                                        <div class="form-group">
                                            <label>Plan</label>
                                            <select name="plan" class="form-control" readonly>
                                                <option value="{{$plan->id}}">{{$plan->name}}</option>
                                            </select>
                                        </div>
                                        {!! csrf_field() !!}

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Actual Cost</label>
                                            <select name="actual_cost" class="form-control" readonly>
                                                <option class="form-control"
                                                        value="{{$actual_cost}}"
                                                        readonly>{{$actual_cost. ' '.$currency_code}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <select name="discount" class="form-control" readonly>
                                                <option class="form-control"
                                                        value="{{$total_discount}}"
                                                        readonly>{{$total_discount.' %'}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Final Cost</label>
                                            <select name="final_cost" class="form-control" readonly>
                                                <option class="form-control"
                                                        value="{{$final_cost}}"
                                                        readonly>{{$final_cost. ' '.$currency_code}}</option>
                                            </select>
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