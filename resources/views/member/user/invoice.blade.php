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
                                            <h4 class="h4 m-none text-dark text-bold">INVOICE NO: #{{$subscription->id}}</h4>
                                        </div>
                                    </div>
                                </header>
                                <div class="bill-info">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="bill-to">
                                                @if($subscription->status==false)
                                                    <h4 class="h2 m-none text-dark text-bold">STATUS: <span class="text-danger">PENDING PAYMENT</span>
                                                    </h4>
                                                    <br>
                                                    <form method='POST' action='https://voguepay.com/pay/'>

                                                        <input type='hidden' name='v_merchant_id' value='12143-300'/>
                                                        <input type='hidden' name='merchant_ref'
                                                               value="{{$subscription->transaction->id}}"/>
                                                        <input type='hidden' name='memo'
                                                               value="content subscription on contento.com.ng"/>

                                                        <input type='hidden' name='notify_url'
                                                               value="{{ url('/voguepay/notify') }}"/>
                                                        <input type='hidden' name='success_url'
                                                               value="{{ url('/voguepay/success') }}"/>
                                                        <input type='hidden' name='fail_url'
                                                               value="{{ url('/voguepay/failure') }}"/>

                                                        <input type='hidden' name='developer_code' value='56fb6c9ed9764'/>
                                                        <input type='hidden' name='store_id' value='405'/>
                                                        <input type='hidden' name='total'
                                                               value='{{$subscription->transaction->amount}}'/>

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">PAY ONLINE NOW
                                                            </button>
                                                            &nbsp;
                                                            <span class="info">Use online payment for instant approval</span>
                                                        </div>

                                                    </form>
                                                    <br>
                                                    <h2 class="h2 m-none text-dark text-bold">OR</h2>
                                                    <br>
                                                    <div>
                                                        <h3 class="h3 m-none text-dark text-bold">FEMTOSH GLOBAL KONCEPT</h3>
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
                                                <th id="cell-price" class="text-center text-semibold">Price</th>
                                                <th id="cell-qty" class="text-center text-semibold">Duration(Months)</th>
                                                <th class="text-center text-semibold">Discount</th>
                                                <th id="cell-total" class="text-center text-semibold">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-semibold text-dark">Contents
                                                    from @foreach($subscription->feeds as $feed)
                                                        <h6>{{$feed->feed->datasource->name}}</h6>
                                                    @endforeach</td>
                                                <td class="text-center">{{$price[0]->cost*$subscription->transaction->currency->rate*count($subscription->feeds)*$subscription->plan->month .' '.$subscription->transaction->currency->code}}</td>
                                                <td class="text-center">{{$subscription->plan->month}}</td>
                                                <td class="text-center text-danger">
                                                    - {{((($price[0]->cost*$subscription->transaction->currency->rate*count($subscription->feeds)*$subscription->plan->month)-$subscription->transaction->amount)/($price[0]->cost*$subscription->transaction->currency->rate*count($subscription->feeds)*$subscription->plan->month))*100 .'%'}}</td>
                                                <td class="text-center">{{$subscription->transaction->amount.' '.$subscription->transaction->currency->code}}</td>
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
                                                        <td class="text-left">{{$price[0]->cost*$subscription->transaction->currency->rate*count($subscription->feeds)*$subscription->plan->month.' '.$subscription->transaction->currency->code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Discount</td>
                                                        <td class="text-left text-danger">
                                                            - {{($price[0]->cost*$subscription->transaction->currency->rate*count($subscription->feeds)*$subscription->plan->month)-$subscription->transaction->amount.' '.$subscription->transaction->currency->code}}</td>
                                                    </tr>
                                                    <tr class="h4">
                                                        <td colspan="2">Grand Total</td>
                                                        <td class="text-left text-success">
                                                            <b>{{$subscription->transaction->amount.' '.$subscription->transaction->currency->code}}</b>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
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