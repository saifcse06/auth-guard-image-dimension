@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{url('image')}}" class="btn btn-outline-primary">Create New</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allImages as $k=>$image)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$image->title}}</td>
                                <td><img width="200" height="100" src="{{url('/images')}}/{{$image->file_path}}"></td>
                                <td>
                                    <form method="GET" action="{{ url('image/preview') }}">
                                        <input type="hidden" name="w" value="1000">
                                        <input type="hidden" name="img" value="{{$image->file_path}}">
                                         <button type="submit" class="btn btn-success">Preview</button>

                                  </form>
                                    <a href="{{url('file/delete',$image->id)}}"
                                       class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $allImages->links()  }}
                </div>
            </div>
        </div>
    </div>
@endsection
