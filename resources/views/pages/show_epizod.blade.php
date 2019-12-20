@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$epizod->sezon->serial->name}} Epizod: {{$epizod->name}}</div>

                <div class="card-body">
                    <h1>{{$epizod->name}}</h1>
                    <img src="{{asset('storage/'.$epizod->logo_path)}}" width="50%">
                    <p>{{$epizod->release}}</p>
                    <p>{{$epizod->desc}}</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
