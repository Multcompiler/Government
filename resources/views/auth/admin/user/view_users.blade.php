@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        @if (session('success_user_update'))
            <div id="mydiv" class="success_user_update"></div>
        @endif
            @if (session('success_user_deleted'))
            <div id="mydiv" class="success_user_deleted"></div>
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
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
            <select name="role" id="role_check" class="form-control">
                <option value=""> -- Default -- </option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{ucfirst($role->name)}} </option>
                @endforeach
            </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">System Users</h3>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Access</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $name)

                                <tr>
                                    <td>{{$name->firstname}}</td>
                                    <td>{{$name->lastname}}</td>
                                    <td>{{$name->gender}}</td>
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
                                        <button class="btn btn-instagram waves-effect btn-circle waves-light" type="button"
                                                data-toggle="modal" data-target="#exampleModall{{$name->id}}">
                                            <i class="ti-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-pinterest waves-effect btn-circle waves-light" type="button"
                                                data-toggle="modal" data-target="#exampleModal{{$name->id}}">
                                            <i class="icon-trash"></i>
                                        </button>


                                    </td>
                                </tr>

                                <div class="modal fade" id="exampleModall{{$name->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="exampleModalLabel1">Edit Alert</h4> </div>
                                            <div class="modal-body">
                                                {!! Form::model($name, ['route' => ['edit_users', $name->id],'method' => 'PUT'],['data-parsley-validate' => '']) !!}

                                                <div class="modal-body">
                                                    <input type="hidden" name="user_id" value="{{$name->id}}">
                                                    <div class="input-group col-md-12">
                                                        <label for="firstname" class="control-label">Firstname:</label>
                                                        {{ Form::text('firstname',null, array('class' => 'form-control','id'=>'firstname')) }}
                                                    </div>
                                                    <br/>
                                                    <div class="input-group col-md-12">
                                                        <label for="lastname" class="control-label">Lastname:</label>
                                                        {{ Form::text('lastname',null, array('class' => 'form-control','id'=>'lastname')) }}
                                                    </div>
                                                    <br/>
                                                    <div class="input-group col-md-12">
                                                        <label for="" class="control-label">Gender:</label>
                                                        <select name="gender" class="form-control" required>
                                                            <option value=""> -- Default --</option>
                                                            <option value="male"> Male </option>
                                                            <option value="female"> Female </option>
                                                        </select>
                                                    </div>
                                                    <br/>
                                                    <div class="input-group col-md-12">
                                                        <label for="email" class="control-label">Email:</label>
                                                        {{ Form::text('email',null, array('class' => 'form-control','id'=>'email')) }}
                                                    </div>
                                                    <br/>
                                                    <div class="input-group col-md-12">
                                                        <label for="phone" class="control-label">Phone:</label>
                                                        {{ Form::text('phone',null, array('class' => 'form-control','id'=>'phone')) }}
                                                    </div>
                                                    <br/>
                                                    <div class="input-group col-md-12">
                                                        <label for="" class="control-label">Status:</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value=""> -- Default --</option>
                                                            <option value="active"> Active </option>
                                                            <option value="inactive"> Inactive </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes
                                                    </button>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
                                                {!! Form::open(['route' => ['delete_profile_user', $name->id],'method' => 'DELETE']) !!}
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>

                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection