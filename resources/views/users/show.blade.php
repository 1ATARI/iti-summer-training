@extends('layout.app')


@section('title')
    Profile
@endsection


@section('page-header')
    welcome :
{{$user->first_name}} {{$user->last_name}}



@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <strong><i class="fas fa-user mr-1"></i>First Name</strong>

            <p class="text-muted">
                {{$user->first_name}}
            </p>

            <hr>
            <strong><i class="fas fa-user mr-1"></i>Last Name</strong>

            <p class="text-muted">
                {{$user->last_name}}
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">{{$user->address}}</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Birth Date</strong>

            <p class="text-muted">
                    {{$user->birth_date}}
            </p>

            <hr>

            <strong><i class="far fa-envelope mr-1"></i> Email Adress</strong>

            <p class="text-muted">{{$user->email}}</p>
        </div>
        <!-- /.card-body -->




        <br>
    </div>





@endsection
