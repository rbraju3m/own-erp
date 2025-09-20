<div class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-logo"><img src="{{ asset('Appza.png') }}" width="75%" alt=""></a>
    </div>
    <!-- sidebar-header -->
    <div class="sidebar-search">
        <div class="search-body">
            <i data-feather="home"></i>
            <a href="" style="color: #000000b3">Dashboard</a>
        </div><!-- search-body -->
    </div><!-- sidebar-search -->
    <div class="sidebar-body pt-20">

        @if(auth()->user()->user_type === 'DEVELOPER' || auth()->user()->user_type === 'ADMIN')
        @endif



            <div class="nav-group {{ Request::is('erp/role/list/*') ? 'show' : ''}}">
                <div class="nav-group-label" style="font-size: 15px !important;">{{__('messages.UserManage')}}</div>
                <ul class="nav-sidebar">
                    <li class="nav-item ">
                        <a href="{{route('role_list')}}" class="nav-link {{ Request::is('erp/role/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('messages.Role')}}</span></a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('user_list')}}" class="nav-link {{ Request::is('erp/user/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('messages.User')}}</span></a>
                    </li>
                </ul>
            </div>

        @if(auth()->user()->user_type === 'DEVELOPER')
            <div class="nav-group {{ Request::is('erp/request-log/*') ? 'show' : ''}}">
                <div class="nav-group-label" style="font-size: 15px !important;">{{__('messages.RequestLog')}}</div>
                <ul class="nav-sidebar">
                    <li class="nav-item ">
                        <a href="{{route('request_log_list')}}" class="nav-link {{ Request::is('erp/request-log/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('messages.RequestLogList')}}</span></a>
                    </li>
                </ul>
            </div>
        @endif


    </div>


    <div class="sidebar-footer">
        <a href="" class="avatar online"><span class="avatar-initial" style="font-size: 15px;">
                <img src="{{asset('Fav.svg')}}" alt="">
            </span></a>
        <div class="avatar-body">
            <div class="d-flex align-items-center justify-content-between">
                <h6>{{auth()->user()?auth()->user()->name:''}}</h6>
                <a href="" class="footer-menu"><i class="ri-settings-4-line"></i></a>
            </div>

        </div><!-- avatar-body -->
    </div><!-- sidebar-footer -->
</div>

