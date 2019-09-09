@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{url('file')}}" class="btn btn-outline-primary">Create New</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>File Download</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allDocs as $k=>$doc)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$doc->title}}</td>
                                <td><a download="" href="{{url('/files')}}/{{$doc->file_path}}">Click</a>

                                </td>
                                <td>
                                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#view{{$doc->id}}">
                                        Launch demo modal
                                    </button>
                                    <a href="{{url('file/delete',$doc->id)}}"
                                       class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="view{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">{{$doc->title}}</h4>
                                        </div>
                                        <div class="modal-body">
                                         {{--   <iframe src="{{url('/files')}}/{{$doc->file_path}}" width="595" height="485" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>--}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $allDocs->links()  }}
                </div>
            </div>
        </div>
    </div>
@endsection
