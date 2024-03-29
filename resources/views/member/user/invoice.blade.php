@extends('member.user.default')
@push('styles')
<link rel="stylesheet" href="{{asset('css/invoice.css')}}">
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
                    <section class="panel">
                        <div class="panel-body">
                            <div class="invoice">
                                <header class="clearfix">
                                    <div class="row">
                                        <div class="col-sm-6 mt-md">
                                            <h4 class="h4 m-none text-dark text-bold">INVOICE NO:
                                                #{{$subscription->id}}</h4>
                                        </div>
                                    </div>
                                </header>
                                <div class="bill-info">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="bill-to">
                                                @if($subscription->status==false)
                                                    <h4 class="h2 m-none text-dark text-bold">STATUS: <span
                                                                class="text-danger">PENDING PAYMENT</span>
                                                    </h4>
                                                    <br>
                                                    <form method='POST' action="{{ url('/user/buyonline')}}">
                                                        <div class="form-group">
                                                            {!! csrf_field() !!}
                                                            <input class="form-control" type="hidden"
                                                                   name="transaction_id"
                                                                   value="{{$subscription->transaction->id}}"
                                                                   id="amount">
                                                            <button type="submit" class="btn btn-primary">PROCEED TO
                                                                MAKE PAYMENT
                                                                ONLINE
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <br>
                                                    <h2 class="h2 m-none text-dark text-bold">OR</h2>
                                                    <br>
                                                    <div>
                                                        <h3 class="h3 m-none text-dark text-bold">FEMTOSH GLOBAL
                                                            KONCEPT</h3>
                                                        &nbsp;
                                                        <h4 class="h4 m-none text-dark text-bold">0116466377 (GTB)</h4>
                                                        &nbsp;
                                                        <h4 class="h4 m-none text-dark text-bold">1019839706 (UBA)</h4>
                                                    </div>
                                                @else
                                                    <h4 class="h2 m-none text-dark text-bold">STATUS: <span
                                                                class="text-success">APPROVED</span>
                                                    </h4>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="bill-data text-right">
                                                @if($subscription->status == false)
                                                    <p class="mb-none">
                                                        <span class="text-dark">Generated Date:</span>
                                                        <span class="value">{{date_format($subscription->updated_at,'d M Y')}}</span>
                                                    </p>
                                                    <p class="mb-none">
                                                        <span class="text-dark">Due Date:</span>
                                                        <span class="value">{{date_format($subscription->created_at,'d M Y')}}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-none">
                                                        <span class="text-dark">Approved Date:</span>
                                                        <span class="value">{{date('d M Y',strtotime($subscription->date_approved))}}</span>
                                                    </p>
                                                    <p class="mb-none">
                                                        <span class="text-dark">Expiry Date:</span>
                                                        <span class="value">{{date('d M Y',strtotime($subscription->expiry_date))}}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($subscription->status==false)
                                    <div class="table-responsive">
                                        <table class="table invoice-items">
                                            <thead>
                                            <tr class="h4 text-dark">
                                                <th id="cell-item" class="text-semibold">Sources</th>
                                                <th id="cell-price" class="text-center text-semibold">Actual Cost</th>
                                                <th id="cell-qty" class="text-center text-semibold">Duration(Months)
                                                </th>
                                                <th class="text-center text-semibold">Discount</th>
                                                <th id="cell-total" class="text-center text-semibold">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-semibold text-dark">Contents
                                                    from
                                                    @if($subscription->is_category == 1)
                                                        @foreach($subscription->category_feeds as $feed)

                                                        <h6>{{$feed->category->category}}</h6>
                                                        @endforeach
                                                    @else
                                                    @foreach($subscription->feeds as $feed)

                                                            <h6>{{$feed->feed->datasource->url}}</h6>

                                                    @endforeach
                                                    @endif
                                                </td>

                                                <td class="text-center">{{$subscription->transaction->actual_cost.' '.country($subscription->transaction->currency->country)->getCurrency()['iso_4217_code']}}</td>
                                                <td class="text-center">{{$subscription->plan->month}}</td>
                                                <td class="text-center text-success">
                                                    - {{$subscription->transaction->discount .'% off'}}</td>
                                                <td class="text-center">{{$subscription->transaction->amount.' '.country($subscription->transaction->currency->country)->getCurrency()['iso_4217_code']}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="invoice-summary">
                                        <div class="row">
                                            <div class="col-sm-5 col-sm-offset-7">
                                                <table class="table h5 text-dark">
                                                    <tbody>
                                                    <tr class="b-top-none">
                                                        <td colspan="2">Total</td>
                                                        <td class="text-left">{{$subscription->transaction->actual_cost.' '.country($subscription->transaction->currency->country)->getCurrency()['iso_4217_code']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Discount</td>
                                                        <td class="text-left text-danger">
                                                            - {{$subscription->transaction->actual_cost-$subscription->transaction->amount .' '.country($subscription->transaction->currency->country)->getCurrency()['iso_4217_code']}}</td>
                                                    </tr>
                                                    <tr class="h4">
                                                        <td colspan="2">Grand Total</td>
                                                        <td class="text-left text-success">
                                                            <b>{{$subscription->transaction->amount.' '.country($subscription->transaction->currency->country)->getCurrency()['iso_4217_code']}}</b>
                                                        </td>
                                                    </tr>
                                                    </tbody>

                                                </table>
                                                <form method='POST' action='{{url('/user/pay-online')}}'>

                                                    <input type='hidden' name='subscription_id'
                                                           value='{{$subscription->id}}'/>
                                                    <input type='hidden' name='transaction_id'
                                                           value="{{$subscription->transaction->id}}"/>
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">PAY ONLINE NOW
                                                        </button>
                                                    </div>

                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <!-- end: page -->
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->

@endsection