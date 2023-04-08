
            <!-- ========== App Menu ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="{{route('dashboard.get')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('admin/images/logo.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('admin/images/logo.png') }}" alt="" height="17">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{route('dashboard.get')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('admin/images/logo.png')}}" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('admin/images/logo.png') }}" alt="" height="60">
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <div id="scrollbar">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                            @can('list roles')
                            <li class="nav-item">
                                <a class="nav-link menu-link {{strpos(url()->current(),route('role.paginate.get')) !== false ? 'active' : ''}}" href="{{route('role.paginate.get')}}">
                                    <i class="ri-shield-user-fill"></i> <span data-key="t-widgets">Roles</span>
                                </a>
                            </li>
                            @endcan

                            @can('list users')
                            <li class="nav-item">
                                <a class="nav-link menu-link {{strpos(url()->current(),route('user.paginate.get')) !== false ? 'active' : ''}}" href="{{route('user.paginate.get')}}">
                                    <i class="ri-user-add-fill"></i> <span data-key="t-widgets">Users</span>
                                </a>
                            </li>
                            @endcan
                            {{-- <li class="nav-item">
                                <a class="nav-link menu-link {{strpos(url()->current(),'admin/image') !== false || strpos(url()->current(),'admin/audio') !== false || strpos(url()->current(),'admin/video') !== false || strpos(url()->current(),'admin/document') !== false ? 'active' : ''}}" href="#sidebarDashboards6" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{strpos(url()->current(),'admin/image') !== false || strpos(url()->current(),'admin/audio') !== false || strpos(url()->current(),'admin/video') !== false || strpos(url()->current(),'admin/document') !== false ? 'true' : 'false'}}" aria-controls="sidebarDashboards6">
                                    <i class="ri-image-fill"></i> <span data-key="t-dashboards">Media Content</span>
                                </a>
                                <div class="collapse menu-dropdown {{strpos(url()->current(),'admin/image') !== false || strpos(url()->current(),'admin/audio') !== false || strpos(url()->current(),'admin/video') !== false || strpos(url()->current(),'admin/document') !== false ? 'show' : ''}}" id="sidebarDashboards6">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{route('image_view')}}" class="nav-link {{strpos(url()->current(),'admin/image') !== false ? 'active' : ''}}" data-key="t-analytics"> Image </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('audio_view')}}" class="nav-link {{strpos(url()->current(),'admin/audio') !== false ? 'active' : ''}}" data-key="t-analytics"> Audio </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('video_view')}}" class="nav-link {{strpos(url()->current(),'admin/video') !== false ? 'active' : ''}}" data-key="t-analytics"> Video </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('document_view')}}" class="nav-link {{strpos(url()->current(),'admin/document') !== false ? 'active' : ''}}" data-key="t-analytics"> Document </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>  --}}
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>
