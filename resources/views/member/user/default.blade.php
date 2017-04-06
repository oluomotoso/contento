@extends('member.default')

@section('topbar')
    <div class="site-menubar site-menubar-light">
        <div class="site-menubar-body">
            <div>
                <div>
                    <ul class="site-menu">
                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="{{url('/user/dashboard')}}" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                                <span class="site-menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown site-menu-item has-section has-sub">
                            <a class="dropdown-toggle" href="{{url('/user/subscriptions')}}"
                               data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                                <span class="site-menu-title">Manage Subscriptions</span>

                            </a>
                        </li>
                        <li class="dropdown site-menu-item has-section has-sub">
                            <a class="dropdown-toggle" href="{{url('/user/pricing')}}"
                               data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-payment" aria-hidden="true"></i>
                                <span class="site-menu-title">Plans & Pricing</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection