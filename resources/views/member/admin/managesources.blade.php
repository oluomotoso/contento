@extends('member.admin.default')
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
                <div class="col-md-6">
                    <form id="form" action="{{url('/admin/manage-sources')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Add Sources</h2>
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">URL<span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input type="url" name="url" class="form-control"
                                               placeholder="eg.: http://latestng.com"
                                               value="{{old('url')}}"
                                               required/>
                                    </div>
                                    <br>&nbsp;<br/>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Feed Type<span
                                                    class="required">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="feed_type" class="form-control">
                                                <option class="form-control" value="1">Normal</option>
                                                <option class="form-control" value="2">Job</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" name="add">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </form>
                </div>
                <!-- col-md-6 Add website or platform profiles on other platforms-->

                <div class="col-md-6">
                    <form id="form" action="{{url('/admin/manage-sources')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Manage Sources</h2>
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">All Sources <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <select name="datasource_id" class="form-control" required>
                                            @foreach($sources as $source)
                                                <option value="{{$source->id}}">{{$source->url}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" name="manage_feeds">Manage Feeds</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </form>
                </div>
                <div class="col-md-6">
                    <form id="form" action="{{url('/admin/manage-feeds')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Manage Feeds</h2>
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">All Sources <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <select name="datasource_id" class="form-control" required>
                                            @foreach($sources as $source)
                                                <option value="{{$source->id}}">{{$source->url}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Feed_Url <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input type="url" name="url" class="form-control"
                                               placeholder="eg.: http://latestng.com/sitemap.xml"
                                               value="{{old('feed')}}"
                                               required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Feed Type<span
                                                class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="feed_type" class="form-control">
                                            <option class="form-control" value="1">Normal</option>
                                            <option class="form-control" value="2">Job</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </form>
                </div>
                <div class="col-md-6">
                    <form id="form" action="{{url('/admin/update-cost')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Update Feed Cost</h2>
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">All Sources <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <select name="data[]" class="form-control" required multiple>
                                            @foreach($activated_feeds as $source)
                                                <option value="{{$source->id}}">{{$source->datasource->url}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input hidden name="type" value="source">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Feed Cost <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input type="number" name="cost" class="form-control"
                                               placeholder="5"
                                               value="{{old('cost')}}"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </form>
                </div>
                <div class="col-md-6">
                    <form id="form" action="{{url('/admin/update-cost')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Update Category Cost</h2>
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Categories <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <select name="data[]" class="form-control" required multiple>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input hidden name="type" value="category">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Category Cost <span
                                                class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input type="number" name="cost" class="form-control"
                                               placeholder="5"
                                               value="{{old('cost')}}"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->

@endsection