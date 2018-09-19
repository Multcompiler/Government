
@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="white-box analytics-info text-center">
                <h2>{{($school_info_check > 0) ? $school_name->school_name : ""}} School Teacher's</h2>
            </div>
        </div>

    </div>
    @if (session('success_teacher_added'))
        <div id="mydiv" class="success_teacher_added"></div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Errors!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($school_info_check > 0)
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="white-box analytics-info">
                    <form  action="{{route('add_teachers')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputuname">Firstname</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" name="firstname" class="form-control" id="exampleInputuname" placeholder="Firstname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lastname</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Lastname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputphone">Phone</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-mobile"></i></div>
                                <input type="text" name="phone" class="form-control" id="exampleInputphone" placeholder="Enter phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputphone">Gender</label>
                            <div class="input-group col-md-12">
                                <select class="form-control"  name="gender" required>
                                    <option value=""> -- Default -- </option>
                                    <option value="male"> Male </option>
                                    <option value="female"> Female </option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputphone">Studies</label>
                            <div class="input-group col-md-12">
                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="studies[]" data-placeholder="Choose" required>
                                    <option value=""> -- Default -- </option>
                                    @foreach($masomo as $mas)
                                        <option value="{{$mas->id}}">{{$mas->study_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputphone1">Class</label>
                            <div class="input-group col-md-12">
                                <select class="select3 m-b-10 select2-multiple" multiple="multiple" name="kidato[]" data-placeholder="Choose" required>
                                    <option value=""> -- Default -- </option>
                                    @foreach($kidato as $kd)
                                        <option value="{{$kd->id}}">{{$kd->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="school_id" value="{{$school_info->id}}">


                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                    </form>
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