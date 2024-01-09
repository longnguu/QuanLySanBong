<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  href="/" class="text-light brand-link text-center">
        <h2 style="border-radius: 10px" class="badge-light text-center animation__wobble font-weight-bold">ADMIN</h2>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->ho.' '.\Illuminate\Support\Facades\Auth::user()->ten}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard')}}"
                       class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::is('admin.coso.index') || Route::is('admin.sanbong.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>
                            Quản lý sân
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.coso.index') }}"
                               class="nav-link {{ Route::is('admin.coso.index') ? 'active' : '' }}">
                                <i class="{{ Route::is('admin.coso.index') ? 'fa fa-check-circle' : 'far fa-circle' }} nav-icon"></i>
                                <p>
                            <span class="badge badge-info right">
                                    {{DB::table('coso')->count()}}
                                </span>
                                    Các cơ sở
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sanbong.index') }}" class="nav-link {{ Route::is('admin.sanbong.index') ? 'active' : '' }}">
                                <i class="{{ Route::is('admin.sanbong.index') ? 'fa fa-check-circle' : 'far fa-circle' }} nav-icon"></i>
                                <p>
                            <span class="badge badge-info right">
                                    {{DB::table('sanbong')->count()}}
                                </span>
                                    Sân bóng
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ (Route::is('admin.category.index') || Route::is('admin.discount.index') || Route::is('admin.product.index'))  ? 'active' : '' }}">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Quản lý vật phẩm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}"
                               class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">
                                <i class="{{ Route::is('admin.category.index') ? 'fa fa-check-circle' : 'far fa-circle' }} nav-icon"></i>
                                <p>
                            <span class="badge badge-info right">
                                    {{DB::table('loaiVP')->count()}}
                                </span>
                                    Danh mục sản phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.discount.index') }}"
                               class="nav-link {{ Route::is('admin.discount.index') ? 'active' : '' }}">
                                <i class="{{ Route::is('admin.discount.index') ? 'fa fa-check-circle' : 'far fa-circle' }} nav-icon"></i>
                                <p>
                            <span class="badge badge-info right">
                                    {{DB::table('khuyenmai')->count()}}
                                </span>
                                    Khuyến mãi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}"
                               class="nav-link {{ Route::is('admin.product.index') ? 'active' : '' }}">
                                <i class="{{ Route::is('admin.product.index') ? 'fa fa-check-circle' : 'far fa-circle' }} nav-icon"></i>
                                <p>
                            <span class="badge badge-info right">
                                    {{DB::table('vatpham')->count()}}
                                </span>
                                    Sản phẩm
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}"
                       class="nav-link {{ Route::is('admin.order.index') ? 'active' : '' }}">
{{--                                @if(DB::table('hoadon')->where('TrangThai', 0)->count()!= 0)--}}
{{--                                <span class="badge badge-danger right">--}}
{{--                                            {{DB::table('hoadon')->where('TrangThai', 0)->count()}}--}}
{{--                                        </span>--}}
{{--                                @endif--}}
                        <i class="nav-icon fas fa-sort-amount-up"></i>
                        <p>
                            Đơn hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}"
                       class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                        <span class="badge badge-info right">
                                    {{DB::table('nguoidung')->count()}}
                                </span>
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Người dùng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.naptien.index') }}"
                       class="nav-link {{ Route::is('admin.naptien.index') ? 'active' : '' }}">
{{--                                @if(DB::table('lichsunap')->where('trangthai','=',0)->count()!=0)--}}
{{--                                    <span class="badge badge-danger right">--}}
{{--                                            {{DB::table('lichsunap')->where('trangthai','=',0)->count()}}--}}
{{--                                    </span>--}}
{{--                                @endif--}}
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Yêu cầu chuyển tiền
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.coupon.index') }}"
                       class="nav-link {{ Route::is('admin.coupon.index') ? 'active' : '' }}">
{{--                                @if(DB::table('magiamgia')->count()!=0)--}}
{{--                                    <span class="badge badge-info right">--}}
{{--                                            {{DB::table('magiamgia')->count()}}--}}
{{--                                    </span>--}}
{{--                                @endif--}}
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Mã giảm giá
                        </p>
                    </a>
                </li>
                <li class="nav-header">QUẢN TRỊ</li>
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-code"></i>
                        <p>
                            Đang phát triển...
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
