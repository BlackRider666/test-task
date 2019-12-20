@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sezon {{$sezon->serial->name}}</div>

                <div class="card-body">
                    <img src="{{asset('storage/'.$sezon->logo_path)}}" width="50%">
                    <p>{{$sezon->start}} -- {{$sezon->finish}}</p>
                    <p>{{$sezon->desc}}</p>
                    <hr>
                    @if($sezon->epizods->count() > 0)
                    <h3>Epizods</h3>
                    <hr>
                    @foreach($sezon->epizods as $epizod)
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('epizod.show',$epizod->id)}}"><img src="{{asset('storage/'.$epizod->logo_path)}}" width="100%"></a>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    @endif
                    @if(Auth::check() && Auth::user()->admin == 1)
                    <a href="{{route('epizod.create',$sezon->id)}}" class="btn btn-primary"> Add Epizod</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
