
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
{{--                <ul class="menu-nav">--}}
{{--                    <li class="menu-item menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">--}}
{{--                        <a href="javascript:;" class="menu-link menu-toggle">--}}
{{--                            <span class="menu-text">Pages</span>--}}
{{--                            <i class="menu-arrow"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">

            <!--begin::My Cart-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">{{ substr(Auth::user()
                        ->name,0,1) }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md dropdown-menu-anim-up">
                    <form>
                        <!--begin::Header-->
                        <div class="d-flex align-items-center py-10 px-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{ asset('') }}theme/assets/media/misc/bg-1.jpg)">
                                <span class="btn btn-md btn-icon bg-white-o-15 mr-4">
                                    <i class="flaticon2-user text-success"></i>
                                </span>
                            <h4 class="text-white m-0 flex-grow-1 mr-3">{{ auth()->user()->name}}</h4>
{{--                            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">Sign Out</a>--}}
{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
                        </div>
                        <!--end::Header-->
                        <!--begin::Content-->
                        <div class="tab-content">
                            <!--begin::Tabpane-->
                            <div class="tab-pane active show p-5" id="topbar_notifications_notifications"
                                 role="tabpanel">
                                <!--begin::Scroll-->
                                <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="auto"
                                     data-mobile-height="auto">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-6">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                    <i class="flaticon2-settings text-success"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column font-weight-bold">
                                            <a onclick="munculkanModalProfile()" class="text-dark text-hover-primary mb-1 font-size-lg">Change Password</a>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    @if (auth()->user()->role =='tes')
                                    
                                    <div class="d-flex align-items-center mb-6">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-warning mr-5">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                    <i class="flaticon2-user-1 text-success"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column font-weight-bold">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1
                                            font-size-lg">Profile</a>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    @endif
                                    <!--end::Item-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Action-->
                                <div class="d-flex flex-center pt-7">
                                    <a href="{{ route('logout') }}" class="btn btn-danger font-weight-bold"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Tabpane-->
                        </div>
                        <!--end::Content-->
                    </form>
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::My Cart-->
            <!-- form profile -->
            <!-- end form profile -->
            <!--begin::User-->
{{--            <div class="topbar-item">--}}
{{--                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">--}}
{{--                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>--}}
{{--                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>--}}
{{--                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">--}}
{{--                        <span class="symbol-label font-size-h5 font-weight-bold">{{ substr(Auth::user()--}}
{{--                        ->name,0,1) }}</span>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
