@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        @if (session('success_teacher_deleted'))
            <div id="mydiv" class="success_teacher_deleted"></div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Errors!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @if($schools_check > 0)
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Data Table</h3>
                <p class="text-muted m-b-30">Data table example</p>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>School Name</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Studies</th>
                            <th>Teaches</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $name)

                                <tr>
                                    <td>{{$schools->school_name}}</td>
                                    <td>{{$name->firstname}}</td>
                                    <td>{{$name->lastname}}</td>
                                    <td>{{$name->gender}}</td>
                                    <td>{{$name->phone}}</td>
                                    <td>
                                        @foreach($name->study as $tag)
                                            <span class="label label-primary">{{$tag->study_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($name->kidato as $tag1)
                                            <span class="label label-info">{{$tag1->class_name}}</span>
                                        @endforeach
                                    </td>


                                    <td>
                                        <button class="btn btn-pinterest waves-effect btn-circle waves-light" type="button" data-toggle="modal" data-target="#exampleModal{{$name->id}}"><i class="icon-trash"></i></button>

                                        <div class="modal fade" id="exampleModal{{$name->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel1">Delete Alert</h4> </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this User ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['route' => ['teacher_delete', $name->id],'method' => 'DELETE']) !!}
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <p>Register School Information first</p>
            </div>
        </div>
    </div>
    @endif
@endsection