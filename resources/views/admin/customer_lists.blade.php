@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $k=>$customer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $customers->links()  }}
                </div>
            </div>
        </div>
    </div>

@endsection
