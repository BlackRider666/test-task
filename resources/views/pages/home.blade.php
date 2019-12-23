@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($serials as $serial)
                        <a href="{{route('serial.show',$serial->id)}}">
                            <div class="col-md">
                                <img src="{{asset('storage/'.$serial->logo_path)}}" width="150px">
                                <p>{{ $serial->name}}</p>
                            </div>
                        </a>
                        @endforeach
                        @if(Auth::check() && Auth::user()->admin == 1)
                        <a href="{{route('serial.create')}}" class="btn btn-primary"> Add Serial</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
