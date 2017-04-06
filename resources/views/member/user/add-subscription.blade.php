@extends('member.user.default')
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/user/dashboard')}}">Dashboard</a></li>
                <li class="active">Finalize Subscription</li>
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
                            <h3 class="panel-title text-center">Finish Subscription</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" action="{{ url('/user/subscribe') }}" method="post">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="Name of Subscription"
                                                   value="{{old('name')}}" name="name">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="duration">Duration</label>
                                                <select class="form-control" id="duration" name="duration">
                                                    @foreach($plans as $plan)
                                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Selected URLs</label>
                                            @foreach($sources as $source)
                                                <input class="form-control" value="{{$source->datasource->url}}"
                                                       readonly>
                                            @endforeach

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