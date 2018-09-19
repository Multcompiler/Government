<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span>
            </h3></div>
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="{{asset('images/user.png')}}" alt="user-img" class="img-circle"></div>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            @if(Auth::check() && Auth::user()->role['name'] == 'admin')
                <li><a href="{{route('admin_profile')}}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw"></i>
                        <span class="hide-menu"> My Profile </span></a>
                </li>
                <li>
                    <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i>
                        <span class="hide-menu">Users Manage<span class="fa arrow"></span>
                    </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('add_user')}}"><i data-icon="&#xe026;"
                                                               class="linea-icon linea-basic fa-fw"></i> <span
                                        class="hide-menu">Add User</span></a></li>
                        <li><a href="{{route('view_user')}}"><i data-icon="&#xe025;"
                                                                class="linea-icon linea-basic fa-fw"></i> <span
                                        class="hide-menu">View User</span></a></li>
                    </ul>
                </li>
                @elseif(Auth::check() && Auth::user()->role['name'] == 'headmaster')
                <li><a href="{{route('head_master_profile')}}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw"></i>
                        <span class="hide-menu"> My Profile </span></a>
                </li>
                <li><a href="{{route('schoolmanage')}}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw"></i>
                        <span class="hide-menu"> Add School </span></a>
                </li>
                <li>
                    <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i>
                        <span class="hide-menu">School Requirement<span class="fa arrow"></span>
                    </span>
                    </a>
                    <ul class="nav nav-second-level">

                        <li><a href="{{route('add_school_requirement')}}"><i data-icon="&#xe026;"
                                                                             class="linea-icon linea-basic fa-fw"></i> <span
                                        class="hide-menu">Add Requirements</span></a>
                        </li>
                        <li><a href="{{route('view_school_requirements')}}"><i data-icon="&#xe025;"
                                                                               class="linea-icon linea-basic fa-fw"></i>
                                <span class="hide-menu">View Requirements</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i>
                        <span class="hide-menu">Teachers Manage<span class="fa arrow"></span>
                    </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('add_new_teacher')}}"><i data-icon="&#xe026;"
                                                                      class="linea-icon linea-basic fa-fw"></i> <span
                                        class="hide-menu">Add New Teacher</span></a></li>
                        <li><a href="{{route('view_all_teachers')}}"><i data-icon="&#xe025;"
                                                                        class="linea-icon linea-basic fa-fw"></i> <span
                                        class="hide-menu">View Teachers</span></a></li>
                    </ul>
                </li>
                @elseif(Auth::check() && Auth::user()->role['name'] == 'district_officer')
                <li><a href="{{route('district_officer_profile')}}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw"></i>
                        <span class="hide-menu"> My Profile </span></a>
                </li>


                <li>
                    <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i>
                        <span class="hide-menu">Schools Information's<span class="fa arrow"></span>
                    </span>
                    </a>
                    <ul class="nav nav-second-level">

                        @foreach(\App\Region::all() as $region)
                            <li>
                                <a href="#" class="waves-effect">
                                    <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                                    <span class="hide-menu">{{$region->name}}<span class="fa arrow"></span>
                            </span>
                                </a>
                                <ul class="nav nav-second-level">

                                    @foreach(\App\District::where("region_id",$region->id)->get() as $district)
                                        <li>
                                            <a href="#" class="waves-effect">
                                                <i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i>
                                                <span class="hide-menu">{{$district->name}}<span class="fa arrow"></span>
                                  </span>
                                            </a>
                                            <ul class="nav nav-second-level">
                                                @foreach(\App\Ward::where("district_id",$district->id)->get() as $ward)
                                                    <li>

                                                        <a href="#" class="waves-effect">
                                                            <i data-icon="7" class="linea-icon linea-basic fa-fw"></i>
                                                            <span class="hide-menu">{{$ward->name}}<span
                                                                        class="fa arrow"></span>
                                         </span>
                                                        </a>
                                                        <ul class="nav nav-second-level">
                                                            @foreach(\App\School::where("ward_id",$ward->id)->get() as $schools)
                                                                <li><a href="{{url('DistrictOfficer/View/'.$schools->id.'/School/'.$schools->school_name)}}">
                                                                        <i data-icon="&#xe026;"
                                                                           class="linea-icon linea-basic fa-fw"></i>
                                                                        <span class="hide-menu">{{$schools->school_name}}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>

                                    @endforeach
                                </ul>
                            </li>
                        @endforeach


                    </ul>
                </li>
                @else

                @endif



        </ul>
    </div>
</div>