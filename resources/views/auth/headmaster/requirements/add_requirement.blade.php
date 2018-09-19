@extends('main')

@section('title', '| Home')

@section('content')
    @if (session('success_requirement_added'))
        <div id="mydiv" class="success_requirement_added"></div>
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
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="white-box analytics-info">
                @if($school_check > 0)
                <div class="row">
                    <div class="col-sm-6">
                        <span class="username"  style="padding-top: 5px;font-size: 20px;margin-left:0px;">
                             Add School Requirements:
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <span style="float: right;">
                              <button type="button" value="Add a field" class="add btn btn-info" id="add_requirement"
                                     style="border-radius: 10px;">
                                     <i class="fa fa-plus"></i>
                           </button>
                        </span>
                    </div>
                </div>

                <form action="{{route('add_all_school_requirement')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $school->id }}" name="school_id">
                        <p id="buildyourform" style="margin: 5px 0 5px 0;">
                        </p>
                    <div class="white-box analytics-info">
                        <div class="row">
                        <div class="col-md-12">
                            <div id="result1"></div>
                        </div>
                        </div>
                    </div>
                </form>
                @else
                    <p>Add school Information First</p>
                    @endif
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="white-box analytics-info">
                @if($school_check > 0)
                    <div class="row">
                        <div class="col-sm-6">
                        <span class="username"  style="padding-top: 5px;font-size: 20px;margin-left:0px;">
                             Add Teachers/Students Total:
                        </span>
                        </div>
                        <div class="col-sm-6">
                        <span style="float: right;">
                              <button type="button" value="Add a field" class="add btn btn-info" id="add_school"
                                      style="border-radius: 10px;">
                                     <i class="fa fa-plus"></i>
                           </button>
                        </span>
                        </div>
                    </div>

                    <form action="{{route('add_users_total')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $school->id }}" name="school_id">
                        <p id="buildyourform1" style="margin: 5px 0 5px 0;">
                        </p>
                        <div class="white-box analytics-info">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="result11"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <p>Add school Information First</p>
                @endif
            </div>

        </div>
    </div>

@endsection