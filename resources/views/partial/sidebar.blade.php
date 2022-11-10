<!--sidebar Begins-->
<aside class="admin-sidebar">
        <div class="admin-sidebar-brand">
            <!-- begin sidebar branding-->
            <img class="admin-brand-logo" src="assets/img/logo.png" width="150" alt="dataxdata Logo">
            <!-- <span class="admin-brand-content"><a href="index.html"> dataxdata</a></span> -->
            <!-- end sidebar branding-->
            <div class="ml-auto">
                <!-- sidebar pin-->
                <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
                <!-- sidebar close for mobile device-->
                <a href="#" class="admin-close-sidebar"></a>
            </div>
        </div>
        <div class="admin-sidebar-wrapper js-scrollbar">
            <!-- Menu List Begins-->
            <ul class="menu">
                <!--list item begins-->
                <li class="menu-item active">
                    <a href="dashboard" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Dashboard
                            </span>
                        </span>
                        <span class="menu-icon">

                            <i class="icon-placeholder mdi mdi-view-dashboard"></i>
                        </span>
                    </a>

                </li>
                <!--list item ends-->

                <!--list item begins-->
                <li class="menu-item {{ (Request::is('add-package') || Request::is('show-package') ? 'active' : '') }}">
                    <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Package
                                <span class="menu-arrow"></span>
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-package-variant"></i>
                        </span>
                    </a>
                    <!--submenu-->
                    <ul class="sub-menu" style="{{ (Request::is('add-package') || Request::is('show-package') ? 'display: block;' : 'display: none;') }}">
                        <li class="menu-item {{ (Request::url() == route('addPackage') ? 'active' : '') }}">
                            <a href="{{route('addPackage')}}" class="menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Add Package</span>
                                </span>
                                <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-plus-box-outline"></i>
                                </span>
                            </a>

                        </li>
                        <li class="menu-item {{ (Request::url() == route('showPackage') ? 'active' : '') }}">
                            <a href="{{route('showPackage')}}" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">View Package</span>
                                </span>
                                <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-eye-outline"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--list item ends-->

                <!--list item begins-->
                <li class="menu-item {{ (Request::is('add-category') || Request::is('show-category') ? 'active' : '') }}" >
                    <a href="{{route('addCategory')}}" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Category
                                <span class="menu-arrow"></span>
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-vector-intersection"></i>
                        </span>
                    </a>
                    <!--submenu-->
                    <ul class="sub-menu" style="{{ (Request::is('add-category') || Request::is('show-category') ? 'display: block;' : 'display: none;') }}">
                        <li class="menu-item {{ (Request::url() == route('addCategory') ? 'active' : '') }}">
                            <a href="{{route('addCategory')}}" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Add Category</span>
                                </span>
                                <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-plus-box-outline"></i>
                                </span>
                            </a>

                        </li>
                        <li class="menu-item {{ (Request::url() == route('showCategory') ? 'active' : '') }}">
                            <a href="{{route('showCategory')}}" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">View Category</span>
                                </span>
                                <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-eye-outline"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--list item ends-->

                 <!--list item begins-->
                 <li class="menu-item">
                    <a href="black-list" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Black List
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-playlist-check"></i>
                        </span>
                    </a>

                </li>
                <!--list item ends-->

                <!--list item begins-->
                <li class="menu-item ">
                    <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Data
                                <span class="menu-arrow"></span>
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-database"></i>
                        </span>
                    </a>
                    <!--submenu-->
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{route('addFormData')}}" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">Add Data</span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-plus-box-outline"></i>
                                </span>
                            </a>

                        </li>
                        <li class="menu-item">
                            <a href="{{route('addFormData')}}" class="menu-link">
                                <span class="menu-label">
                                    <span class="menu-name">View Data
                                    </span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-eye-outline"></i>
                                </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--list item ends-->

                 <!--list item begins-->
                 <li class="menu-item">
                    <a href="purchase-list" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Purchase List
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-cart"></i>
                        </span>
                    </a>

                </li>
                <!--list item ends-->

                 <!--list item begins-->
                 <li class="menu-item">
                    <a href="user-list" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">User List
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-account"></i>
                        </span>
                    </a>

                </li>
                <!--list item ends-->

                 <!--list item begins-->
                 <li class="menu-item">
                    <a href="role-list" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Role List
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder mdi mdi-account-check"></i>
                        </span>
                    </a>

                </li>
                <!--list item ends-->
            </ul>
            <!-- Menu List Ends-->
        </div>

    </aside>
    <!--sidebar Ends-->  