@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        @if (session('success'))
            <div id="mydiv" class="head_accept"></div>
        @endif
        @if (session('exist'))
            <div id="mydiv" class="head_exist"></div>
            @endif
        @if (session('success_assigned'))
            <div id="mydiv" class="head_assigned"></div>
        @endif
            @if (session('success_deleted'))
            <div id="mydiv" class="head_deleted"></div>
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
        <div class="col-md-6">
            <div class="white-box analytics-info text-center">
                <h2>Change HeadMaster Status</h2>
                {!! Form::model($headname, ['route' => ['headmastermanage.update', 1],'method' => 'PUT','class'=> 'form-horizontal new-lg-form'],['data-parsley-validate' => '']) !!}
                <div class="form-group">
                    <div class="col-xs-12">
                        <select class="form-control" name="headmaster" required>
                            <option>Default</option>
                            @foreach($headname as $name)
                                @if($name->role['name'] == 'headmaster')
                                    <option value="{{$name->id}}">{{$name->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <select class="form-control" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary btn-block">Change</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="white-box analytics-info text-center">
                <h2>Assign School</h2>
                <form class="form-horizontal new-lg-form" method="POST" action="{{ route('headmastermanage.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-xs-12">
                            <select class="form-control" name="head_name" required>
                                @foreach($headname as $name)
                                    @if($name->role['name'] == 'headmaster')
                                        <option value="{{$name->id}}">{{$name->name}}
                                         @if(\App\HeadMasterProfile::where('user_id',$name->id)->count() > 0)
                                                <span class="label label-success m-l-5"> (Assigned)</span>
                                         @endif
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <select class="form-control" name="school" required>
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}">{{$school->school_name}}
                                        @if(\App\HeadMasterProfile::where('school_id',$school->id)->count() > 0)
                                            <span class="label label-success m-l-5"> (Assigned)</span>
                                        @endif
                                    </option>
                                 @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary btn-block">Assign</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Data Table</h3>
                <p class="text-muted m-b-30">Data table example</p>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Access</th>
                            <th>Status</th>
                            <th>School</th>
                            <th>Salary</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($headname as $name)
                            @if($name->role['name'] == 'headmaster')
                                <tr>
                                    <td>{{$name->name}}</td>
                                    <td>{{$name->email}}</td>
                                    <td>{{$name->phone}}</td>
                                    <td>
                                        @if($name->status == "inactive")
                                            <span class="label label-danger m-l-5">Inactive</span>
                                        @elseif($name->status == "active")
                                            <span class="label label-primary m-l-5">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(\App\HeadMasterProfile::where('user_id',$name->id)->count() > 0)
                                            <span class="label label-success m-l-5">Assigned</span>
                                           @else
                                            <span class="label label-info m-l-5">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(\App\HeadMasterProfile::where('user_id',$name->id)->count() > 0)
                                            {{\App\School::where('id',\App\HeadMasterProfile::where('user_id',$name->id)->pluck('school_id'))->get()->pluck('school_name')->first()}}
                                        @else
                                            <span class="label label-info m-l-5">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('headmastermanage.show',$name->id)}}" class="btn btn-instagram waves-effect btn-circle waves-light"><i class="ti-pencil-alt"></i></a>

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
                                                        {!! Form::open(['route' => ['headmastermanage.destroy', $name->id],'method' => 'DELETE']) !!}
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection