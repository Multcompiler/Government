<nav class="navbar navbar-default navbar-static-top m-b-0">
    @if(Auth::check())
    <div class="navbar-header">
        <div class="top-left-part text-center">
            <!-- Logo -->
            <a href="{{route('homepage')}}" style="color: black;font-family: 'Times New Roman';">
                <!-- Logo icon image, you can use font-icon also --><b>
                    GRCS
                    </b>
            </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>

            <!-- /.Megamenu -->
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">

            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <img src="{{asset('images/user.png')}}" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</b>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="{{asset('images/user.png')}}" alt="user" /></div>
                            <div class="u-text" style="margin-top: 10px;">
                                <h4>{{Auth::user()->name}}</h4>
                                @if(Auth::user()->role['name'] == 'admin')
                                <a href="{{route('admin_profile')}}" class="btn btn-rounded btn-danger btn-sm" style="margin-top: 10px;">View Profile</a>
                                @elseif(Auth::user()->role['name'] == 'district_officer')
                                    <a href="{{route('district_officer_profile')}}" class="btn btn-rounded btn-danger btn-sm" style="margin-top: 10px;">View Profile</a>
                                @elseif(Auth::user()->role['name'] == 'headmaster')
                                    <a href="{{route('head_master_profile')}}" class="btn btn-rounded btn-danger btn-sm" style="margin-top: 10px;">View Profile</a>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
        @else
        <div class="navbar-header">
            <div class="top-left-part text-center">
                <!-- Logo -->
                <a href="{{route('homepage')}}" style="color: black;font-family: 'Times New Roman';">
                    <!-- Logo icon image, you can use font-icon also --><b>
                        GRCS
                    </b>
                </a>
            </div>
            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>

                <!-- /.Megamenu -->
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img src="{{asset('images/user.png')}}" alt="user-img" width="36" class="img-circle">
                        <b class="hidden-xs">Guest</b><span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        {{--<li><a href="/register"><i class="ti-user"></i> Register</a></li>--}}
                        <li role="separator" class="divider"></li>
                        <li><a href="/login"><i class="fa fa-power-off"></i> Login</a></li>


                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </div>
    @endif
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>