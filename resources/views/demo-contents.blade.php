@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>LATEST CONTENTO</h3>
                @foreach ($contents as $content)
                    <p class="text-bold">
                        <a target="_blank" href="{{url('content/'.$content->id.'/'.csrf_token())}}">{{ $content->title}}</a><br/><i>by {{$content->datasources_feed->Datasource->url. ' '.$content->updated_at->diffForHumans()}}</i>
                    </p>

                @endforeach
                <p>{!! $contents->render() !!}</p>
            </div>

        </div>
    </div>

@endsection