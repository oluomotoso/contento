@extends('member.admin.default')
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                <li class="active">SITE SETTINGS</li>
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
                            <h3 class="panel-title">Manage Settings</h3>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Update Currencies</h3>
                                    <form role="form" action="{{ url('/admin/site-settings') }}" method="post">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select class="form-control fullwidth" name="country" id="country" required>
                                                @foreach(countries() as $country)
                                                    <option value="{{$country['iso_3166_1_alpha2']}}">{{$country['name'].' ('.country($country['iso_3166_1_alpha2'])->getCurrency()['iso_4217_name'].')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>RATE TO USD</label>
                                            <input class="form-control" placeholder="Value"
                                                   name="value"
                                                   value="{{old('value')}}">
                                        </div>
                                        {{csrf_field()}}
                                        <label><input type="checkbox" name="remove"> Remove Currency</label>
                                        <button type="submit" class="btn btn-default center-block" name="currency">
                                            Submit Button
                                        </button>
                                    </form>
                                    @foreach($currencies as $currency)
                                        <li>{{country($currency->country)->getCurrency()['iso_4217_name'].':'.$currency->rate_to_usd}}</li>
                                    @endforeach
                                </div>

                                <div class="col-md-6">
                                    <h3>Update Plans</h3>
                                    <form role="form" action="{{ url('/admin/site-settings') }}" method="post">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="name"
                                                   name="name"
                                                   value="{{old('name')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Days</label>
                                            <input class="form-control" placeholder="Days"
                                                   name="days"
                                                   value="{{old('days')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Months</label>
                                            <input class="form-control" placeholder="Month"
                                                   name="month"
                                                   value="{{old('month')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input class="form-control" placeholder="Discount"
                                                   name="discount"
                                                   value="{{old('discount')}}">
                                        </div>
                                        {{csrf_field()}}
                                        <label><input type="checkbox" name="remove"> Remove Plan</label>
                                        <button type="submit" class="btn btn-default center-block" name="plans">Submit
                                            Button
                                        </button>
                                    </form>
                                    @foreach($plans as $plan)
                                        <li>{{$plan->name}}</li>
                                    @endforeach
                                </div>

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

        setSelectedIndex(document.getElementById('country'), "Nigeria (234)");

    </script>
@endsection