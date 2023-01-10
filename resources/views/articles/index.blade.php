@extends('layout.app')


@section('title')
    Article
@endsection


@section('page-header')

    Article
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



            <a href="{{route('article.create')}}" class="btn btn-primary">
                <i class="fas fa-plus-square fa-fw"></i>

                Create Article</a>
            <br><br>


            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <th>#</th>
                <th>title</th>
                <th>description</th>
                <th>image</th>
                <th>created by</th>
                <th>date of creation</th>
                <th>Actions</th>

                </thead>


                <tbody>
                @foreach($articles as $index=>$article)
                    <tr>

                        <td>{{$index+1}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->description}}</td>
                        <td><img src="{{asset( 'uploads/' . $article->image)}}" width="100" height="100" class="img-thumbnail"></td>
                        <td>{{$article->user->first_name . ' ' . $article->user->last_name}}</td>
                        <td>{{$article->created_at->toFormattedDateString()}}</td>

                        <td class="project-actions text-left">

                            <a class="btn btn-primary btn-sm" href="{{route('article.show' , $article->id)}}">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            @if(auth()->user()->id == $article->user_id)





                                <a class="btn btn-info btn-sm"
                                   href="{{route('article.edit' , $article->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i> Edit</a>


                                <button type="button" class="btn delete btn-danger btn-sm" href="#"
                                        data-toggle="modal" data-target="#delete{{$article->id}}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </button>


                                <form action="{{route('article.destroy', $article->id) }}"
                                      method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}

                                    <div class="modal fade" id="delete{{$article->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><i
                                                            class="icon fas fa-exclamation-triangle"></i>Confirm
                                                        Delete</h4>
                                                    <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want delete
                                                        "{{$article->title}}"</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">

                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal"
                                                            style="background-color:rgba(0,0,0,.03)">
                                                        Close
                                                    </button>


                                                    <button type="submit"
                                                            class="btn delete btn-danger">Confirm
                                                    </button>

                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </form>
                            @else



                                <a class="btn btn-info btn-sm disabled" href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i> Edit</a>
                                <a class="btn btn-danger btn-sm disabled" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>


@endsection

