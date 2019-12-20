@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Epizod</div>

                <div class="card-body">
                    <form action="{{route('epizod.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sezon_id" value="{{$sezon_id}}">
                        <div class="form-group">
                            <label for="serialName">Name</label>
                            <input type="text" class="form-control" id="serialName" placeholder="Enter name serial" name="name">
                        </div>
                        <div class="form-group">
                            <label for="serialLogo">Logo</label>
                            <input type="file" class="form-control" id="serialLogo" name="logo">
                        </div>
                        <div class="form-group">
                            <label for="serialDesc">Desc</label>
                            <textarea name="desc" class="form-control" id="serialDesc" placeholder="Enter serial desc">                             
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="serialStart">Release</label>
                            <input type="date" class="form-control" id="serialStart" name="release">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
