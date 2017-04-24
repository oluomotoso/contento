@extends('member.user.default')
@push('styles')
<link rel="stylesheet" href="{{asset('member/global/vendor/chartist-js/chartist.min3f0d.css?v2.2.0')}}">
<link rel="stylesheet"
      href="{{asset('member/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min3f0d.css?v2.2.0')}}">
<link rel="stylesheet" href="{{asset('member/global/vendor/aspieprogress/asPieProgress.min3f0d.css?v2.2.0')}}">
<link rel="stylesheet"
      href="{{asset('member/global/vendor/jquery-selective/jquery-selective.min3f0d.css?v2.2.0')}}">
<link rel="stylesheet"
      href="{{asset('member/global/vendor/bootstrap-datepicker/bootstrap-datepicker.min3f0d.css?v2.2.0')}}">

<!-- Page -->
<link rel="stylesheet" href="{{asset('member/topbar/assets/examples/css/dashboard/team.min3f0d.css?v2.2.0')}}">

@endpush
@section('content')
    <div class="page animsition">
        <div class="page-header">
            <div class="page-header-actions">
            </div>
        </div>
        <div class="page-content padding-30 container-fluid">
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
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-md-3 col-sm-12 col-xs-12">

                    <div class="panel panel-primary text-center no-boder bg-color-blue">

                        <div class="panel-body">

                            <i class="icon icon-5x wb-book" style="color: dodgerblue"></i>

                            <h3>{{$content}}</h3>
                        </div>


                        <div class="panel-footer">
                            Total Contents in 24 hours

                        </div>
                        <a class="btn" href="{{ url('/latest-contents') }}">Latest Contents</a>
                    </div>

                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="icon icon-5x wb-settings" style="color: dodgerblue"></i>

                            <h3>{{$subscription}}</h3>
                        </div>
                        <div class="panel-footer">
                            Active Subscriptions

                        </div>
                        <a class="btn" href="{{ url('/user/create-subscription') }}">Create Subscription</a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-primary text-center no-boder bg-color-brown">
                        <div class="panel-body">
                            <i class="icon icon-5x wb-copy" style="color: dodgerblue"></i>

                            <h3>{{$published}} </h3>
                        </div>
                        <div class="panel-footer">
                            Total Published

                        </div>
                        <a class="btn" href="{{ url('/user/manage-subscriptions') }}">Manage Subscriptions</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-primary text-center no-boder bg-color-brown">
                        <div class="panel-body">
                            <i class="icon icon-5x wb-globe" style="color: dodgerblue"></i>

                            <h3>{{$domain}} </h3>
                        </div>
                        <div class="panel-footer">
                            TOTAL DOMAIN
                        </div>
                        <a class="btn" href="{{ url('/user/manage-subscriptions') }}">Manage Subscriptions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<!-- Plugins For This Page -->
<script src="{{asset('member/global/vendor/chartist-js/chartist.min.js')}}"></script>
<script src="{{asset('member/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('member/global/vendor/aspieprogress/jquery-asPieProgress.min.js')}}"></script>
<script src="{{asset('member/global/vendor/matchheight/jquery.matchHeight-min.js')}}"></script>
<script src="{{asset('member/global/vendor/jquery-selective/jquery-selective.min.js')}}"></script>
<script src="{{asset('member/global/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

@endpush