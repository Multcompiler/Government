
@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box analytics-info">
                <div class="white-box" style="height: 180px;">
                    <h3 class="box-title m-b-0 text-center" style="padding-bottom: 20px;">School Infos</h3>
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
                    <form class="form-horizontal new-lg-form" id="loginform" method="post" action="{{ route('login') }}">

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection