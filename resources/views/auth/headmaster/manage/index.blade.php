
@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="white-box analytics-info">
                <div class="white-box" style="height: 180px;">
                    <h3 class="box-title m-b-0 text-center" style="padding-bottom: 20px;">Select A School</h3>
                    @if (session('success'))
                        <div id="mydiv" class="success_register"></div>
                    @elseif (session('approval'))
                        <div id="mydiv" class="wait_confirm"></div>
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
                    <form class="form-horizontal new-lg-form" id="loginform" method="post" action="{{ route('schoolrequrements.show',Auth::user()->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group  m-t-20{{ $errors->has('email') ? ' has-error' : '' }}{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <select class="form-control" id="school_id">
                                    <option value="">Default</option>
                                    @foreach($schools as $school)
                                        <option value="{{$school->id}}">{{$school->school_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection