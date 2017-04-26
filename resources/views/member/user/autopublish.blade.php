@extends('member.user.default')
@section('content')
    <!-- Page -->
    <div class="page animsition">
        <div class="page-header">
            <ol class="breadcrumb">
                <li><a href="{{url('/user/dashboard')}}">Dashboard</a></li>
                <li class="active">MANAGE AUTOPUBLISHING FOR {{$subscription->domain[0]->user_domain->url}}</li>
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
                <div class="col-md-12">
                    <form role="form" method="post" action="{{url('/user/update-autopublish')}}">
                        <input name="domain" value="{{$domain}}" type="hidden">
                        <input name="subscription" value="{{$subscription->id}}" type="hidden">
                        @for ($i = 0; $i < count($parameters); $i++)
                            @if($subscription->is_category == true)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Identifier</label>
                                        <input class="form-control"
                                               value="{{$parameters[$i]->category->category}}" readonly>
                                        <input value="{{$parameters[$i]->category_id}}" name="identifier{{$i}}"
                                               type="hidden">
                                    </div>


                                    <div class="form-group">
                                        @if($publish[$i]->publish_all == true)
                                            <label><input type="checkbox" name="publish[]" checked>Publish all posts
                                                automatically</label>
                                        @else
                                            <label><input type="checkbox" name="publish[]">Publish all posts
                                                automatically</label>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Type keywords to publish if present in an article title, separate each by
                                            comma. Do
                                            not
                                            type anything here if you marked publish all</label>
                                        <textarea class="form-control"
                                                  name="keywords[]">{{$publish[$i]->parameters}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        @if($publish[$i]->to_draft == true)
                                            <label><input type="checkbox" name="is_draft[]" checked>Publish as Draft</label>
                                        @else
                                            <label><input type="checkbox" name="is_draft[]">Publish as Draft</label>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Identifier</label>
                                        <input class="form-control"
                                               value="{{$parameters[$i]->feed->datasource->url}}" readonly>
                                        <input value="{{$parameters[$i]->feed_id}}" name="identifier[]"
                                               type="hidden">

                                    </div>
                                    <div class="form-group">
                                        @if($publish[$i]->publish_all == true)
                                            <label><input type="checkbox" name="publish[]" checked>Publish all posts
                                                automatically</label>
                                        @else
                                            <label><input type="checkbox" name="publish[]">Publish all posts
                                                automatically</label>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Type keywords to publish if present in an article title, separate each by
                                            comma. Do
                                            not
                                            type anything here if you marked publish all</label>
                                        <textarea class="form-control"
                                                  name="keywords[]">{{$publish[$i]->parameters}}</textarea>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        @if($publish[$i]->to_draft == true)
                                            <label><input type="checkbox" name="is_draft[]" checked>Publish as Draft</label>
                                        @else
                                            <label><input type="checkbox" name="is_draft[]">Publish as Draft</label>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        @endfor
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary center-block">Submit Button
                            </button>

                        </div>
                    </form>
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