@extends('member.user.default')
@push('styles')
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
@endpush
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Manage Sources</li>
            </ol>
        </div>
        <!-- /. ROW  -->
        <div class="page-content">

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


                    <div class="row">

                        <div class="pricing-table">
                            <div class="col-lg-3 col-sm-6">
                                <div class="plan">
                                    <h3>Enterprise<span>$59</span></h3>
                                    <a class="btn btn-lg btn-primary" href="#">Sign up</a>
                                    <ul>
                                        <li><b>10GB</b> Disk Space</li>
                                        <li><b>100GB</b> Monthly Bandwidth</li>
                                        <li><b>20</b> Email Accounts</li>
                                        <li><b>Unlimited</b> subdomains</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="plan most-popular">
                                    <div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
                                    <h3>Professional<span>$29</span></h3>
                                    <a class="btn btn-lg btn-primary" href="#">Sign up</a>
                                    <ul>
                                        <li><b>5GB</b> Disk Space</li>
                                        <li><b>50GB</b> Monthly Bandwidth</li>
                                        <li><b>10</b> Email Accounts</li>
                                        <li><b>Unlimited</b> subdomains</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="plan">
                                    <h3>Standard<span>$17</span></h3>
                                    <a class="btn btn-lg btn-primary" href="#">Sign up</a>
                                    <ul>
                                        <li><b>3GB</b> Disk Space</li>
                                        <li><b>25GB</b> Monthly Bandwidth</li>
                                        <li><b>5</b> Email Accounts</li>
                                        <li><b>Unlimited</b> subdomains</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="plan">
                                    <h3>Basic<span>$9</span></h3>
                                    <a class="btn btn-lg btn-primary" href="#">Sign up</a>
                                    <ul>
                                        <li><b>1GB</b> Disk Space</li>
                                        <li><b>10GB</b> Monthly Bandwidth</li>
                                        <li><b>2</b> Email Accounts</li>
                                        <li><b>Unlimited</b> subdomains</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->

@endsection