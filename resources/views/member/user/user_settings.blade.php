@extends('member.user.default')
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/user/dashboard')}}">Dashboard</a></li>
                <li class="active">MY SETTINGS</li>
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
                            <h3 class="panel-title text-center">Update Settings</h3>
                            <p class="info text-center">Kindly note that your country and currency cannot be changed when updated</p>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" action="{{ url('/user/user-settings') }}" method="post">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="Name"
                                                   value="{{Auth::user()->name}}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control"
                                                   placeholder=""
                                                   value="{{Auth::user()->email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if($user->user_profile !== null)
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <input class="form-control"
                                                           placeholder="Default Sender for your account"
                                                           value="{{country($user->user_profile->country)->getName()}}"
                                                           readonly>


                                                </div>
                                                <label>Default Currency</label>

                                                <input class="form-control"
                                                       placeholder="Default Sender for your account"
                                                       value="{{country($user->user_profile->currency->country)->getCurrency()['iso_4217_code']}}"
                                                       readonly>
                                            @else
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <select class="form-control" id="country" name="country">
                                                        @foreach(countries() as $country)
                                                            <option value="{{$country['iso_3166_1_alpha2']}}">{{$country['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label>Default Currency</label>

                                                <select class="form-control" id="currency" name="currency">
                                                    @foreach($currencies as $currency)
                                                        <option value="{{$currency->id}}">{{country($currency->country)->getCurrency()['iso_4217_name'].' ('. country($currency->country)->getCurrency()['iso_4217_code'].')'}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        {!! csrf_field() !!}


                                    </div>

                                    <button type="submit" class="btn btn-default center-block">Submit Button
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