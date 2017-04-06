@extends('member.default')

@section('topbar')
    <div class="site-menubar site-menubar-light">
        <div class="site-menubar-body">
            <div>
                <div>
                    <ul class="site-menu">
                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="{{url('/admin/dashboard')}}" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                                <span class="site-menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="{{url('/user/create-subscription')}}" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-arrow-right" aria-hidden="true"></i>
                                <span class="site-menu-title">Create Subscription</span>
                            </a>
                        </li>
                        <li class="dropdown site-menu-item has-section has-sub">
                            <a class="dropdown-toggle" href="{{url('/admin/subscriptions')}}"
                               data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                                <span class="site-menu-title">Subscriptions</span>

                            </a>

                        </li>

                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                                <span class="site-menu-title">User Management</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="site-menu-scroll-wrap is-list">
                                    <div>
                                        <div>
                                            <ul class="site-menu-sub site-menu-normal-list">

                                                <li class="site-menu-item">
                                                    <a class="animsition-link" href="{{url('/admin/manage-users')}}">
                                                        <span class="site-menu-title">Manage Users</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                                <span class="site-menu-title">General Management</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="site-menu-scroll-wrap is-list">
                                    <div>
                                        <div>
                                            <ul class="site-menu-sub site-menu-normal-list">
                                                <li class="site-menu-item">
                                                    <a class="animsition-link"
                                                       href="{{url('/admin/site-wide-notification')}}">
                                                        <span class="site-menu-title">Sitewide Notification</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown site-menu-item has-sub">
                            <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                                <i class="site-menu-icon wb-grid-4" aria-hidden="true"></i>
                                <span class="site-menu-title">Administrator</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="site-menu-scroll-wrap is-list">
                                    <div>
                                        <div>
                                            <ul class="site-menu-sub site-menu-normal-list">
                                                <li class="site-menu-item">
                                                    <a class="animsition-link" href="{{url('/admin/manage-sources')}}">
                                                        <span class="site-menu-title">Manage Sources</span>
                                                    </a>
                                                </li><li class="site-menu-item">
                                                    <a class="animsition-link" href="{{url('/admin/manage-feeds')}}">
                                                        <span class="site-menu-title">Manage Feeds</span>
                                                    </a>
                                                </li><li class="site-menu-item">
                                                    <a class="animsition-link" href="{{url('/admin/site-settings')}}">
                                                        <span class="site-menu-title">Site Settings</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection