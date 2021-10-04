<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('storage/images/store/logo.png') }}" height="42px" width="42px">
        </div>
        <div class="sidebar-brand-text mx-3">Hoà Hồng Mobile</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Bảng quản trị</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Banner
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-image"></i>
            <span>Banner</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ chọn:</h6>
                <a class="collapse-item" href="{{route('banner.index')}}">Banner</a>
                <a class="collapse-item" href="{{route('banner.create')}}">Tạo Banner</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Cửa hàng
    </div>

    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
            <i class="fas fa-sitemap"></i>
            <span>Danh mục sản phẩm</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ chọn:</h6>
                <a class="collapse-item" href="{{route('category.index')}}">Danh Mục Sản Phẩm</a>
                <a class="collapse-item" href="{{route('category.create')}}">Tạo Danh Mục SP</a>
            </div>
        </div>
    </li>
    {{-- Products --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
            <i class="fas fa-cubes"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sản phẩm:</h6>
                <a class="collapse-item" href="{{route('product.index')}}">Sản Phẩm</a>
                <a class="collapse-item" href="{{route('product.create')}}">Tạo Sản Phẩm</a>
            </div>
            {{--Product Attribute--}}
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Thuộc tính sản phẩm:</h6>
                <a class="collapse-item" href="{{route('product-attribute.index')}}">Thuộc Tính Sản Phẩm</a>
                <a class="collapse-item" href="{{route('product-attribute.create')}}">Tạo Thuộc Tính SP</a>
            </div>
        </div>

    {{-- Brands --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
            <i class="fas fa-table"></i>
            <span>Nhãn Hiệu</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ Chọn:</h6>
                <a class="collapse-item" href="{{route('brand.index')}}">Nhãn Hiệu</a>
                <a class="collapse-item" href="{{route('brand.create')}}">Tạo Nhãn Hiệu</a>
            </div>
        </div>
    </li>

    {{-- Shipping --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
            <i class="fas fa-truck"></i>
            <span>Vận Chuyển</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ Chọn:</h6>
                <a class="collapse-item" href="{{route('shipping.index')}}">Vận Chuyển</a>
                <a class="collapse-item" href="{{route('shipping.create')}}">Tạo Vận Chuyển</a>
            </div>
        </div>
    </li>

    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Đơn Hàng</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('product-review.index')}}">
            <i class="fas fa-comments"></i>
            <span>Đánh Giá Sản Phẩm</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Bài Viết
    </div>

    <!-- Posts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
            <i class="fas fa-fw fa-folder"></i>
            <span>Bài Viết</span>
        </a>
        <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ Chọn:</h6>
                <a class="collapse-item" href="{{route('post.index')}}">Bài Viết</a>
                <a class="collapse-item" href="{{route('post.create')}}">Tạo Bài Viết</a>
            </div>
        </div>
    </li>

    <!-- Category -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>Danh Mục</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ Chọn:</h6>
                <a class="collapse-item" href="{{route('post-category.index')}}">Danh Mục</a>
                <a class="collapse-item" href="{{route('post-category.create')}}">Tạo Danh Mục</a>
            </div>
        </div>
    </li>

    <!-- Tags -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse" aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Thẻ</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tuỳ Chọn:</h6>
                <a class="collapse-item" href="{{route('post-tag.index')}}">Thẻ</a>
                <a class="collapse-item" href="{{route('post-tag.create')}}">Tạo Thẻ</a>
            </div>
        </div>
    </li>

    <!-- Comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('post-comment.index')}}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>Bình Luận</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Cài Đặt Chung
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('coupon.index')}}">
            <i class="fas fa-table"></i>
            <span>Mã Giảm Giá</span></a>
    </li>
    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>Người Dùng</span></a>
    </li>
    <!-- General settings -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>Cài Đặt Cửa Hàng</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
