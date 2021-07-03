<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="#" class="brand-logo">
            <h3 style="color: WHITE">MEDIKA CLINIC</h3>
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">

                <li class="menu-item" aria-haspopup="true">
                    <a href="{{url('/dashboard')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                              <i class="flaticon-home-1 @stack('dashboard')"></i>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">Main</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>


{{--                    <li class="menu-item menu-item-submenu @stack($menu->url)" aria-haspopup="true"--}}
{{--                        data-menu-toggle="hover">--}}

{{--                        <a href="javascript:;" class="menu-link menu-toggle">--}}
{{--                        <span class="svg-icon menu-icon">--}}
{{--                            <i class="{{ $menu->icon }}"></i>--}}
{{--                        </span>--}}
{{--                            <span class="menu-text">{{ $menu->name }}</span>--}}
{{--                            <i class="menu-arrow"></i>--}}
{{--                        </a>--}}

{{--                        <div class="menu-submenu">--}}
{{--                            <i class="menu-arrow"></i>--}}
{{--                            <ul class="menu-subnav">--}}
{{--                                <li class="menu-item menu-item-parent" aria-haspopup="true">--}}
{{--                                <span class="menu-link">--}}
{{--                                    <span class="menu-text">{{ $menu->name }}</span>--}}
{{--                                </span>--}}
{{--                                </li>--}}
{{--                                @foreach(Helper::sub_menu($menu->id) as $menu1)--}}
{{--                                    <li class="menu-item" aria-haspopup="true">--}}
{{--                                        <a href="{{ url($menu1->url) }}" class="menu-link">--}}
{{--                                            <i class="menu-bullet menu-bullet-line">--}}
{{--                                                <span></span>--}}
{{--                                            </i>--}}
{{--                                            <span class="menu-text">{{ $menu1->name }}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}

{{--                    </li>--}}
                    @if (auth()->user()->role =='admin')
                    <li class="menu-item menu-item-submenu @stack('data-master')" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="flaticon2-delivery-package "></i>
                            </span>
                            <span class="menu-text">Data Master</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Data Master</span>
                                </span>
                                </li>
                                <li class="menu-item  {{ request()->is('user') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/user') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">User</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ request()->is('poli') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/poli') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Poli</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ request()->is('dokter') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/dokter') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Dokter</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ request()->is('pasien') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/pasien') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Pasien</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ request()->is('jadwal') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/jadwal') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Jadwal</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    <li class="menu-item menu-item-submenu @stack('pemeriksaan')" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="flaticon-suitcase"></i>
                            </span>
                            <span class="menu-text">Pemeriksaan</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Pemeriksaan</span>
                                </span>
                                </li>
                                <li class="menu-item  {{ request()->is('reservasi') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/reservasi') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Reservasi</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ request()->is('pemeriksaan/riwayat') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/pemeriksaan/riwayat') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Riwayat Pemeriksaan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-submenu @stack('setting')" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="flaticon2-gear"></i>
                            </span>
                            <span class="menu-text">Setting</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Setting</span>
                                </span>
                                </li>
                                <li class="menu-item  {{ request()->is('pengaturanjadwal') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/pengaturanjadwal') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Jadwal</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ request()->is('informasi') ? ' menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ url('/informasi') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Informasi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ route('logout') }}" class="menu-link menu-toggle" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span class="svg-icon menu-icon">
                                <i class="flaticon-logout"></i>
                            </span>
                            <span class="menu-text">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
