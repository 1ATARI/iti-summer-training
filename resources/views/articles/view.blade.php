@extends('layout.app')


@section('title')
    {{$article->title}}
@endsection


@section('page-header')


@endsection
@section('content')
    <div class="col-xl-12 mb-30">

        <div class="card-body">


            @if ($errors->any())
                {{--                        <div class="alert alert-danger">--}}
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <header style="text-align: center;">
                <h1>{{$article->title}}</h1>
                <hr >
            </header>
            <br><br>
            <img src="{{asset('uploads/' . $article->image)}}" width="400" height="400" class="centerq">

            <br><br><br>
            <div class="centerq">
                <p>{!! $article->body!!}</p>
            </div>
        </div>
        <div class="text-right">
            <a class="btn btn-lg btn-primary" href="{{route('article.index')}}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

        </div>
    </div>



@endsection
