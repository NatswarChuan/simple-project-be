<!-- Navbar: thanh điều hướng -->
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">

    <div class="container"><a class="navbar-brand logo" href="<?php echo BASE_URL . '/' ?>">Brand</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo BASE_URL . '/tim-kiem/' ?>">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo count(URL) == 0 || URL[0] == 'trang-chu' ? 'active' : '' ?>"><a class="nav-link" href="<?php echo BASE_URL . '/' ?>">Trang chủ</a></li>
                <li class="nav-item <?php echo count(URL) != 0 ? URL[0] == 'danh-muc' ? 'active' : '' : '' ?>"><a class="nav-link" href="<?php echo BASE_URL . '/danh-muc' ?>">Danh mục</a></li>
                <li class="nav-item <?php echo count(URL) != 0 ? URL[0] == 'gio-hang' ? 'active' : '' : '' ?>"><a class="nav-link" href="<?php echo BASE_URL . '/gio-hang' ?>">Giỏ hàng</a></li>
            </ul>
        </div>
    </div>
</nav>