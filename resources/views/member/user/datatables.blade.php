@extends('member.datatables')

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
                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-payment" aria-hidden="true"></i>
                                <span class="site-menu-title">Create Subscriptions</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="site-menu-scroll-wrap is-list">
                                    <div>
                                        <div>
                                            <ul class="site-menu-sub site-menu-normal-list">

                                                <li class="site-menu-item">
                                                    <a class="animsition-link"
                                                       href="{{url('/user/create-subscription-category')}}">
                                                        <span class="site-menu-title">By Category</span>
                                                    </a>
                                                </li>
                                                <li class="site-menu-item">
                                                    <a class="animsition-link"
                                                       href="{{url('/user/create-subscription')}}">
                                                        <span class="site-menu-title">By Source</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown site-menu-item has-section has-sub">
                            <a class="dropdown-toggle" href="{{url('/user/manage-subscriptions')}}"
                               data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                                <span class="site-menu-title">Manage Subscriptions</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection