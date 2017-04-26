@extends('member.user.default')
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/user/dashboard')}}">Dashboard</a></li>
                <li class="active">Manage Domains</li>
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

                        <div class="panel-body">
                            <div class="row">
                                @if($type == 1)
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center">Manage Wordpress</h3>

                                        <p class="text-success text-center">To add a wordpress site, Please download our <a href="https://wordpress.org/plugins/the-contento/">Wordpress Plugin</a> and follow the installation procedures</p>
                                        

                                    </div>
                                    <!--div class="panel-heading">
                                        <h3 class="panel-title text-center">Manage Domains</h3>
                                        <p class="info text-center">Kindly note that a domain cannot be removed or
                                            edited after
                                            submission</p>
                                        <p class="text-success text-center">You can
                                            add {{$subscription->number_of_domains - count($subscription->domain)}} more
                                            domain</p>

                                    </div>
                                    <form role="form" action="{{ url('/user/manage-domains') }}" method="post">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Subscription Name</label>
                                                <input class="form-control"
                                                       placeholder="http://insider.ng or http://oluomotoso.blogspot.com"
                                                       value="{{$subscription->name}}" readonly>
                                            </div>
                                            <input name="subscription" value="{{$subscription->id}}" hidden>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Domain URL</label>
                                                <input class="form-control"
                                                       placeholder="http://insider.ng"
                                                       value="{{old('url')}}" type="url" name="url">
                                            </div>
                                        </div>
                                        <input name="platform" value="1" hidden>
                                        {{csrf_field()}}
                                        <button type="submit" name="submit_new"
                                                class="btn btn-default center-block">
                                            Submit
                                            Button
                                        </button>
                                    </form-->


                                @elseif($type ==2)
                                    @if(count($user->api_data)==0)
                                        <p class="text-center">You have not linked any blogger account yet. click
                                            <a href="{{url('/user/link-to-google?oauth')}}">
                                                <button class="btn btn-primary">here</button>
                                            </a>
                                            to link
                                        </p>
                                    @else
                                        <p class="info text-center">Kindly note that a domain cannot be removed or
                                            edited after
                                            submission</p>
                                        <p class="text-success text-center">You can
                                            add {{$subscription->number_of_domains - count($subscription->domain)}} more
                                            domain</p>
                                        <form role="form" action="{{ url('/user/manage-domains') }}" method="post">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Domain
                                                        <select class="form-control" name="domain">
                                                            @foreach($blogs as $blog)
                                                                <option value="{{$blog->id}}">{{$blog->url}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                                <input name="subscription" value="{{$subscription->id}}" hidden>
                                                {{csrf_field()}}
                                                <button type="submit" name="submit_blogger"
                                                        class="btn btn-default center-block">
                                                    Add
                                                    Domain
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-center">Can't find the domain you're looking for?
                                                    <a href="{{url('/user/link-to-google?oauth')}}">
                                                        <button class="btn btn-primary">Click here</button>
                                                    </a>
                                                    to update Blogs
                                                </p>
                                            </div>
                                        </form>
                                    @endif
                                @else
                                    <form role="form" action="{{ url('/user/manage-domains') }}" method="post">

                                        <div class="col-md-5">
                                            <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                            <input type="hidden" name="type" value="1">
                                            <button type="submit"
                                                    class="btn btn-default center-block">
                                                Add
                                                Wordpress site
                                            </button>
                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                    <div class="col-md-2">
                                        <hr/>
                                    </div>
                                    <form role="form" action="{{ url('/user/manage-domains') }}" method="post">

                                        <div class="col-md-5">
                                            <input name="subscription" value="{{$subscription->id}}" type="hidden">
                                            <input type="hidden" name="type" value="2">
                                            <button type="submit"
                                                    class="btn btn-default center-block">
                                                ADD
                                                Blogger
                                            </button>
                                        </div>
                                        {{csrf_field()}}

                                    </form>
                                @endif
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