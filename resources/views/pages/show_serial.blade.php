@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$serial->name}}</div>

                <div class="card-body">
                    <h1>{{$serial->name}}</h1>
                    <img src="{{asset('storage/'.$serial->logo_path)}}" width="150px">
                    <p>{{$serial->start}}</p>
                    <p>{{$serial->desc}}</p>
                    <hr>
                    @if($serial->sezons->count() > 0)
                    <h3>Seasons</h3>
                    <hr>
                    @foreach($serial->sezons as $sezon)
                    <div class="row">
                        <div class="col-md">
                            <a href="{{route('sezon.show',$sezon->id)}}"><img src="{{asset('storage/'.$sezon->logo_path)}}" width="150px"></a>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    @endif
                    @if(Auth::check() && Auth::user()->admin == 1)
                    <a href="{{route('sezon.create',$serial->id)}}" class="btn btn-primary"> Add Sezon</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
